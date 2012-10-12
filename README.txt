**pixelTweet**
Copyright 2012 Aaron Baxter (pixel5)

pixelTweet is a way for you to embed your most recent tweet onto your webpage WITHOUT authentication and without exceeding your limit on requests! Twitter limits you to 150 requests per un-authenticated IP, but this web app only makes a request every 30 seconds, maximum. 

The tweet is unstyled, leaving you free to use your own CSS and creativity to make it blend with your website. 

How to install pixelTweet

1. Place the pixelTweet directory onto your web server.

2. Edit 'pixelTweet.php' and change $handle = "the5thpixel"; to your twitter handle (example: $handle ="myTwitterName";) and save.

3. Edit the page you want your tweets to appear on and paste the following code where you want the tweet to appear:

<?php include('PATH/TO/pixelTweet/pixelTweet.php');?>

Where "PATH/TO/" is where you placed the pixelTweet folder.

Done! 

pixelTweet is licensed under Creative Commons 2012. 
http://github.com/pixel5/pixelTweet