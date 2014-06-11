<?php
include('dbconnection.php');
mysql_query('SET CHARACTER SET utf8');
$getNews = "SELECT title,description,link FROM feedItems ORDER BY timestamp DESC LIMIT 5;";
$getNewsR = mysql_query($getNews);
for($c=0;$c<mysql_num_rows($getNewsR);$c++){
    $tempResult = mysql_fetch_array($getNewsR);
    $result[$c]['title'] = $tempResult['title'];
    $result[$c]['link'] = urldecode($tempResult['link']);
    $result[$c]['description'] = $tempResult['description'];

}
//$results = array("records"=>$result);
$resultJSON = json_encode($result);
//echo json_last_error();
echo "FuF.serverResponse(" . $resultJSON . ");";
//print_r($result);




?>
