<?php
//website variables

$siteName = "Latest Domain Name News";
$disqusShortName = "domainnews";
$websiteAddress = "http://www.domaintoad.com/";
$numberItemsToRender=10;



function renderNews($itemCount,$pageNum){
    $itemRender = "";
    $itemCount2 = $itemCount*$pageNum;
    //$itemCount=$itemCount*$pageNum;
    $getItems = "SELECT pkID,fkSourceID,title,link,description,timestamp FROM feedItems ORDER BY timestamp DESC LIMIT $itemCount2, $itemCount;";
    $getItems = mysql_query($getItems);
    while(list($pkID,$fkSourceID,$title,$link,$description,$timestamp)=mysql_fetch_row($getItems)){
        $getSource = "SELECT blogTitle,blogLink,imageURL FROM source WHERE pkSourceID = $fkSourceID LIMIT 1;";
        $getSource = mysql_query($getSource);
        $getSource = mysql_fetch_array($getSource);
        $blogTitle = $getSource['blogTitle'];
        $blogLink = $getSource['blogLink'];
        $imageURL = $getSource['imageURL'];
        $link=urldecode($link);
        $timestamp=displayDate(strtotime($timestamp));

        /*
        $itemRender .= "\n        <div class=\"article\">";
        $itemRender .= "\n          <h2><span><a href=\"${link}\">$title</a></span></h2>";
        $itemRender .= "\n          <p>Posted by <a href=\"$blogLink\">$blogTitle</a></p>";
        $itemRender .= "\n          <img src=\"$imageURL\" width=\"100\" height=\"100\" alt=\"img\" align=\"left\" class=\"fl\" />";
        $itemRender .= "\n          <p>$description</p>";
        $itemRender .= "\n          <p><a href=\"?view=1&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\">Comments</a> | $timestamp</p>";
        $itemRender .= "\n        </div>";
         */



        $itemRender .= "\n    <!--  item start -->";
        $itemRender .= "\n    <div class=\"big_mid\">";
        $itemRender .= "\n        <div class=\"img1\">";
        $itemRender .= "\n            <img src=\"$imageURL\" width=\"56\" height=\"56\" alt=\"${blogTitle}\" />";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n        <div class=\"all_txt\">";
        $itemRender .= "\n            <div class=\"img_txt\">";
        $itemRender .= "\n            <a href=\"/index.php?view=7&itemID=${fkSourceID}&search=${blogTitle}\" style=\"color:#827b00;\" >$blogTitle</a>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt\">";
        $itemRender .= "\n                <a href=\"${link}\" class=\"other_txt_link\">$title</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_2\">";
        $itemRender .= "\n                $description";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt_2\">";
        $itemRender .= "\n                <a href=\"${websiteAddress}index.php?view=2&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\" class=\"other_link\">Discussion</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <div class=\"date\">";
        $itemRender .= "\n                <span class=\"other_2\">$timestamp</span>";
        $itemRender .= "\n            </div>";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n    </div>";
        $itemRender .= "\n    <!--  Item End -->";








    }
    return $itemRender;
}


function renderNewsItem($newsItemID,$shortName,$homeURL){
    $homeURL .= "?view=1&itemID=${newsItemID}";
    $itemRender = "";
    $qGetItems = "SELECT pkID,fkSourceID,title,link,description,timestamp FROM feedItems WHERE pkID = $newsItemID LIMIT 1;";
    $getItems = mysql_query($qGetItems);
    list($pkID,$fkSourceID,$title,$link,$description,$timestamp)=mysql_fetch_row($getItems);
    $getSource = "SELECT blogTitle,blogLink,imageURL FROM source WHERE pkSourceID = $fkSourceID LIMIT 1;";
    $getSource = mysql_query($getSource);
    $getSource = mysql_fetch_array($getSource);
    $blogTitle = $getSource['blogTitle'];
    $blogLink = $getSource['blogLink'];
    $imageURL = $getSource['imageURL'];
    $link=urldecode($link);
    $timestamp=displayDate(strtotime($timestamp));






    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n          <h2><span>&nbsp;&nbsp;&nbsp;<a href=\"${link}\" style=\"color:#005826;\">$title</a></span></h2>";
    $itemRender .= "\n          <p  style=\"color:#827b00;\" >&nbsp;&nbsp;&nbsp;Posted by <a href=\"$blogLink\"  style=\"color:#827b00;\" >$blogTitle</a></p>";
    $itemRender .= "\n          <img src=\"$imageURL\" width=\"56\" height=\"56\" alt=\"img\" align=\"left\" class=\"img1\"/>";
    $itemRender .= "\n          <p>$description</p>";
    $itemRender .= "\n          <p>&nbsp;&nbsp;&nbsp;$timestamp</p>";
    $itemRender .= "\n        </div>";
    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n          <p>" . disqusComments($newsItemID,$shortName,$homeURL) . "</p>";

    $itemRender .= "\n        </div>";



    return $itemRender;
}


