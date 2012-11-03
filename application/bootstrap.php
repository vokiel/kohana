<?php namespace Kohana;

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Kohana'.EXT;
class_alias('Kohana\\Kohana', 'Kohana');
/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Warsaw');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'pl_PL.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('pl-pl');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
	'index_file'   => FALSE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log\File(APPPATH.'logs'));


/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	 'wysibb'      => MODPATH.'wysibb',      // Wysibb editor
	 'theme'      => MODPATH.'theme',      // Theme and views system
	 'swiftmailer'      => MODPATH.'swiftmailer',      // Swiftmailer
	 'sitemap'      => MODPATH.'sitemap',      // Sitemap
	 'simpleauth'      => MODPATH.'simpleauth',      // Simpleauth
	 'riudb'      => MODPATH.'riudb',      // RiuDB
	 'developerbar'      => MODPATH.'developerbar',      // Profilertoolbar
	 'oauth2'      => MODPATH.'oauth2',      // OAuth2
	 'menu'      => MODPATH.'menu',      // Menu generator
	 'markitup'      => MODPATH.'markitup',      // Markitup editor
	 'kostache'      => MODPATH.'kostache',      // Views templates
	 'breadcrumb'      => MODPATH.'breadcrumb',      // Breadcrumbs
	 'bootstrap'      => MODPATH.'bootstrap',      // Bootstrap templates
	 'analitics'      => MODPATH.'analitics',      // Google analitics
	 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	 'feed'      => MODPATH.'feed',      // Feed
	 'pagination'  => MODPATH.'pagination',  // Pagination module
	 'database'   => MODPATH.'database',   // Database access
	 'image'      => MODPATH.'image',      // Image manipulation
	 'parser'      => MODPATH.'parser',      // Markdown and bbcode parser
	 'starter'      => MODPATH.'starter',      // Hanariu starter page
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

Route::set('media/media', 'media(/<file>)', array('file' => '.+'))
	->defaults(array('controller' => 'Media', 'action' => 'media', 'file' => NULL));

Route::set('<controller>', '<controller>(/<sub>(/<page>))')
	->defaults(array(
		'controller' => 'doc',
		'action'     => 'index',
		'sub'     => 'index',
	));

Route::set('default', '(<controller>(/<action>(/<sub>)))')
	->defaults(array(
		'controller' => 'index',
		'action'     => 'index',
		'sub'     => 'index',
	));

Cookie::$salt = '123abc';
Cookie::$expiration = '180000';
