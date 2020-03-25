<?php
session_start();
//First part, require these files that need to use in searching.
$Title = $_POST['Title'];
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";
require "SpotifyWebAPIException.php";
//Create the session that consist of many part
$session = new SpotifyWebAPI\Session('??????????????','???????????????????','http://localhost/spotify/login.php');
//Create the token for send to the server
$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();
$api = new SpotifyWebAPI\SpotifyWebAPI();
$_SESSION['spotifyToken']=$session->getAccessToken();
$accessToken =$_SESSION['spotifyToken'];
$api->setAccessToken($accessToken);
//Use this function to search some hashtag by first paraminter = keyword which want to search/ Second is type for search/ last is amount of album.
$search=$api->search($Title,"album","1");
//Using foreach loop to access data in paramiter which server returned.
foreach($search->albums->items as $list)
{
	$uri=$list->id;
	echo'<iframe src="https://open.spotify.com/embed/album/' .$uri. '" width="300" height="380"></iframe>';
}
?>
