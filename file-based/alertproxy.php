<?php
// Note: indentation can sometimes display in client to it is removed here.

$file_location = 'alerts.txt';
$show_for_minutes = 15;
date_default_timezone_set('America/Los_Angeles');

header('Content-type: application/xml');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
?>
<rss version="2.0">
<channel>
<title>
CAP Feed
</title>
<link>
</link>
<description>
This feed contains Everbridge notifications published to digital displays for <?php echo $show_for_minutes ?> min from the time received.
</description>
<lastBuildDate>
<?php echo date("D, j M Y G:i:s T"); // Fri, 02 Aug 2013 17:22:57 GMT ?>
</lastBuildDate>
<atom:link rel="self" type="application/rss+xml" href="https://hou.uoregon.edu/houdisplay/alertproxy.php" xmlns:atom="https://www.w3.org/2005/Atom" />
<?php 
echo time()-filemtime($file_location);
if (file_exists($file_location)) {
    if ((time()-filemtime($file_location)) < $show_for_minutes*60 ) {
    	$file = fopen($file_location, "r");
		$title = fgets($file); 
		$body = fgets($file); 
		fclose($file);
?>
<item>
<guid isPermaLink="false">
</guid>
<title>
<?php echo $title ?>
</title>
<link>
</link>
<description>
<?php echo $body ?>
</description>
<pubDate>
<?php echo date("D, j M Y G:i:s T", filemtime($file_location)); // Fri, 02 Aug 2013 17:22:57 GMT ?>
</pubDate>
</item>
<?php  	
    }
}
?>
</channel>
</rss>