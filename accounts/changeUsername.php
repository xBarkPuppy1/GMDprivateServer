<?php
include "../connection.php";
require "../incl/generatePass.php";
//here im getting all the data
$userName = htmlspecialchars($_POST["userName"],ENT_QUOTES);
$newusr = htmlspecialchars($_POST["newusr"],ENT_QUOTES);
$password = md5($_POST["password"] . "epithewoihewh577667675765768rhtre67hre687cvolton5gw6547h6we7h6wh");
if($userName != "" AND $newusr != "" AND $password != ""){
	$generatePass = new generatePass();
	$pass = $generatePass->isValidUsrname($userName, $password);
	if ($pass == 1) {
		$query = $db->prepare("UPDATE accounts SET username=:newusr WHERE userName=:userName");	
		$query->execute([':newusr' => $newusr, ':userName' => $userName]);
		if($query->rowCount()==0){
			echo "Invalid password or nonexistant account. <a href='changeUsername.php'>Try again</a>";
		}else{
			echo "Username changed. <a href='accountManagement.php'>Go back to account management</a>";
		}
	}else{
		echo "Invalid password or nonexistant account. <a href='changeUsername.php'>Try again</a>";
	}
}else{
	echo '<form action="changeUsername.php" method="post">Old username: <input type="text" name="userName"><br>New username: <input type="text" name="newusr"><br>Password: <input type="password" name="password"><br><input type="submit" value="Change"></form>';
}
?>