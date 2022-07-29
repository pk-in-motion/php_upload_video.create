<?php 

require_once('/home/ez/public_html/20192020/include/connect/connect.php');
require_once 'Dailymotion.php';

$user = 'binh.nguyen@binhhoang.com';
$pwd = 'My_password';

$channel = 'music';
$user2 = 'x2dejft';
$sql = "SELECT * FROM `youtube_content` WHERE tf = 1 AND channelId = 'UCwZ2ZaFfTusqV_MGMHUnEsg' ORDER BY `viewCount` DESC LIMIT 1"; //GCDD
$filepath = "/data/Youtube/gcdd/";
$apiKey = '834c946373f409d25c70';
$apiSecret = '191a69d88c7711f6c4ebf52c3a9c04a865603932';

$db = new MyDBO();    
$rows = $db->get_rows($sql);

if (!count($rows)) {
        die('Finish.');
    }
$filepath = $filepath.$rows[0]->idvd.".mp4"; 

$api = new Dailymotion();

$api->setGrantType(Dailymotion::GRANT_TYPE_PASSWORD, $apiKey, $apiSecret, array('manage_videos', 'write','delete'), array('username' => $user, 'password' => $pwd));

$url = $api->uploadFile($filepath);

$result = $api->call('video.create', array(
    'url' => $url,
    'title' => $rows[0]->title,
    'description' => $rows[0]->content,
    'private' => 'false',
    'published' => 'true',
	'thumbnail_url' => $rows[0]->thumb,
    'channel' => $channel,
	'user' => $user2
));
if(isset($result["id"]) && $result["id"]){
	echo 'OK =>'. $result["id"].'<br>';
	$sql_update = "UPDATE `youtube_content` SET `tf` = 2 WHERE `id` = ".$rows[0]->id;
    $db->run_query($sql_update);
}else {
	$sql_update = "UPDATE `youtube_content` SET `tf` = 3 WHERE `id` = ".$rows[0]->id;
    $db->run_query($sql_update);
}
