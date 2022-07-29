<?php

//require_once('/home/ez/public_html/20192020/include/connect/connect.php');
//require_once 'Dailymotion.php';
include("Dailymotion.php");

$user = '....';
$pwd = '.....';

$channel = 'animals';
$user2 = 'x2dejft';
//$filepath = '/Users/p.kertonugroho/OneDrive - DAILYMOTION/LOCAL_DRIVE/sample_codes/nginx-1.12.2/html/phpsdk/phim-hai-hay/panda.mov';
//$filepath = '/Users/p.kertonugroho/OneDrive - DAILYMOTION/KIB/API/PHP_SDK_upload_video.create/combined-styles_swim_intercon.mp4';
$filepath = 'panda.mov';
$apiKey = '......';
$apiSecret = '.....';

/*
$sql = "SELECT * FROM `youtube_content` WHERE tf = 1 AND channelId = 'UCwZ2ZaFfTusqV_MGMHUnEsg' ORDER BY `viewCount` DESC LIMIT 1"; //GCDD

$db = new MyDBO();
$rows = $db->get_rows($sql);

if (!count($rows)) {
        die('Finish.');
    }
$filepath = $filepath.$rows[0]->idvd.".mp4";
*/

$api = new Dailymotion();

$api->setGrantType(Dailymotion::GRANT_TYPE_PASSWORD, $apiKey, $apiSecret, array('manage_videos', 'write','delete'), array('username' => $user, 'password' => $pwd));

$url = $api->uploadFile($filepath);

$result = $api->call('video.create', array(
    'url' => $url,
    'title' => "test using f4a3.....",
    'description' => "test",
    'private' => 'true',
    'published' => 'true',
	//'thumbnail_url' => $rows[0]->thumb,
    'channel' => $channel
	//'user' => $user2
));

/*
if(isset($result["id"]) && $result["id"]){
	echo 'OK =>'. $result["id"].'<br>';
	$sql_update = "UPDATE `youtube_content` SET `tf` = 2 WHERE `id` = ".$rows[0]->id;
    $db->run_query($sql_update);
}else {
	$sql_update = "UPDATE `youtube_content` SET `tf` = 3 WHERE `id` = ".$rows[0]->id;
    $db->run_query($sql_update);
}
*/

print_r($result);


?>
