<?php
error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$dbname="loginattempt";
$atmp=0;
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(isset($_POST['login'])){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$atmp=$_POST['hidden'];
	if($atmp<4){
	$query="select * from loginattempt where username= ' ".$user." ' and password=' ".$pass." ' ";
	$result=mysqli_query($conn, $query);
	if($result){
		if(mysqli_num_rows($result)){
			while(mysql_fetch_array($result, MYSQL_BOTH)){
				echo'<script type="text/javascript">alert("Successful login")</script>';
			}
		}
		else {
			$atmp=$atmp+1;
			echo'<script type="text/javascript">alert("Error Attempt Attempted:  '.$atmp.' ")</script>';
		}
	}
}
	if($atmp==4){
		echo '<script type="text/javascript">alert("Exceeded Allowed Attempts")</script>';

	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="">
	<table align="center">
		<?php
		echo"<input type='hidden' name='hidden' value='".$atmp." '>";
		?>
		<tr>
			<td>Username</td>
			<td><input type="text" name="user" <?php if($atmp==4){?> disabled="disabled" <?php } ?> placeholder="Enter Username"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" placeholder="Enter Password"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="login" value="Login"></td>
		</tr
	</table>
</form>
</body>
</html>