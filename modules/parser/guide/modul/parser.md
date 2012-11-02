# Parser

Parsowanie i deparsowanie dokumentów za pomocą Markdown i BBcode.

### Podstawowy opis

Moduł służy do obsługi znaczników Markdown i BBcode, ich zamiany na znaczniki html oraz deparsowania kodu html z powortem na określone znaczniki. Funkcja deparsowania jest przydatna przynajmniej w dwóch powodów:

- przy imporcie danych zapisanych w html
- przy edycji danych w html

Parsowanie i deparsowanie danych z html podczas edycji, jest korzystniejsze niż parsowanie znaczników na html w locie podczas renderowania strony. 


### Składnia markdown


#### Nagłówki

    # Nagłówek 1
	
	## Nagłówek 2
	
	### Nagłówek3
	
	#### Nagłówek 4

#### Paragrafy
~~~
Regular text will be transformed into paragraphs.
Single returns will not make a new paragraph, this
allows for wrapping (especially for in-code
comments).

A new paragraph will start if there is a blank line between
blocks of text.  Chars like > and & are escaped for you.

To make a line break,  
put two spaces at the  
end of a line.
~~~
Regular text will be transformed into paragraphs.
Single returns will not make a new paragraph, this
allows for wrapping (especially for in-code
comments).

A new paragraph will start if there is a blank line between
blocks of text.  Chars like > and & are escaped for you.

To make a line break,  
put two spaces at the  
end of a line.

#### Linki
~~~
This is a normal link: [Kohana](http://kohanaframework.org).

This link has a title: [Kohana](http://kohanaframework.org "The swift PHP framework")
~~~
This is a normal link: [Kohana](http://kohanaframework.org)

This link has a title: [Kohana](http://kohanaframework.org "The swift PHP framework")

#### Bloki kodu

	For inline code simply surround some `text with tick marks.`
	
For inline code simply surround some `text with tick marks.`

	// For a block of code,
	// indent in four spaces,
	// or with a tab

You can also do a "fenced" code block:

	~~~
	A fenced code block has tildes
	          above and below it
	This is sometimes useful when code is near lists
	~~~
~~~
A fenced code block has tildes
		  above and below it
This is sometimes useful when code is near lists
~~~

#### Listy

~~~
*  To make a unordered list, put an asterisk, minus, or + at the beginning
-  of each line, surrounded by spaces.  You can mix * - and +, but it
+  makes no difference.
~~~
*  To make a unordered list, put an asterisk, minus, or + at the beginning
-  of each line, surrounded by spaces.  You can mix * - and +, but it
+  makes no difference.


~~~
1.  For ordered lists, put a number and a period
2.  On each line that you want numbered.
9.  It doesn't actually have to be the correct number order
5.  Just as long as each line has a number
~~~
1.  For ordered lists, put a number and a period
2.  On each line that you want numbered.
9.  It doesn't actually have to be the correct number order
5.  Just as long as each line has a number

#### Zagnieźdżone listy

~~~
*  To nest lists you just add four spaces before the * or number
	1. Like this
		*  It's pretty basic, this line has eight spaces, so its nested twice
	1. And this line is back to the second level
		*  Out to third level again
*  And back to the first level
~~~
*  To nest lists you just add four spaces before the * or number
	1. Like this
		*  It's pretty basic, this line has eight spaces, so its nested twice
	1. And this line is back to the second level
		*  Out to third level again
*  And back to the first level

#### Przechylenia i pogrubienia

~~~
Surround text you want *italics* with *asterisks* or _underscores_.

**Double asterisks** or __double underscores__ makes text bold.

***Triple*** will do *both at the same **time***.
~~~
Surround text you want *italics* with *asterisks* or _underscores_.

**Double asterisks** or __double underscores__ makes text **bold**.

___Triple___ will do *both at the same **time***.

#### Linie poziome

Horizontal rules are made by placing 3 or more hyphens, asterisks, or underscores on a line by themselves.
~~~
---
* * * *
_____________________
~~~
---
* * * *
_____________________

#### Obrazki

Image syntax looks like this:

	![Alt text](/path/to/img.jpg)
	
	![Alt text](/path/to/img.jpg "Optional title")


#### Tabele
~~~
First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cell
~~~

First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cell

		
