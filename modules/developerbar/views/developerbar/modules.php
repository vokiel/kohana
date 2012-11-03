<?php namespace Kohana; ?>
<h1>Modules</h1>
<table id="modules">
	<thead>
		<tr>
			<th>Module</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($modules as $m): ?>
			<tr class="<?php echo Text::alternate('odd','normal')?>">
				<td><?php echo $m ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
