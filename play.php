<!DOCTYPE html>
<!-- (c) 2013-2014 mkalte666 (mkalte666 [AT HERE THE @] googlemail.com -->
<?php
$titles = "0";
if(isset($_GET['play'])) $titles = $_GET['play'];
$shareurl = "http://www.bee-more-random.tk/stream/?play=".$titles;
$short_shareurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$shareurl);
?>
	<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
	<p><object width="250" height="250"><param name="movie" value="http://grooveshark.com/widget.swf" /><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=cowbell.grooveshark.com&songIDs=<?php echo $titles;?>&bbg=eeeeee&bth=B4D5DA&pfg=000000&lfg=555555&bt=813B45&pbg=bbbbbb&pfgh=813B45&si=813B45&lbg=eeeeee&lfgh=813B45&sb=813B45&bfg=eeeeee&pbgh=ffffff&lbgh=B1BABF&sbh=B1BABF&p=1" /><embed src="http://grooveshark.com/widget.swf" type="application/x-shockwave-flash" width="250" height="250" flashvars="hostname=cowbell.grooveshark.com&songIDs=<?php echo $titles;?>&bbg=eeeeee&bth=B4D5DA&pfg=000000&lfg=B4D5DA&bt=813B45&pbg=bbbbbb&pfgh=813B45&si=813B45&lbg=eeeeee&lfgh=55555&sb=813B45&bfg=eeeeee&pbgh=ffffff&lbgh=B1BABF&sbh=B1BABF&p=1" allowScriptAccess="always" wmode="window" /></object><br>
    
	<a href="https://twitter.com/share" class="twitter-share-button" data-text="You want to listen to the music I listen to?" data-url="<?php echo $short_shareurl;?>"data-lang="en">Tweet</a><input type="text" width="20" value="<?php echo $short_shareurl;?>" /></p>
    
