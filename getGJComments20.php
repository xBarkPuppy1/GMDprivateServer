<?php
//error_reporting(0);
include "connection.php";
$levelsstring = "";
$songsstring  = "";
$gameVersion = htmlspecialchars($_POST["gameVersion"],ENT_QUOTES);
$type = htmlspecialchars($_POST["type"],ENT_QUOTES);
$colonmarker = 1337;
$songcolonmarker = 1337;
$userid = 1337;
//here da code begins
$levelID = htmlspecialchars($_POST["levelID"],ENT_QUOTES);
$query = "SELECT * FROM comments WHERE levelID = :levelID ORDER BY commentID DESC";
$query = $db->prepare($query);
$query->execute([':levelID' => $levelID]);
$result = $query->fetchAll();
$page = htmlspecialchars($_POST["page"],ENT_QUOTES);
for ($x = 0; $x < 9; $x++) {
	$commentpage = $page*10;
	$comment1 = $result[$commentpage+$x];
	if($comment1["commentID"]!=""){
		if($x != 0){
		echo "|";
	}
	$uploadDate = date("d/m/Y G:i", $comment1["timestamp"]);
	$actualcomment = $comment1["comment"];
	if($gameVersion < 20){
		$actualcomment = base64_decode($actualcomment);
	}
	echo "2~".$actualcomment."~3~".$comment1["userID"]."~4~".$comment1["likes"]."~5~0~7~0~9~".$uploadDate."~6~".$comment1["commentID"];
	$query12 = $db->prepare("SELECT * FROM users WHERE userID = '".$comment1["userID"]."'");
	$query12->execute();
	$result12 = $query12->fetchAll();
if ($query12->rowCount() > 0) {
	$userIDalmost = $result12[0];
	$userID = $userIDalmost["extID"];
if(is_numeric($userID)){
	$userIDnumba = $userID;
}else{
	$userIDnumba = 0;
}
}
	if($x == 0){
	$levelsstring = $levelsstring . $comment1["userID"] . ":" . $comment1["userName"] . ":" . $userIDnumba;
	}else{
	$levelsstring = $levelsstring ."|" . $comment1["userID"] . ":" . $comment1["userName"] . ":" . $userIDnumba;
	}
	$userid = $userid + 1;
	}
}
	echo "#".$levelsstring;
	echo "#9999:".$commentpage.":10";
?>