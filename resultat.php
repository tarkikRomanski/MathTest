	<?php 
	require_once 'db_connect.php';
	use dataBase\Connect as db;
	$connect = new db('Test');
	$res_arr = $connect->getColumnTable('resultats');

	$table = '<table class="table">';
	$table .= '<thead><tr><td>Ім’я</td><td>Група</td><td>Назва тесту</td><td>Час</td><td>Оцінка</td><td>Викладач</td><td>Час завершення</td></tr></thead>';
	$table .= '<tbody>';

	for ($i=0; $i < count($res_arr); $i++) { 
		$one = $res_arr[$i];
		$table .= "<tr real-id='$one[0]' >
						<td>$one[1]</td>
						<td>$one[2]</td>
						<td>$one[3]</td>
						<td>$one[4]</td>
						<td>$one[5]</td>
						<td>$one[6]</td>
						<td>$one[7]</td>
					</tr>";
		}
	$table .= '</tbody>';
	$table .= '</table>';
	echo $table;

	?>

	<style type="text/css">
		center {
			position: fixed;
			background-color: white;
			width: 100%;
			top: 0;
		}
	</style>

	<script type="text/javascript">
	$('tbody tr').dblclick(function(event) {
		if (confirm('Ви дійсно бажаєте видалити результат')){
			$.get(
					'deleter.php',
					{
						pass:'123465',
						rid:$(this).attr('real-id')
					},
					function(data){
						alert('Видалено');
					}
				);
		}
	});
		
	</script>