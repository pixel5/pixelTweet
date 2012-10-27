<?php
//Enter your twitter handle here
$handle = "the5thpixel";
//Change this to true to show @replies
$show_replies = false;


// Do NOT touch anything below 
function getTweets($handle, $show_replies){
	$url = "https://api.twitter.com/1/statuses/user_timeline.xml?screen_name=$handle";
	
	define('CWD', realpath(dirname(__FILE__) . '') );
	include(CWD.'/savedTweet.php');
	date_default_timezone_set('UTC');
	$currTime = time();
	$timeDiff = $currTime - $oldTime;

		if ($timeDiff < 30) {
		echo "<a href='http://twitter.com/$handle'>@$handle</a><br/>"."&quot;".$savedTweet."&quot;";
		}
		else {
			$xml = simplexml_load_file($url) or die("Could not Retrieve Tweets");

			$i = 0;
			$tweetArray = array();
      		foreach($xml->status as $status){
				// htmlspecialchars ensures quotes don't break the widget
				
				if ($show_replies == false) {
					// Shows replied tweets if enabled
					if ($status->in_reply_to_status_id == NULL or $status->in_reply_to_status_id == "") {
							$tweetText = $status->text;
							$tweetArray[$i] = makeLinks($tweetText, $i);
							$i += 1;
					}
					else {
							// This isn't the tweet we're looking for.
							// Move along... Move along...
					}
				}
				else {
					$tweetText = $status->text;
					$tweetArray[$i] = makeLinks($tweetText, $i);
 	 				$i += 1;
				}
     	 		}
     	 	echo "<a href='http://twitter.com/$handle'>@$handle</a><br/>"."&quot;".$tweetArray[0]."&quot;";
		
			// Write tweet to file
			$file = CWD."/savedTweet.php";
			$oTime = time();
			$var = "<?\n\n\$savedTweet = \"$tweetArray[0]\";\n\n\$oldTime = $oTime;\n\n?>";
			file_put_contents($file, $var) or die("~");
			// $test = file_get_contents($file) or die("g");
	}
}

function makeLinks($tweetText, $i) {

	// Check for URL's and make 'em links
	// The Regular Expression filter
	$reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$reg_exAt = '/(?<=^|\s)@([a-z0-9_]+)/i';

	if(preg_match($reg_exUrl, $tweetText, $url)) { $hasUrl = true; }
	if(preg_match($reg_exAt, $tweetText, $at)) { $hasAt = true; }
	// Tweet has URLs, but no handles
	if($hasUrl == true && $hasAt = false) {
		$tweetWithUrl = preg_replace("#(https?|ftp)://\S+[^\s.,>)\];'\"!?]#",'<a href="\\0">\\0</a>',$tweetText);
		$linkTweet = str_replace("\"", "'", "$tweetWithUrl");
		return $linkTweet;
	} 
	// Tweet has Handles, but no URLs
	elseif ($hasUrl == false && $hasAt = true) {
		$tweetWithHandle = preg_replace($reg_exAt, "<a href='http://twitter.com/".$at[0]."' rel='nofollow'>".$at[0]."</a>", $tweetText);
		$linkTweet = str_replace("\"", "'", "$tweetWithHandle");
		return $linkTweet;
	}
	// Tweet has both handles and URLs
	elseif ($hasUrl == true && $hasAt = true) {
		$tweetWithUrl = preg_replace("#(https?|ftp)://\S+[^\s.,>)\];'\"!?]#",'<a href="\\0">\\0</a>',$tweetText);
		$tweetWithUrlHandle = preg_replace($reg_exAt, "<a href='http://twitter.com/".$at[0]."' rel='nofollow'>".$at[0]."</a>", $tweetWithUrl);
		$linkTweet = str_replace("\"", "'", "$tweetWithUrlHandle");
		return $linkTweet;
	}
	else {
		// Tweet has no links or handles
		$linkTweet = htmlspecialchars("$tweetText", ENT_QUOTES);
 	 	return $linkTweet;
	}

}

getTweets($handle, $show_replies);

?>