<?php namespace Kohana;
echo '<div class="span3 bs-docs-sidebar">
<ul class="nav nav-list bs-docs-sidenav">';
foreach($menu as $m){
	$class = '';
	if($m['slug']===$sub){
		$class = ' class="active"';
	}
	echo '<li'.$class.'>'.HTML::anchor($controller.DIRECTORY_SEPARATOR.$m['slug'], '<i class="icon-chevron-right"></i> '.$m['title'], array('title'=>$m['title'])).'</li>';
}
echo '</ul>
</div>';
