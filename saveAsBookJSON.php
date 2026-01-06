<?php

if(isset($_REQUEST['name']) && !empty($_REQUEST['name']) && isset($_REQUEST['chapters']) && !empty($_REQUEST['chapters'])) {
    $name = $_REQUEST['name'];  
    if(file_put_contents("bookMakerSpeicher/".$name.".json", json_encode($_REQUEST))) {
        $a = array('antwort' => 1);
        exit(json_encode($a));
    } else {
        $a = array('antwort' => 0);
        exit(json_encode($a));
    }
} 




?>