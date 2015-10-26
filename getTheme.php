<?php
if($_GET['id'] == 'allTheme') {
    $theme = scandir('tests');
    $json = '{';
    $j=0;
    for($i=2; $i<count($theme); $i++, $j++) {
        $json .= '"test'.$j.'":"'.trim($theme[$i]).'", ';
    }
    $json .= '"count":'.$j.'}';
    echo $json;
}