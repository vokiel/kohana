<?php namespace Kohana; ?>
<p>
<?php if ($first_page !== FALSE): ?>
<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first">&laquo; pierwsza</a>
<?php else: ?>
<span class="white">&laquo; pierwsza</span>
<?php endif ?>
<?php if ($previous_page !== FALSE): ?>
<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev">&lsaquo; poprzednie</a>
<?php else: ?>
<span class="white">&lsaquo; poprzednie</span>
<?php endif ?>
<?php if ($next_page !== FALSE): ?>
<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next">następna &rsaquo;</a>
<?php else: ?>
<span class="white">następna &rsaquo;</span>
<?php endif ?>
<?php if ($last_page !== FALSE): ?>
<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last">ostatnia &raquo;</a>
<?php else: ?>
<span class="white">ostatnia &raquo;</span>
<?php endif ?>
</p><!-- .pagination -->
