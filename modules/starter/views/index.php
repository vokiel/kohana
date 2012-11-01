<?php namespace Kohana;?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php foreach ($links as $value) echo '<link'.HTML::attributes($value).' />',"\n" ?>
<?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), "\n" ?>
<?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
echo $navbar;
echo $header;
if(!empty($leftbar)){
echo $leftbar;
}
echo $content;
echo $footer;

?>
</body>
</html>
