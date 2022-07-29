# PHP Upload - video.create - Dailymotion SDK

- user2 will define where the channel will be uploaded
- user2 is used to upload to child channel

```
$result = $api->call('video.create', array(
    'url' => $url,
    'title' => ".........",
    'description' => "....",
    'private' => 'true',
    'published' => 'true',
	//'thumbnail_url' => $rows[0]->thumb,
    'channel' => $channel
	//'user' => $user2
));
```