function disqusComments($newsItemID,$shortName,$fullURL){
    $renderDisqus = "";
    $renderDisqus .="\n<div id=\"disqus_thread\"></div>";
    $renderDisqus .="\n<script type=\"text/javascript\">";
    $renderDisqus .="\n    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */";
    $renderDisqus .="\n    var disqus_shortname = '$shortName'; // required: replace example with your forum shortname";

    $renderDisqus .="\n    // The following are highly recommended additional parameters. Remove the slashes in front to use.";
    $renderDisqus .="\n     var disqus_identifier = '$newsItemID';";
    $renderDisqus .="\n     var disqus_url = '$fullURL';";

    $renderDisqus .="\n    /* * * DON'T EDIT BELOW THIS LINE * * */";
    $renderDisqus .="\n    (function() {";
    $renderDisqus .="\n        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;";
    $renderDisqus .="\n        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';";
    $renderDisqus .="\n        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);";
    $renderDisqus .="\n    })();";
    $renderDisqus .="\n</script>";
    $renderDisqus .="\n<noscript>Please enable JavaScript to view the <a href=\"http://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>";
    $renderDisqus .="\n<a href=\"http:\/\/disqus.com\" class=\"dsq-brlink\">blog comments powered by <span class=\"logo-disqus\">Disqus</span></a>";

    return $renderDisqus;
}

//type = fkSourceID (int)
function itemCount($type){
    if($type==0){
        $countItem = "SELECT COUNT(pkID) from feedItems;";
        $countItem = mysql_query($countItem);
        $countItem=mysql_fetch_row($countItem);
        $numItems = $countItem['0'];
        $numPages=ceil($numItems/10);

        return $numPages;
    }
    else{
        $countItem = "SELECT COUNT(pkID) from feedItems WHERE fkSourceID = $type;";
        $countItem = mysql_query($countItem);
        $countItem=mysql_fetch_row($countItem);
        $numItems = $countItem['0'];
        $numPages=ceil($numItems/10);

        return $numPages;
    }

}

