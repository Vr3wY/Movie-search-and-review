<?php
include "twitteroauth.php";
$Title = $_POST['Title'];
$consumer_key = "??????????";
$consumer_secret = "???????????";
$access_token = "???????????";
$access_token_secret = "?????????";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
//get twiiter array back form request
$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$Title.'&result_type=recent');
$gt = array("good","awesome","great","fun","enjoy","terrific","better","wow","excellent","superb","perfect","tremendous","fantastic","marvelous","best","that right","nice","stunning","elegant","unique","fetching","wonderful","amazing",
"super","omg","oh my god");
$bt = array("bad","not enojoy","worst","fuck","fucking","poor","waste","useless","terrible","damn","hell","wtf","asshole","shit","ass","noob","fool","holy shit","boring","fail","less");
//This funtion will print the infomation and evaluate the comment then send back to main
foreach ($tweets->statuses as $key => $items)
    {
      $eva = 0;
      foreach ($gt as $url) {
        if (strpos($items->text, $url) !== FALSE) {
          $eva++;
        }
      }
      foreach ($bt as $url) {
        if (strpos($items->text, $url) !== FALSE) {
          $eva--;
        }
      }

      if($eva<0){
        $summary = 'bad <img src="Image/M.png"  height="35" width="35">';
      }else if($eva > 0){
          $summary = 'good <img src="Image/P.png"  height="35" width="35">';
      }else{
          $summary = 'normal <img src="Image/E.png"  height="35" width="35">';
      }
        echo "<b>Time and Date of Tweet:</b> ".$items->created_at ."<br />";
        echo "<b>Tweet:</b> ". $items->text ."<br />";
        echo "<b>Tweeted by:</b> ". $items->user->name ."<br />";
        echo "<b>Evaluate:</b> $summary <br />";
		echo "-------------------------------------------------------"."<br>";

  }
?>
