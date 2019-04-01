<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MySQL 1</title>
</head>
<body>
<p>Add A New User</p>
<form method="post">
<p>Name:<input type="text" name="name" size="40"></p>
<p>Password:<input type="password" name="password" size="40"></p>
<p>Email:<input type="text" name="email" size="40"></p>
<p>Choice:<br/><input type="radio" name="yesno" value="1" checked>Yes<br>
		       <input type="radio" name="yesno" value="0">No</p>
<p>Newspaper:<br/>
	<input type="checkbox" name="pil1" value="0">Surya<br>
	<input type="checkbox" name="pil2" value="1">Jawa Pos<br>
	<input type="checkbox" name="pil3" value="2">Kompas<br>
	<input type="checkbox" name="pil4" value="3">Surabaya Post<br>
</p>
<p><input type="submit" value="Submit"/></p>
</form>


<table border="1">
<?php
	echo "<pre>";
 	print_r($_POST);
 	echo "</pre>";
	$conn = new mysqli("localhost", "justin", "12345", "justindb");

 	if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["yesno"]) && !isset($_POST["update"]) && !isset($_POST["delete"])) {
 	$name = $_POST["name"];
 	$pass = $_POST["password"];
 	$email = $_POST["email"];
 	$yesno = $_POST["yesno"];
    $conn->query("INSERT INTO users 
              VALUES (NULL, '$name', '$pass', '$email', '$yesno')");
	}

	if (isset($_POST["delete"]) && isset($_POST["user_id"])) {
    	$id = $_POST["user_id"];
    	$conn->query("DELETE FROM users WHERE user_id=$id");
    }

    if(isset($_POST["edit"]) && isset($_POST["user_id"])) {
    	$id = $_POST["user_id"];
    	$result = $conn->query("SELECT * FROM users WHERE user_id=$id");
    	$row = $result->fetch_assoc();
    	$name = $row["name"];
    	$pass = $row["password"];
    	$email = $row["email"];
 		$yesno = $row["yesno"];
 		?>
 		<form method="post">
		<input type="text" name="name" value="<?= $name ?>"><br>
		<input type="password" name="password" value="<?= $pass ?>"><br>
		<input type="text" name="email" value="<?= $email ?>"><br>
		<input type="radio" name="yesno" value="1" <?php if($yesno == 1) echo "checked"; ?>>Yes
		<input type="radio" name="yesno" value="0" <?php if($yesno == 0) echo "checked"; ?>>No<br>
		<input type="submit" value="update" name="update"><p></p>
		<?php
	}

	if(isset($_POST["update"]) && isset($_POST["user_id"]) && isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["yesno"])) {
		$id = $_POST["user_id"];
		$name = $_POST["name"];
 		$pass = $_POST["password"];
 		$email = $_POST["email"];
 		$yesno = $_POST["yesno"];
 		$conn->query("UPDATE users SET name = '$name', password = '$pass', email = '$email', yesno = '$yesno' WHERE user_id=$id");
	}
    
    $result = $conn->query("SELECT * FROM users");
    while($row = $result->fetch_assoc()){
    	$id = $row["user_id"];
    	echo "<tr><td>".$id."</td><td>".$row["name"]."</td><td>".$row["password"]."</td><td>".$row["email"]."</td><td>".$row["yesno"]."</td><td>
    	<form method='post'>
    	<input type='hidden' name='user_id' value='$id'>
    	<input type='submit' value='Del' name='delete'></form>
    	</td><td>
    	<form method='post'>
    	<input type='hidden' name='user_id' value='$id'>
    	<input type='submit' value='Edit' name='edit'></form>
    	</td></tr>";
    }
?>

</table>
</body>
</html>
