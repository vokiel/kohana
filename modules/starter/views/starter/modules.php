<?php namespace Kohana;
echo '<h1>Lista modułów i dodatków</h1>';
echo '<table class="table table-striped">
<thead>
 <tr><th>Nazwa modułu</th><th>Dokumentacja</th><th>Tutoriale</th><th>Status</th></tr>
</thead>
<tbody>';

foreach($menu as $m){
	if($m['slug']!=='index'){
		if(!empty($m['status']))
		{
			switch ($m['status'])
			{
				case 1:
					$status = '<span class="text-success">Dostępny</span>';
				break;
		
				case 2:
					$status = '<span class="text-info">Testowany</span>';
				break;

				case 3:
					$status = '<span class="text-warning">W realizacji</span>';
				break;

				case 4:
					$status = '<span class="muted">Planowany</span>';
				break;
			}
		}
		else{
			$status = '<span class="text-error">Nie określono</span>';
		}


		if(!empty($m['is_doc'])){
			$is_doc = '&#10004;';
		}
		else{
			$is_doc = '-';
		}

		if(!empty($m['is_tutorial'])){
			$is_tutorial = '&#10004;';
		}
		else{
			$is_tutorial = '-';
		}

		echo '<tr><td>'.$m['title'].'</td><td>'.$is_doc.'</td><td>'.$is_tutorial.'</td><td>'.$status.'</td></tr>';
	}
}
echo '</tbody></table>';
