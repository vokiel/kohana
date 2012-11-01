<?php namespace Kohana;?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="brand" href="<?php echo URL::base(); ?>">Hanariu</a>
			<div class="nav-collapse collapse">
			<ul class="nav">
			<?php

			foreach($menu as $m){
				$class = '';
				if($m['slug']===$active){
					$class = ' class="active"';
				}
				echo '<li'.$class.'>'.HTML::anchor($m['slug'], $m['title'], array('title'=>$m['title'])).'</li>';
			}
			?>
			</ul>
			</div>
		</div>
	</div>
</div>

