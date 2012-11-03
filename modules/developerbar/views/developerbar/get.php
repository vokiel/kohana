<?php namespace Kohana; ?>
<h1>GET Variables</h1>
<table id="get">
	<thead>
		<tr>
			<th>Name</th>
			<th>Value</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($get as $name => $value): ?>
			<tr class="<?php echo Text::alternate('odd','normal')?>">
				<td><?php echo $name ?></td>
				<td><?php var_export($value) ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