function pagination($numPages,$currentPage,$view,$itemID){
    $next=$currentPage+2;
    $real=$currentPage+1;
    $pagination="    <div class=\"numbers\">";
    //PAGE 1
    if($currentPage==0){
        $pagination.="	    <div class=\"previous\">";
        $pagination.="            <a href=\"#\"><img src=\"images/previous.png\" /></a>";
        $pagination.="        </div>";
        $pagination.="   	  <div class=\"num\">";
        $pagination.="            &nbsp;<a href=\"#\" style=\"color:#005826;\">1</a>";
        for($x=2;$x<12;$x++){
            $pagination.="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=$x&itemID=${itemID}\" class=\"num_link\">$x</a>";
        }
        $pagination.="...";
        $pagination.="<a href=\"/index.php?view=1&pageNum=$numPages&itemID=${itemID}\" class=\"num_link\">$numPages</a>";
        $pagination.="        </div>";
        $pagination.="        <div class=\"previous\">";
        $pagination.="            <a href=\"/index.php?view=${view}&pageNum=${next}&itemID=${itemID}\"><img src=\"images/next.png\" /></a>";
        $pagination.="        </div>";
    }
    //MIDDLE PAGES
    if($currentPage>0&&$real<$numPages){
        $left=5;
        $right=5;
        $predot=true;
        $postdot=true;
        if($currentPage-4<=0){
            $left=4-abs($currentPage-4);
            $right=$right+abs($currentPage-4);
            $predot=false;
        }
        if($real+5>=$numPages){
            $right=abs($numPages-$currentPage-1);
            $left=$left+abs($numPages-$currentPage);
            $postdot=false;
        }
        $pagination.="	    <div class=\"previous\">";
        $pagination.="            <a href=\"/index.php?view=${view}&pageNum=${currentPage}&itemID=${itemID}\"><img src=\"images/previous.png\" /></a>";
        $pagination.="        </div>";
        $pagination.="   	  <div class=\"num\">";
        $pagination.="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=1&itemID=${itemID}\"  class=\"num_link\">1</a>";
        if($predot){
            $pagination.="...";
        }
        $leftToRight="";
        for($x=1;$x<$left;$x++){
            $realPage=$real-$x;
            $leftToRight="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=$realPage&itemID=${itemID}\" class=\"num_link\">$realPage</a>".$leftToRight;
        }
        $pagination.=$leftToRight;

        $pagination.="            &nbsp;<a href=\"#\" style=\"color:#005826;\">$real</a>";
        $x=1;
        while($x<$right){
        //for($x=1;$x<$right;$x++){
            $realPage=$real+$x;
            $pagination.="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=$realPage&itemID=${itemID}\" class=\"num_link\">$realPage</a>";
            $x++;
        }

        if($postdot){
            $pagination.="...";
        }
        $pagination.="&nbsp;<a href=\"/index.php?view=${view}&pageNum=$numPages&itemID=${itemID}\" class=\"num_link\">$numPages</a>";
        $pagination.="        </div>";
        $pagination.="        <div class=\"previous\">";
        $pagination.="            <a href=\"/index.php?view=${view}&pageNum=${next}&itemID=${itemID}\"><img src=\"images/next.png\" /></a>";
        $pagination.="        </div>";
    }
    //LASTPAGE
    if($real==$numPages){
        $pagination.="	    <div class=\"previous\">";
        $pagination.="            <a href=\"/index.php?view=${view}&pageNum=${currentPage}&itemID=${itemID}\"><img src=\"images/previous.png\" /></a>";
        $pagination.="        </div>";
        $pagination.="   	  <div class=\"num\">";
        $pagination.="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=1\"  class=\"num_link\">1</a>";
        $pagination.="...";
        for($x=10;$x>0;$x--){
            $realPage=$real-$x;
            $pagination.="            &nbsp;<a href=\"/index.php?view=${view}&pageNum=$realPage&itemID=${itemID}\" class=\"num_link\">$realPage</a>";
        }
        $pagination.="&nbsp;<a href=\"#\"  style=\"color:#005826;\">$real</a>";
        $pagination.="        </div>";
        $pagination.="        <div class=\"previous\">";
        $pagination.="            <a href=\"#\"><img src=\"images/next.png\" /></a>";
        $pagination.="        </div>";
    }
    
    
    $pagination.="    </div>";

    /*john proffer pagination
     $pages=array();
     for ($i=$curpage+5; $i>0&&$i>($curpage-5); $i--){
         $pages[]=$curpage;
     }
     */

    return $pagination;
}

function renderSearch($search){
    $itemRender = "";
    $search = mysql_real_escape_string($search);
    $getItems = "SELECT pkID,fkSourceID,title,link,description,timestamp FROM feedItems WHERE  description LIKE '%${search}%' || title LIKE '%${search}%'  ORDER BY timestamp DESC LIMIT 50;";
    $getItems = mysql_query($getItems);
    while(list($pkID,$fkSourceID,$title,$link,$description,$timestamp)=mysql_fetch_row($getItems)){
        $getSource = "SELECT blogTitle,blogLink,imageURL FROM source WHERE pkSourceID = $fkSourceID LIMIT 1;";
        $getSource = mysql_query($getSource);
        $getSource = mysql_fetch_array($getSource);
        $blogTitle = $getSource['blogTitle'];
        $blogLink = $getSource['blogLink'];
        $imageURL = $getSource['imageURL'];
        $link=urldecode($link);
        $timestamp=displayDate(strtotime($timestamp));

        /*
        $itemRender .= "\n        <div class=\"article\">";
        $itemRender .= "\n          <h2><span><a href=\"${link}\">$title</a></span></h2>";
        $itemRender .= "\n          <p>Posted by <a href=\"$blogLink\">$blogTitle</a></p>";
        $itemRender .= "\n          <img src=\"$imageURL\" width=\"100\" height=\"100\" alt=\"img\" align=\"left\" class=\"fl\" />";
        $itemRender .= "\n          <p>$description</p>";
        $itemRender .= "\n          <p><a href=\"?view=1&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\">Comments</a> | $timestamp</p>";
        $itemRender .= "\n        </div>";
         */



        $itemRender .= "\n    <!--  item start -->";
        $itemRender .= "\n    <div class=\"big_mid\">";
        $itemRender .= "\n        <div class=\"img1\">";
        $itemRender .= "\n            <img src=\"$imageURL\" width=\"56\" height=\"56\" alt=\"${blogTitle}\" />";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n        <div class=\"all_txt\">";
        $itemRender .= "\n            <div class=\"img_txt\">";
        $itemRender .= "\n            <a href=\"$blogLink\" style=\"color:#827b00;\" >$blogTitle</a>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt\">";
        $itemRender .= "\n                <a href=\"${link}\" class=\"other_txt_link\">$title</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_2\">";
        $itemRender .= "\n                $description";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt_2\">";
        $itemRender .= "\n                <a href=\"${websiteAddress}index.php?view=2&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\" class=\"other_link\">Discussion</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <div class=\"date\">";
        $itemRender .= "\n                <span class=\"other_2\">$timestamp</span>";
        $itemRender .= "\n            </div>";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n    </div>";
        $itemRender .= "\n    <!--  Item End -->";








    }
    return $itemRender;
}

