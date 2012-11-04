<?php namespace Kohana;?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<?php foreach ($metas as $value) echo '<meta'.HTML::attributes($value).' />',"\n" ?>
<?php foreach ($links as $value) echo '<link'.HTML::attributes($value).' />',"\n" ?>
<?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), "\n" ?>
<?php foreach ($scripts as $file) echo HTML::script($file), "\n" ?>
<?php foreach ($codes as $value) echo '<script'.HTML::attributes(array('type' => 'text/javascript')).'>'."\n".$value."\n".'</script>'; ?>
</head>
<body>
<?php
echo $navbar;
echo $header;
echo $leftbar;
echo $content;
echo $rightbar;
echo $sidebar;
echo $footer;
?>
</body>
</html>
