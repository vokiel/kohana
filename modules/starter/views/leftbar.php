<?php namespace Kohana;
echo '<div class="span3 bs-docs-sidebar">
<ul class="nav nav-list bs-docs-sidenav">';
foreach($menu as $m){
	$class = '';
	if($m['slug']===$sub){
		$class = ' class="active"';
	}
	echo '<li'.$class.'>'.HTML::anchor($controller.DIRECTORY_SEPARATOR.$m['slug'], '<i class="icon-chevron-right"></i> '.$m['title'], array('title'=>$m['title']));
		if(!empty($class) AND !empty($m['menu']))
		{
			echo '<ul>';
			foreach($m['menu'] as $s){
				$subclass = '';
				if($s['slug']===$page){
					$subclass = ' class="subactive"';
				}
			echo '<li'.$subclass.'>'.HTML::anchor($controller.DIRECTORY_SEPARATOR.$m['slug'].DIRECTORY_SEPARATOR.$s['slug'], '<i class="icon-chevron-right"></i> '.$s['title'], array('title'=>$s['title'])).'</li>';

			}
			echo '</ul>';
		}
	echo '</li>';

}
echo '</ul>
</div>';