function renderSubmit(){
    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n        <iframe height=\"734\" allowTransparency=\"true\" frameborder=\"0\" scrolling=\"no\" style=\"width:100%;border:none\"  src=\"http://domaintoad.wufoo.com/embed/z7x4a3/\"><a href=\"http://domaintoad.wufoo.com/forms/z7x4a3/\" title=\"Submit Blog\" rel=\"nofollow\">Fill out my Wufoo form!</a></iframe>";
    $itemRender .= "\n        </div>";

    return $itemRender;
}

function renderContact(){
    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n        <iframe height=\"557\" allowTransparency=\"true\" frameborder=\"0\" scrolling=\"no\" style=\"width:100%;border:none\"  src=\"http://domaintoad.wufoo.com/embed/m7x3p9/\"><a href=\"http://domaintoad.wufoo.com/forms/m7x3p9/\" title=\"Submit Blog\" rel=\"nofollow\">Fill out my Wufoo form!</a></iframe>";
    $itemRender .= "\n        </div>";

    return $itemRender;
}
function renderAbout(){
    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n        <div style=\"margin-left:5px;\"><p>DomainToad is dedicated to bringing the latest domain industry news to you in a convenient manner.  The latest can always be found on our homepage or you can opt-in to our newsletter to receive daily updates directly in your inbox.</p>";
    $itemRender .= "\n        <p>DomainToad is Created by <a href=\"http://www.kevinohashi.com\" style=\"color:#598527;\">Kevin Ohashi</a></p>";
    $itemRender .= "\n        </div></div>";

    return $itemRender;
}

function sourceList(){
    $itemRender = "";
    $getSources = "SELECT pkSourceID, blogTitle FROM source;";
    $getSources = mysql_query($getSources);
    for($x=0; $x<mysql_num_rows($getSources);$x++){
        $source = mysql_fetch_array($getSources);
        $id = $source['pkSourceID'];
        $name = $source['blogTitle'];
        $itemRender .= "\n 		    <div class=\"bla\">";
        $itemRender .= "\n                 <a href=\"/index.php?view=7&itemID=${id}&search=${name}\" class=\"bla_link\">${name}</a>";
        $itemRender .= "\n             </div>";

    }


    return $itemRender;
}

