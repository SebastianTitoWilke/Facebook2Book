<?php


if(isset($_REQUEST['regex']) && !empty($_REQUEST['regex']) ) {
    $regex = $_REQUEST['regex'];
} else {
    $regex = ' ';
}

if(isset($_REQUEST['regex2']) && !empty($_REQUEST['regex2']) ) {
    $regex2 = $_REQUEST['regex2'];
} else {
    $regex2 = ' ';
}

if(isset($_REQUEST['contra']) && !empty($_REQUEST['contra']) ) {
    $contra = '|'.$_REQUEST['contra'];
} else {
    $contra = '';
}

if(isset($_REQUEST['until']) && !empty($_REQUEST['until']) ) {
    $until = $_REQUEST['until'];
} else {
    $until = '01/05/2500';
}

if(isset($_REQUEST['from']) && !empty($_REQUEST['from']) ) {
    $from = $_REQUEST['from'];
} else {
    $from = '01/05/2000';
}

if(isset($_REQUEST['texteeimer']) && !empty($_REQUEST['texteeimer'])) {
    $texteeimer = json_decode($_REQUEST['texteeimer'], true);
} else {
    $texteeimer = array();
}

if(isset($_REQUEST['umgekehrt']) && !empty($_REQUEST['umgekehrt'])) {
    $umgekehrt = $_REQUEST['umgekehrt'];
} else {
    $umgekehrt = false;
}

if(isset($_REQUEST['mintextlength']) && !empty($_REQUEST['mintextlength'])) {
    $mintextlength = $_REQUEST['mintextlength'];
} else {
    $mintextlength = 10;
}

if(isset($_REQUEST['maxtextlength']) && !empty($_REQUEST['maxtextlength'])) {
    $maxtextlength = $_REQUEST['maxtextlength'];
} else {
    $maxtextlength = 40000;
}

//exit(var_dump($texteeimer));
$files = scandir('FaceBookJSONS');

$json_files = array();
foreach($files as $file) {
    if(substr($file, -4) === 'json'){
        $json_files[] = json_decode(file_get_contents('FaceBookJSONS/'.$file), true);
    }
}

//$file4 = json_decode(file_get_contents('old_morbus.json'), true);

$pro = '('.$regex.')';
$pro2 = '('.$regex2.')';    
$n = 1;
$post_number = 1;
$contra = '(http|Hörst du wie sie sich mit Diagnosen|#|Morbus|Tito|Medebach|Gilsbach|Stiefmutter|Onkel|Mutter|Vater|\d'.$contra.')';


$output = array();
foreach($json_files as $res) {
    $fcnt = 0;
    foreach($res as $post) {
        if(isset($post['timestamp'])) { 
            $time = $post['timestamp'];
        } else {
            $time = 0;
        }

        if(!empty($post['data'][0]['post'])) {
            $post = utf8_decode($post['data'][0]['post']);
            $next = $fcnt+1;
            if(isset($file3[$next]['data'][0]['post'])) {
                $after = utf8_decode($file3[$next]['data'][0]['post']);
            } else {
                $after = '';
            }

            if(substr($after, 0, 10) !== substr($post, 0, 10) && !in_array($time,$texteeimer) && !preg_match('/i'.$contra.'/i',$post) && preg_match('/'.$pro.'/i',$post) && preg_match('/'.$pro2.'/i',$post) && strlen($post) > $mintextlength && strlen($post) < $maxtextlength && strtotime($until) > $time && strtotime($from) < $time/*&& date('Y', $time) > 2021 && date('Y', $time) < 2023*/ /*date('d-m-Y', $time) == '11-07-2020'*/){
            $output[] = array('text' => nl2br(htmlentities($post)), 'time' => $time);			
                $n++;
                $post_number++;
            }
        }
        $fcnt++;
    }
}



if($umgekehrt === "true") { 
    exit(json_encode($output));
} else {
    exit(json_encode(array_reverse($output)));
}

?>