<?php namespace Kohana; ?>
<ul class="breadcrumb">
<?php
	$i = 1;
	foreach($crumbs as $c){
	if($i == $count){
	$link = $c['title'];
	}
	else{
	$link = HTML::anchor($c['url'], $c['crumb'], array('title'=>$c['title']));
	}
	?>
	<li<?php if($i === 1){ echo ' class="first">';}else{ echo '><span class="divider">/</span> ';} ?><?php echo $link; ?></li>
	<?php
	$i++;
	}
?>
</ul>
