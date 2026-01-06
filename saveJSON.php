<?php

if($_FILES && $_FILES["file"]["type"] === 'application/json')
    if(move_uploaded_file( $_FILES["file"]["tmp_name"],'FaceBookJSONS/'.$_FILES['file']['name'])) 
        echo json_encode( array('antwort' => 1));

?>