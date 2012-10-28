<?php namespace Kohana; ?>
<section class="pagination">
<ul>
<?php

for ($i = 1; $i <= $total_pages; $i++)
{
if($current_page===$i){
$class = ' class="active"';
}
else{
$class = '';
}
echo '<li'.$class.'><a href="'.HTML::chars($page->url($i)).'" title="Strona '.$i.'">'.$i.'</a></li>';
}
?>
</ul>
</section>
<p>Strona <strong><?php echo $current_page; ?></strong> z <strong><?php echo $total_pages; ?></strong></p>
