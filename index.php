<?php
include('siteinfo.php');
include('dbconnection.php');
//header('Content-Type: text/html; charset=UTF-8');
header('Content-Type: text/html; charset=iso-8859-1');

if($_GET['view']){
    $view = addslashes($_GET['view']);
    $view = (int) $view;//typecast int
    $itemID = (int) addslashes($_GET['itemID']);
    if($_GET['pageNum']){
        $pageNum = (int) $_GET['pageNum']-1;
    }else{
        $pageNum=0;
    }
    $search = trim(addslashes(ereg_replace("%|\|","",strip_tags($_GET['search']))));

}else{
    $view=1;
}

//set main text
switch($view){
    case 1: $mainText = "Latest News";break;
    case 2: $mainText ="Blog Post";break;
    case 3: $mainText = "Search: " . $search;break;
    case 4: $mainText = "Submit Blog";break;
    case 5: $mainText = "Contact";break;
    case 6: $mainText = "About";break;
    case 7: $mainText = "Blog View: " . htmlentities(stripslashes($search),ENT_QUOTES);break;
    case 8: $mainText = "Widgets";break;
}

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $siteName ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/home.png','images/submit_hover.png','images/about_hover.png','images/contact_hover.png')">
<div class="container"><!-- Container start -->

<div class="header"><!-- Header start -->
    <div class="logo">
        <a href="<?php echo $websiteAddress; ?>"><img src="images/logo.png" /></a>
    </div>  <!-- LOGO -->

    <div class="nav"> <!-- Navigation Start -->

        <a href="/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/home.png',1)"><img src="images/home.png" alt="home" name="Image1" width="84" height="26" border="0" id="Image1" /></a>&nbsp;

        <a href="/index.php?view=4" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/submit_hover.png',1)"><img src="images/submit.png" alt="submit" name="Image2" width="84" height="26" border="0" id="Image2" /></a>&nbsp;

        <a href="/index.php?view=6" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/about_hover.png',1)"><img src="images/about.png" alt="about" name="Image3" width="84" height="26" border="0" id="Image3" /></a>&nbsp;

        <a href="/index.php?view=5" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/contact_hover.png',1)"><img src="images/contact.png" alt="contact" name="Image4" width="84" height="26" border="0" id="Image4" /></a>
    </div><!-- Nav ends here -->

</div><!-- Header ends here -->


<div class="main">
	<div class="rhs">
        <div class="daily_top">
            <div class="menu_text">
                <b>Our Daily Newsletter</b>
            </div>
        </div>
        <div class="daily_mid">
            <form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  >
            <input type="hidden" name="meta_web_form_id" value="1507200749" />
            <input type="hidden" name="meta_split_id" value="" />
            <input type="hidden" name="listname" value="domaintoad" />
            <input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text" id="redirect_9b2f95041082ae40e12015ce1aa1c8da" />
            <input type="hidden" name="meta_adtracking" value="domaintoadsignup" />
            <input type="hidden" name="meta_message" value="1" />
            <input type="hidden" name="meta_required" value="name,email" />
            <input type="hidden" name="meta_tooltip" value="" />
            <div class="daily_txt">
                Receive Daily Headlines Sent to Your Email!
            </div>
            <div class="daily_txt2">
                Name<br /><input type="text" id="awf_field-15314470" name="name" class="name_bg" tabindex="500" />
            </div>
            <div class="daily_txt2">
                Email Address<br /><input type="text" id="awf_field-15314471" name="email" class="name_bg" tabindex="501" /><br />
                <input name="submit" type="submit" value="" tabindex="502" class="subscribe" />
                </form>
            </div>
        </div>
        <div class="search_down">
        </div>

		<div class="search_top">
            <div class="menu_text">
                <b>Search</b>
            </div>
        </div>
		<div class="search_mid">
            <form action="/index.php" method="get" name="search"><input type="hidden" name="view" value="3"><input type="text" class="search_bg" name="search" value="<?php if($search&&$view==3){echo $search;}?>" /><br /><input type="submit" value="" class="go" /></form>
        </div>
       	<div class="search_down">
        </div>
		<div class="menu_top">
            <div class="menu_text">
                <b>View by Blog</b>
            </div>
        </div>
		<div class="search_mid">
		    <div class="bla">
                <a href="/index.php?view=4" class="bla_link">>Submit A Blog<</a>
            </div>
            <?php echo sourceList();?>
		</div>
        <div class="search_down">
        </div>
		<div class="menu_top">
            <div class="menu_text">
                <b>Widget</b>
            </div>
        </div>
		<div class="search_mid">
		    <div class="bla">
                <a href="/?view=8" class="bla_link">>Get our Widget<</a>
            </div>
		    <div class="bla">
                Live Demo Below:
            </div>

            <div>
                <iframe src="http://www.domaintoad.com/widgetheadlines.html" width="170" height="350" frameborder="0"></iframe>
            </div>

		</div>
        <div class="search_down">
        </div>
        
        <div class="domain">
            <a href="#"><img src="images/domain.png" /></a>
        </div>
        <div class="ad">
            <a href="#"><img src="images/ad.png" /></a>
        </div>
    </div><!-- rhs ends here -->
    
    
