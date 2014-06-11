<?php
//Feed Loader

require_once('magpie/rss_fetch.inc');
include('dbconnection.php');
include('rssdatetools.php');
$numItems = 10;

//fixing stupid fucking question marks
function fixQmark($string){
    $string = str_replace("&#8216;","'",$string);//'
    $string = str_replace("&#8217;","'",$string);//'
    $string = str_replace("&#8218;","'",$string);//'
    $string = str_replace("&#8220;","'",$string);//"
    $string = str_replace("&#8221;","'",$string);//"
    $string = str_replace("&rdquo;","'",$string);//"
    $string = str_replace("&ldquo;","'",$string);//"
    $string = str_replace("&#8222;","'",$string);//'
    $string = str_replace("&rsquo;","'",$string);//'
    $string = str_replace("&lsquo;","'",$string);//'
    $string = str_replace("&#8211;","-",$string);//-
    $string = str_replace("&#8212;","-",$string);//-
    $string = str_replace("&mdash;","-",$string);//-
    $string = str_replace("&ndash;","-",$string);//-
    $string = str_replace("  "," ",$string);//double space

/*
John Proffer's way
$search = array("/replace/","/replace/","/replace/");
$replace = array("","","");
$result = preg_replace($search,$replace,$data);


*/



    return $string;
}


//Get Feed List

$getFeedlist = "SELECT pkSourceID,rssFeedURL,lastCheck FROM source;";
$getFeedlist = mysql_query($getFeedlist);
$updateLastTime ="";

while(list($sourceid, $feedurl, $lastCheck)=mysql_fetch_row($getFeedlist)){
    //Get Feed Items
    $rss = fetch_rss($feedurl);
    $items = array_reverse(array_slice($rss->items,0,$numItems));
    $nodupe=0;
    foreach($items as $item){
        $time = rss2mysql($item['pubdate']);
        $title = strip_tags($item['title']);
        $title = htmlentities(html_entity_decode($title,ENT_QUOTES,'UTF-8'), ENT_QUOTES,'UTF-8');
        //$title = htmlentities(fixQmark($title), ENT_QUOTES);
        $title = substr($title,0,253);
        $link = substr(urlencode($item['link']),0,250);
        $item['description'] = htmlentities(html_entity_decode(strip_tags($item['description']),ENT_QUOTES,'UTF-8'),ENT_QUOTES,'UTF-8');
        if(strlen($item['description'])>250){
            //$description = substr(htmlentities(fixQmark(strip_tags($item['description'])),ENT_QUOTES),0,250) . "...";
            $description = substr($item['description'],0,250) . "...";

        }else{
            //$description = htmlentities(fixQmark(strip_tags($item['description'])),ENT_QUOTES);
            $description = $item['description'];
        }
        $title = mysql_real_escape_string($title);
        $description = mysql_real_escape_string($description);
        $link = mysql_real_escape_string($link);

        //$title = str_replace("?s","'s",$title);//-
        //$description = str_replace("?s","'s",$title);//-

        //Insert Newest into Database
        //if timestamp is higher or nodupe is already flagged
        if($nodupe||$time>$lastCheck){//do i really need to convert both to unix time?
        //if($nodupe||date("U",$time)>$oldResults['time']){
            $nodupe=1;//just easier to set it again
            $q = "INSERT INTO feedItems VALUES(null,$sourceid,'$title','$link','$description','$time');";
            mysql_query($q);
            echo $q;
        }
        $updateLastTime = $time;//set last time to insert into DB write

    }
    
    //update last time
    if($nodupe){
        mysql_query("UPDATE source SET lastCheck = '$updateLastTime' WHERE pkSourceID = $sourceid;");
    }
}






?>
