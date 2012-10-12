<?php
//Enter your twitter handle here
$handle = "NovusUnion";


function getTweets($handle){
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
			$xml = simplexml_load_file($url) or die(mysql_error);

				$i = 0;
				$tweetArray = array();
     	 		foreach($xml->status as $status){
					// htmlspecialchars ensures quotes don't break the widget
					$tweetText = $status->text;
					$tweetArray[$i] = htmlspecialchars("$tweetText", ENT_QUOTES);
	 	 			$i += 1;
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
getTweets($handle);

?>