<div class="lhs">

    <div class="big_top">
        <div class="big_txt">
            Welcome to DomainToad
        </div>
    </div>
    <div class="big_mid">
        <div class="mid_txt">
            DomainToad is a free and easy way to read your domain name related news.
            <br /><br />
            We aggregate the most popular sources of information and present them in chronological order.
            <br /><br />
            If you would like to have daily headlines sent directly to your email every day, sign up for our newsletter!
        </div>
    </div>

    <div class="big_down">
    </div>
    <div class="big_top">
        <div class="big_txt">
            <?php echo $mainText; ?>
        </div>
    </div>
        


<?php switch ($view){
    case 1: echo renderNews($numberItemsToRender,$pageNum);break;
    case 2: echo renderNewsItem($itemID,$disqusShortName,$websiteAddress);break;
    case 3: echo renderSearch($search);break;
    case 4: echo renderSubmit();break;
    case 5: echo renderContact();break;
    case 6: echo renderAbout();break;
    case 7: echo renderFeed($numberItemsToRender,$pageNum,$itemID);break;
    case 8: echo renderWidgets();break;
}


if($view==1){

echo pagination(itemCount(0),$pageNum,$view,$itemID);

}
if($view==7){

echo pagination(itemCount($itemID),$pageNum,$view,$itemID);

}
?>
<!--</div>-->

    <div class="big_down">
    </div>
</div><!-- lhs ends here -->

</div><!-- Main endshere -->


</div><!-- Container div ends here -->
<div class="footer">
    <div class="last_menu">
        <a href="/" class="last_menu_link">Home</a>
        | <a href="/index.php?view=4" class="last_menu_link"> Submit Blog</a>
        |<a href="/index.php?view=6" class="last_menu_link">  About </a>
        | <a href="/index.php?view=5" class="last_menu_link"> Contact Us</a><br /><br />
    </div>
    <div class="last">
        Copyright &copy; 2014 DomainToad.com All rights reserved
    </div>
</div>



<?php
if($view==1){
    echo "\n<script type=\"text/javascript\">";
    echo "\n    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */";
    echo "\n    var disqus_shortname = '${disqusShortName}'; // required: replace example with your forum shortname";
    echo "\n    /* * * DON'T EDIT BELOW THIS LINE * * */";
    echo "\n    (function () {";
    echo "\n        var s = document.createElement('script'); s.async = true;";
    echo "\n        s.type = 'text/javascript';";
    echo "\n        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';";
    echo "\n        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);";
    echo "\n    }());";
    echo "\n</script>";

}

?>

</body>
</html>
