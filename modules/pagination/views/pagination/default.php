<?php namespace Kohana;
<section class="btn-group mt8 mb4 ">
	<?php if ($previous_page): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" class="btn btn-success">poprzednia strona</a>
	<?php else: ?>
	<?php endif ?>
	<?php if ($next_page): ?>
		<a href="<?php echo HTML::chars($page->url($next_page)) ?>" class="btn btn-success">następna strona</a>
	<?php else: ?>
	<?php endif ?>
</section>
<p>Strona <strong><?php echo $current_page; ?></strong> z <strong><?php echo $total_pages; ?></strong></p>
