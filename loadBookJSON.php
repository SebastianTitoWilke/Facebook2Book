<?php

if(isset($_REQUEST['bookJson']) && !empty($_REQUEST['bookJson']) ) {
    $name = $_REQUEST['bookJson'];
    if(file_get_contents("bookMakerSpeicher/".$name)) {
        $a = array('antwort' => 1, 'json' => json_decode(file_get_contents("bookMakerSpeicher/".$name)));
        exit(json_encode($a));
    } else {
        $a = array('antwort' => 0);
        exit(json_encode($a));
    }
} 




?>