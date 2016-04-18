<?php
// Set your return content type
header('Content-type: application/xml');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
?>
<rss version="2.0">
<channel>
<title>
UOAlert CAP Feed
</title>
<link>
</link>
<description>
This feed contains Everbridge notifications published to digital displays for 15 min from the time received.
</description>
<lastBuildDate>
<?php echo date("D, j M Y G:i:s T"); // Fri, 02 Aug 2013 17:22:57 GMT ?>
</lastBuildDate>
<atom:link rel="self" type="application/rss+xml" href="https://hou.uoregon.edu/houdisplay/alertproxy.php" xmlns:atom="https://www.w3.org/2005/Atom" />
<?php 
//get from DB
$query = $dbsqli->query("SELECT * FROM alerts WHERE expire_at > NOW() ORDER BY `received_at` DESC LIMIT 1");
if($query) {
while ($result = $query->fetch_object()) {
?>
<item>
<guid isPermaLink="false">
</guid>
<title>
<?php echo $result->title ?>
</title>
<link>
</link>
<description>
<?php echo $result->body ?>
</description>
<pubDate>
<?php echo date("D, j M Y G:i:s T", strtotime($result->received_at)); // Fri, 02 Aug 2013 17:22:57 GMT ?>
</pubDate>
</item>
<?php
}
}
?>
</channel>
</rss>