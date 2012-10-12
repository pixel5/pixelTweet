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

TROUBLESHOOTING

Problem: Doesn't work at all / there is a tilde (~) after my tweet! 
Solution: Make sure your file permissions are correct. The first time you load the widget, it should create a new file called 'savedTweet.php' in the pixelTweets directory. Make sure that file has sufficient permissions (this could vary per server, try 777 if you aren't sure).

Problem: 'savedTweet.php' is not created
Solution: Once again, your permissions for user www-data are probably messed up… if that is the case, you have probably had more problems before this one. A workaround is to manually create the savedTweet.php file yourself and give it 777 permissions.

pixelTweet is licensed under Creative Commons 2012. 
http://github.com/pixel5/pixelTweet