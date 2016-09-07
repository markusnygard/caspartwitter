<?php ini_set('display_errors', 1); include 'mysql.php'; require_once('TwitterAPIExchange.php');

//DEBUG MODE
$debug = 0;
$loop = 0;
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "45864007-rtmkXTLi5ikoYFbdmHwKQA7l4bm8dAPZ4y6cHjX25",
    'oauth_access_token_secret' => "fFSK8czAuRVuAFXDQ3KznL1uhlOEesaXhJMFan0zlGRBA",
    'consumer_key' => "IETqF3OW6gt4P4TCmCoMGno4U",
    'consumer_secret' => "NKJ75WuvGGMEzJhOuFFg7koX1e9Hcf7ZyiKrnMXdZ6GRHKf2d9"
);

//Infinite loop:


$url = 'https://api.twitter.com/1.1/application/rate_limit_status.json';
$getfield = '?resources=help,users,search,statuses';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

var_export(json_decode($response));

$data = json_decode($response,true);
