<?php namespace Kohana; ?>
<div class="pager"><p>
	<?php if ($first_page !== FALSE): ?>
	<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first">&laquo;</a>
	<?php else: ?>
	<span class="white">&laquo;</span>
	<?php endif ?>
	<?php if ($previous_page !== FALSE): ?>
	<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev">&lsaquo;</a>
	<?php else: ?>
	<span class="white">&lsaquo;</span>
	<?php endif ?>
	<?php if ($total_pages < 13):  ?>
		<?php for ($i = 1; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>
	<?php elseif ($current_page < 4): ?>
		<?php for ($i = 1; $i <= 5; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>
		<span class="white">&hellip;</span>
		<a href="<?php echo $page->url($total_pages - 1) ?>"><?php echo $total_pages - 1 ?></a>
		<a href="<?php echo $page->url($total_pages) ?>"><?php echo $total_pages ?></a>
	<?php elseif ($current_page > $total_pages - 3): ?>
		<a href="<?php echo $page->url(1) ?>">1</a>
		<a href="<?php echo $page->url(2) ?>">2</a>
		<span class="white">&hellip;</span>
		<?php for ($i = $total_pages - 4; $i <= $total_pages; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>
	<?php else: ?>
		<a href="<?php echo $page->url(1) ?>">1</a>
		<a href="<?php echo $page->url(2) ?>">2</a>
		<span class="white">&hellip;</span>
		<?php for ($i = $current_page - 2; $i <= $current_page + 2; $i++): ?>
			<?php if ($i == $current_page): ?>
				<span><?php echo $i ?></span>
			<?php else: ?>
				<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
			<?php endif ?>
		<?php endfor ?>
		<span class="white">&hellip;</span>
		<a href="<?php echo $page->url($total_pages - 1) ?>"><?php echo $total_pages - 1 ?></a>
		<a href="<?php echo $page->url($total_pages) ?>"><?php echo $total_pages ?></a>
	<?php endif ?>
	<?php if ($next_page !== FALSE): ?>
	<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next">&rsaquo;</a>
	<?php else: ?>
	<span class="white">&rsaquo;</span>
	<?php endif ?>
	<?php if ($last_page !== FALSE): ?>
	<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last">&raquo;</a>
	<?php else: ?>
	<span class="white">&raquo;</span>
	<?php endif ?>
</p>
</div>

