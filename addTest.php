<?php
	if(isset($_POST['status'])) {
		$data = json_decode($_POST['status']);
    $fileName = "tests/" . $data->title . ".tf";
    $file[0] = "test\n";
    $file[1] = $data->title . "\n";
    $file[2] = $data->time . "\n";
    $file[3] = $data->teacher . "\n";
    $file[4] = $data->system . "\n";
    for ($i=1; $i <= $data->count; $i++) {
      $file[$i+4] = $data->{'question'.$i}->{'title'};
      for ($j=1; $j <= $data->{'question'.$i}->{'count'}; $j++) {
        $file[$i+4] .= "/:i:/" . $data->{'question'.$i}->{'e'.$j};
      }
      $file[$i+4] .= "/:i:/" . $data->{'question'.$i}->{'true'} . "\n";
    }

$res = file_put_contents($fileName, $file);
  }
?>
