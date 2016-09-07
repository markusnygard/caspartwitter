<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "45864007-rtmkXTLi5ikoYFbdmHwKQA7l4bm8dAPZ4y6cHjX25",
    'oauth_access_token_secret' => "fFSK8czAuRVuAFXDQ3KznL1uhlOEesaXhJMFan0zlGRBA",
    'consumer_key' => "IETqF3OW6gt4P4TCmCoMGno4U",
    'consumer_secret' => "NKJ75WuvGGMEzJhOuFFg7koX1e9Hcf7ZyiKrnMXdZ6GRHKf2d9"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'GET';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'rysio', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?screen_name=sledzik1984';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
