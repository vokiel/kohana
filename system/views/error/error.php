<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo __('error-title'); ?> - <?php echo __('error-'.$code); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body { background: #fff; font-size: 1em; font-family:sans-serif; text-align: left; color: #111; margin: 0px; padding: 0px;}
header { background: #911; font-size: 2em; font-family:sans-serif; text-align: left; color: #fff; margin: 0px; padding: 12px;}
footer { background: #fff; font-size: 1em; font-family:sans-serif; text-align: left; color: #666; margin: 0px; padding: 12px;}
</style>
</head>
<body>
<header><?php echo __('error-'.$code); ?></header>
<footer><?php echo __($msg,$values); ?></footer>
</body>
</html>
