<?php namespace Kohana; ?>
<h1>Routes</h1>
<table id="routes">
	<thead>
		<tr>
			<th>Route</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach($routes as $name => $route): ?>
			<tr class="<?php echo Text::alternate('odd','normal')?>">
				<td><?php echo $name ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