function renderFeed($itemCount,$pageNum,$feedID){
    $itemRender = "";
    $itemCount2 = $itemCount*$pageNum;
    //$itemCount=$itemCount*$pageNum;
    $getItems = "SELECT pkID,fkSourceID,title,link,description,timestamp FROM feedItems WHERE fkSourceID = $feedID ORDER BY timestamp DESC LIMIT $itemCount2, $itemCount;";
    $getItems = mysql_query($getItems);
    while(list($pkID,$fkSourceID,$title,$link,$description,$timestamp)=mysql_fetch_row($getItems)){
        $getSource = "SELECT blogTitle,blogLink,imageURL FROM source WHERE pkSourceID = $fkSourceID LIMIT 1;";
        $getSource = mysql_query($getSource);
        $getSource = mysql_fetch_array($getSource);
        $blogTitle = $getSource['blogTitle'];
        $blogLink = $getSource['blogLink'];
        $imageURL = $getSource['imageURL'];
        $link=urldecode($link);
        $timestamp=displayDate(strtotime($timestamp));

        /*
        $itemRender .= "\n        <div class=\"article\">";
        $itemRender .= "\n          <h2><span><a href=\"${link}\">$title</a></span></h2>";
        $itemRender .= "\n          <p>Posted by <a href=\"$blogLink\">$blogTitle</a></p>";
        $itemRender .= "\n          <img src=\"$imageURL\" width=\"100\" height=\"100\" alt=\"img\" align=\"left\" class=\"fl\" />";
        $itemRender .= "\n          <p>$description</p>";
        $itemRender .= "\n          <p><a href=\"?view=1&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\">Comments</a> | $timestamp</p>";
        $itemRender .= "\n        </div>";
         */



        $itemRender .= "\n    <!--  item start -->";
        $itemRender .= "\n    <div class=\"big_mid\">";
        $itemRender .= "\n        <div class=\"img1\">";
        $itemRender .= "\n            <img src=\"$imageURL\" width=\"56\" height=\"56\" alt=\"${blogTitle}\" />";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n        <div class=\"all_txt\">";
        $itemRender .= "\n            <div class=\"img_txt\">";
        $itemRender .= "\n            <a href=\"$blogLink\" style=\"color:#827b00;\" >$blogTitle</a>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt\">";
        $itemRender .= "\n                <a href=\"${link}\" class=\"other_txt_link\">$title</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_2\">";
        $itemRender .= "\n                $description";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <br />";
        $itemRender .= "\n            <span class=\"other_txt_2\">";
        $itemRender .= "\n                <a href=\"${websiteAddress}index.php?view=2&itemID=${pkID}#disqus_thread\" data-disqus-identifier=\"${pkID}\" class=\"other_link\">Discussion</a>";
        $itemRender .= "\n            </span>";
        $itemRender .= "\n            <div class=\"date\">";
        $itemRender .= "\n                <span class=\"other_2\">$timestamp</span>";
        $itemRender .= "\n            </div>";
        $itemRender .= "\n        </div>";
        $itemRender .= "\n    </div>";
        $itemRender .= "\n    <!--  Item End -->";








    }
    return $itemRender;

}


function renderWidgets(){
    $itemRender .= "\n        <div class=\"big_mid\">";
    $itemRender .= "\n        <div style=\"margin-left:5px;\"><p>Syndicate the latest domain news on your website, blog, or anywhere using our widget!</p>";
    $itemRender .= "\n        <p><h2>Headline+Teaser Widgets</h2></p>";
    $itemRender .= "\n        <p><b>iFrame Widget (Beginner)</b></p>";
    $itemRender .= "\n        <p><textarea cols=50 rows=5>&#60;iframe src=\"http://www.domaintoad.com/widget.html\" width=\"200\" height=\"100%\" frameborder=\"0\"&#62;&#60;/iframe&#62;</textarea></p>";
    $itemRender .= "\n        <p>Copy and Paste HTML above. Change width=200 and height=100% to adjust it to fit your website</p>";
    $itemRender .= "\n        <p><b>JavaScript Option (Advanced)</b></p>";
    $itemRender .= "\n        <p><textarea cols=50 rows=5>&#60;script src=\"http://domaintoad.com/widget.js\"&#62;&#60;/script&#62;</textarea></p>";
    $itemRender .= "\n        <p>The javascript can be embedded into your website directly. Overwrite P, A, A:Visited, A:Hover CSS properties to stylize to your website</p>";
    $itemRender .= "\n        <p><h2>Headline Only Widgets</h2></p>";
    $itemRender .= "\n        <p><b>iFrame Widget (Beginner)</b></p>";
    $itemRender .= "\n        <p><textarea cols=50 rows=5>&#60;iframe src=\"http://www.domaintoad.com/widgetheadlines.html\" width=\"200\" height=\"300\" frameborder=\"0\"&#62;&#60;/iframe&#62;</textarea></p>";
    $itemRender .= "\n        <p>Copy and Paste HTML above. Change width=200 and height=300 to adjust it to fit your website</p>";
    $itemRender .= "\n        <p><b>JavaScript Option (Advanced)</b></p>";
    $itemRender .= "\n        <p><textarea cols=50 rows=5>&#60;script src=\"http://domaintoad.com/widgetheadlines.js\"&#62;&#60;/script&#62;</textarea></p>";
    $itemRender .= "\n        <p>The javascript can be embedded into your website directly. Overwrite P, A, A:Visited, A:Hover CSS properties to stylize to your website</p>";

    $itemRender .= "\n        </div></div>";

    return $itemRender;
}



function displayDate($timestamp){
    return date("F j, Y, g:i a",$timestamp);
}

?>
