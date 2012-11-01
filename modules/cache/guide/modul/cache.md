# About Kohana Cache

[Kohana_Cache] provides a common interface to a variety of caching engines. [Cache_Tagging] is
supported where available natively to the cache system. Kohana Cache supports multiple 
instances of cache engines through a grouped singleton pattern.

## Supported cache engines

 *  APC ([Cache_Apc])
 *  File ([Cache_File])
 *  Memcached ([Cache_Memcache])
 *  Memcached-tags ([Cache_Memcachetag])
 *  SQLite ([Cache_Sqlite])
 *  Wincache

## Introduction to caching

Caching should be implemented with consideration. Generally, caching the result of resources
is faster than reprocessing them. Choosing what, how and when to cache is vital. [PHP APC](http://php.net/manual/en/book.apc.php) is one of the fastest caching systems available, closely followed by [Memcached](http://memcached.org/). [SQLite](http://www.sqlite.org/) and File caching are two of the slowest cache methods, however usually faster than reprocessing
a complex set of instructions.

Caching engines that use memory are considerably faster than file based alternatives. But
memory is limited whereas disk space is plentiful. If caching large datasets, such as large database result sets, it is best to use file caching.

 [!!] Cache drivers require the relevant PHP extensions to be installed. APC, eAccelerator, Memecached and Xcache all require non-standard PHP extensions.

## What the Kohana Cache module does (and does not do)

This module provides a simple abstracted interface to a wide selection of popular PHP cache engines. The caching API provides the basic caching methods implemented across all solutions, memory, network or disk based. Basic key / value storing is supported by all drivers, with additional tagging and garbage collection support where implemented or required.

_Kohana Cache_ does not provide HTTP style caching for clients (web browsers) and/or proxies (_Varnish_, _Squid_). There are other Kohana modules that provide this functionality.

## Choosing a cache provider

Getting and setting values to cache is very simple when using the _Kohana Cache_ interface. The hardest choice is choosing which cache engine to use. When choosing a caching engine, the following criteria must be considered:

 1. __Does the cache need to be distributed?__
    This is an important consideration as it will severely limit the options available to solutions such as Memcache when a distributed solution is required.
 2. __Does the cache need to be fast?__
    In almost all cases retrieving data from a cache is faster than execution. However generally memory based caching is considerably faster than disk based caching (see table below).
 3. __How much cache is required?__
    Cache is not endless, and memory based caches are subject to a considerably more limited storage resource.

Driver           | Storage      | Speed     | Tags     | Distributed | Automatic Garbage Collection | Notes
---------------- | ------------ | --------- | -------- | ----------- | ---------------------------- | -----------------------
APC              | __Memory__   | Excellent | No       | No          | Yes | Widely available PHP opcode caching solution, improves php execution performance
Wincache         | __Memory__   | Excellent | No       | No          | Yes | Windows variant of APC
File             | __Disk__     | Poor      | No       | No          | No  | Marginally faster than execution
Memcache (tag)   | __Memory__   | Good      | No (yes) | Yes         | Yes | Generally fast distributed solution, but has a speed hit due to variable network latency and serialization
Sqlite           | __Disk__     | Poor      | Yes      | No          | No  | Marginally faster than execution

It is possible to have hybrid cache solutions that use a combination of the engines above in different contexts. This is supported with _Kohana Cache_ as well

## Minimum requirements

 *  Kohana 3.0.4
 *  PHP 5.2.4 or greater



# Kohana Cache configuration

Kohana Cache uses configuration groups to create cache instances. A configuration group can
use any supported driver, with successive groups using multiple instances of the same driver type.

The default cache group is loaded based on the `Cache::$default` setting. It is set to the `file` driver as standard, however this can be changed within the `/application/boostrap.php` file.

     // Change the default cache driver to memcache
     Cache::$default = 'memcache';

     // Load the memcache cache driver using default setting
     $memcache = Cache::instance();

## Group settings

Below are the default cache configuration groups for each supported driver. Add to- or override these settings
within the `application/config/cache.php` file.

Name           | Required | Description
-------------- | -------- | ---------------------------------------------------------------
driver         | __YES__  | (_string_) The driver type to use
default_expire | __NO__   | (_string_) The driver type to use


	'file'  => array
	(
		'driver'             => 'file',
		'cache_dir'          => APPPATH.'cache/.kohana_cache',
		'default_expire'     => 3600,
	),

## Memcache & Memcached-tag settings

Name           | Required | Description
-------------- | -------- | ---------------------------------------------------------------
driver         | __YES__  | (_string_) The driver type to use
servers        | __YES__  | (_array_) Associative array of server details, must include a __host__ key. (see _Memcache server configuration_ below)
compression    | __NO__   | (_boolean_) Use data compression when caching

### Memcache server configuration

Name             | Required | Description
---------------- | -------- | ---------------------------------------------------------------
host             | __YES__  | (_string_) The host of the memcache server, i.e. __localhost__; or __127.0.0.1__; or __memcache.domain.tld__
port             | __NO__   | (_integer_) Point to the port where memcached is listening for connections. Set this parameter to 0 when using UNIX domain sockets.  Default __11211__
persistent       | __NO__   | (_boolean_) Controls the use of a persistent connection. Default __TRUE__
weight           | __NO__   | (_integer_) Number of buckets to create for this server which in turn control its probability of it being selected. The probability is relative to the total weight of all servers. Default __1__
timeout          | __NO__   | (_integer_) Value in seconds which will be used for connecting to the daemon. Think twice before changing the default value of 1 second - you can lose all the advantages of caching if your connection is too slow. Default __1__
retry_interval   | __NO__   | (_integer_) Controls how often a failed server will be retried, the default value is 15 seconds. Setting this parameter to -1 disables automatic retry. Default __15__
status           | __NO__   | (_boolean_) Controls if the server should be flagged as online. Default __TRUE__
failure_callback | __NO__   | (_[callback](http://www.php.net/manual/en/language.pseudo-types.php#language.types.callback)_) Allows the user to specify a callback function to run upon encountering an error. The callback is run before failover is attempted. The function takes two parameters, the hostname and port of the failed server. Default __NULL__

	'memcache' => array
	(
		'driver'             => 'memcache',
		'default_expire'     => 3600,
		'compression'        => FALSE,              // Use Zlib compression 
		                                            (can cause issues with integers)
		'servers'            => array
		(
			'local' => array
			(
				'host'             => 'localhost',  // Memcache Server
				'port'             => 11211,        // Memcache port number
				'persistent'       => FALSE,        // Persistent connection
			),
		),
	),
	'memcachetag' => array
	(
		'driver'             => 'memcachetag',
		'default_expire'     => 3600,
		'compression'        => FALSE,              // Use Zlib compression 
		                                            (can cause issues with integers)
		'servers'            => array
		(
			'local' => array
			(
				'host'             => 'localhost',  // Memcache Server
				'port'             => 11211,        // Memcache port number
				'persistent'       => FALSE,        // Persistent connection
			),
		),
	),

## APC settings

	'apc'      => array
	(
		'driver'             => 'apc',
		'default_expire'     => 3600,
	),

## SQLite settings

	'sqlite'   => array
	(
		'driver'             => 'sqlite',
		'default_expire'     => 3600,
		'database'           => APPPATH.'cache/kohana-cache.sql3',
		'schema'             => 'CREATE TABLE caches(id VARCHAR(127) PRIMARY KEY, 
		                                  tags VARCHAR(255), expiration INTEGER, cache TEXT)',
	),

## File settings

	'file'    => array
	(
		'driver'             => 'file',
		'cache_dir'          => 'cache/.kohana_cache',
		'default_expire'     => 3600,
	)

## Wincache settings

	'wincache' => array
	(
		'driver'             => 'wincache',
		'default_expire'     => 3600,
	),


## Override existing configuration group

The following example demonstrates how to override an existing configuration setting, using the config file in `/application/config/cache.php`.

	<?php defined('SYSPATH') or die('No direct script access.');
	return array
	(
		// Override the default configuration
		'memcache'   => array
		(
			'driver'         => 'memcache',  // Use Memcached as the default driver
			'default_expire' => 8000,        // Overide default expiry
			'servers'        => array
			(
				// Add a new server
				array
				(
					'host'       => 'cache.domain.tld',
					'port'       => 11211,
					'persistent' => FALSE
				)
			),
			'compression'    => FALSE
		)
	);

## Add new configuration group

The following example demonstrates how to add a new configuration setting, using the config file in `/application/config/cache.php`.

	<?php defined('SYSPATH') or die('No direct script access.');
	return array
	(
		// Override the default configuration
		'fastkv'   => array
		(
			'driver'         => 'apc',  // Use Memcached as the default driver
			'default_expire' => 1000,   // Overide default expiry
		)
	);



# Kohana Cache usage

[Kohana_Cache] provides a simple interface allowing getting, setting and deleting of cached values. Two interfaces included in _Kohana Cache_ additionally provide _tagging_ and _garbage collection_ where they are supported by the respective drivers.

## Getting a new cache instance

Creating a new _Kohana Cache_ instance is simple, however it must be done using the [Cache::instance] method, rather than the traditional `new` constructor.

     // Create a new instance of cache using the default group
     $cache = Cache::instance();

The default group will use whatever is set to [Cache::$default] and must have a corresponding [configuration](cache.config) definition for that group.

To create a cache instance using a group other than the _default_, simply provide the group name as an argument.

     // Create a new instance of the memcache group
     $memcache = Cache::instance('memcache');

If there is a cache instance already instantiated then you can get it directly from the class member.

 [!!] Beware that this can cause issues if you do not test for the instance before trying to access it.

     // Check for the existance of the cache driver
     if (isset(Cache::$instances['memcache']))
     {
          // Get the existing cache instance directly (faster)
          $memcache = Cache::$instances['memcache'];
     }
     else
     {
          // Get the cache driver instance (slower)
          $memcache = Cache::instance('memcache');
     }

## Setting and getting variables to and from cache

The cache library supports scalar and object values, utilising object serialization where required (or not supported by the caching engine). This means that the majority or objects can be cached without any modification.

 [!!] Serialisation does not work with resource handles, such as filesystem, curl or socket resources.

### Setting a value to cache

Setting a value to cache using the [Cache::set] method can be done in one of two ways; either using the Cache instance interface, which is good for atomic operations; or getting an instance and using that for multiple operations.

The first example demonstrates how to quickly load and set a value to the default cache instance.

     // Create a cachable object
     $object = new stdClass;

     // Set a property
     $object->foo = 'bar';

     // Cache the object using default group (quick interface) with default time (3600 seconds)
     Cache::instance()->set('foo', $object);

If multiple cache operations are required, it is best to assign an instance of Cache to a variable and use that as below.

     // Set the object using a defined group for a defined time period (30 seconds)
     $memcache = Cache::instance('memcache');
     $memcache->set('foo', $object, 30);

#### Setting a value with tags

Certain cache drivers support setting values with tags. To set a value to cache with tags using the following interface.

     // Get a cache instance that supports tags
     $memcache = Cache::instance('memcachetag');

     // Test for tagging interface
     if ($memcache instanceof Cache_Tagging)
     {
          // Set a value with some tags for 30 seconds
          $memcache->set('foo', $object, 30, array('snafu', 'stfu', 'fubar'));
     }
     // Otherwise set without tags
     else
     {
          // Set a value for 30 seconds
          $memcache->set('foo', $object, 30);
     }

It is possible to implement custom tagging solutions onto existing or new cache drivers by implementing the [Cache_Tagging] interface. Kohana_Cache only applies the interface to drivers that support tagging natively as standard.

### Getting a value from cache

Getting variables back from cache is achieved using the [Cache::get] method using a single key to identify the cache entry.

     // Retrieve a value from cache (quickly)
     $object = Cache::instance()->get('foo');

In cases where the requested key is not available or the entry has expired, a default value will be returned (__NULL__ by default). It is possible to define the default value as the key is requested.

     // If the cache key is available (with default value set to FALSE)
     if ($object = Cache::instance()->get('foo', FALSE))
     {
          // Do something
     }
     else
     {
          // Do something else
     }

#### Getting values from cache using tags

It is possible to retrieve values from cache grouped by tag, using the [Cache::find] method with drivers that support tagging.

 [!!] The __Memcachetag__ driver does not support the `Cache::find($tag)` interface and will throw an exception.

     // Get an instance of cache
     $cache = Cache::instance('memcachetag');

     // Wrap in a try/catch statement to gracefully handle memcachetag
     try
     {
          // Find values based on tag
          return $cache->find('snafu');
     }
     catch (Cache_Exception $e)
     {
          // Handle gracefully
          return FALSE;
     }

### Deleting values from cache

Deleting variables is very similar to the getting and setting methods already described. Deleting operations are split into three categories:

 - __Delete value by key__. Deletes a cached value by the associated key.
 - __Delete all values__. Deletes all caches values stored in the cache instance.
 - __Delete values by tag__. Deletes all values that have the supplied tag. This is only supported by Memcached-Tag and Sqlite.

#### Delete value by key

To delete a specific value by its associated key:

     // If the cache entry for 'foo' is deleted
     if (Cache::instance()->delete('foo'))
     {
          // Cache entry successfully deleted, do something
     }

By default a `TRUE` value will be returned. However a `FALSE` value will be returned in instances where the key did not exist in the cache.

#### Delete all values

To delete all values in a specific instance:

     // If all cache items where deleted successfully
     if (Cache::instance()->delete_all())
     {
           // Do something
     }

It is also possible to delete all cache items in every instance:

     // For each cache instance
     foreach (Cache::$instances as $group => $instance)
     {
          if ($instance->delete_all())
          {
               var_dump('instance : '.$group.' has been flushed!');
          }
     }

#### Delete values by tag

Some of the caching drivers support deleting by tag. This will remove all the cached values that are associated with a specific tag. Below is an example of how to robustly handle deletion by tag.

     // Get cache instance
     $cache = Cache::instance();

     // Check for tagging interface
     if ($cache instanceof Cache_Tagging)
     {
           // Delete all entries by the tag 'snafu'
           $cache->delete_tag('snafu');
     }

#### Garbage Collection

Garbage Collection (GC) is the cleaning of expired cache entries. For the most part, caching engines will take care of garbage collection internally. However a few of the file based systems do not handle this task and in these circumstances it would be prudent to garbage collect at a predetermined frequency. If no garbage collection is executed, the resource storing the cache entries will eventually fill and become unusable.

When not automated, garbage collection is the responsibility of the developer. It is prudent to have a GC probability value that dictates how likely the garbage collection routing will be run. An example of such a system is demonstrated below.

     // Get a cache instance
     $cache_file = Cache::instance('file');

     // Set a GC probability of 10%
     $gc = 10;

     // If the GC probability is a hit
     if (rand(0,99) <= $gc and $cache_file instanceof Cache_GarbageCollect)
     {
          // Garbage Collect
          $cache_file->garbage_collect();
     }

# Interfaces

Kohana Cache comes with two interfaces that are implemented where the drivers support them:

 - __[Cache_Tagging] for tagging support on cache entries__
    - [Cache_MemcacheTag]
    - [Cache_Sqlite]
 - __[Cache_GarbageCollect] for garbage collection with drivers without native support__
    - [Cache_File]
    - [Cache_Sqlite]

When using interface specific caching features, ensure that code checks for the required interface before using the methods supplied. The following example checks whether the garbage collection interface is available before calling the `garbage_collect` method.

    // Create a cache instance
    $cache = Cache::instance();

    // Test for Garbage Collection
    if ($cache instanceof Cache_GarbageCollect)
    {
         // Collect garbage
         $cache->garbage_collect();
    }
