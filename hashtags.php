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

while (1) {


$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#inma';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

if ($debug == 1) {
var_export(json_decode($response));
}
$data = json_decode($response,true);

$screen_name = $data['statuses']['0']['user']['screen_name'];
$msg = $data['statuses']['0']['text'];
$id = $data['statuses']['0']['id'];
//From here we start MySQL transaction


//Let's check that downloaded tweet is in our tweets database
$num_query = "SELECT * FROM `tweets` WHERE `twitter_id` = '$id' LIMIT 1";
$num_result = mysql_query($num_query);
echo mysql_error();
$tweets_in_database = mysql_num_rows($num_result);

if ($debug == 1) {

	echo "DEBUG: Tweet in database: " . $tweets_in_database;

}

if ($tweets_in_database == 1) {

	//Tweet in database. Do nothing

} else {

	//Tweet not in database. STORE!
	echo "Last tweet in database. Doing nothing!\n";
	
	$insert_query = "INSERT INTO `caspartwitter`.`tweets` (`id`, `twitter_id`, `screen_name`, `msg`, `active`, `shown`) VALUES (NULL, '$id', '$screen_name', '$msg', '0', '0')";
	mysql_query($insert_query);
	
	//echo $insert_query;
	echo mysql_error();
	echo "Tweet stored!\n";

}

        echo "Loop done. Sleeping 15 seconds.\n";
	//Have to sleep because of API Limits. This piece of software uses 3 API hits every time loop is finished. 
        sleep(15);

//Infinite loop end
}
