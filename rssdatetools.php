<?php
//RSS Date Tools

//Mon, 20 Dec 2010 14:53:33 +0000
function rss2mysql($rsstime){
    return date("Y-m-d H:i:s",strtotime($rsstime));
}

//echo rss2mysql("Mon, 20 Dec 2010 14:53:33 +0000");

?>
