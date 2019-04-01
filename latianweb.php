<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Latian website</title>
</head>
<body>
<form method="post">
	<blockquote>
	<strong> NAMA </strong>
	<input type="text" name="nama"><br>
	<br><strong>Email</strong>
	<input type="text" name="email"><br>
	<br><strong>Password</strong>
	<input type="Password" name="password"><br>
	<br><strong>Gender</strong>
	<option>
		<input type="radio" name="gender"  value="male" > <tt>Men</tt><br>
		<input type="radio" name="gender"  value="female" > <tt>women</tt>
	</option>
	<datalist>
		
	</datalist>
	<input type="submit" value="Submit"><br>
</blockquote>
</form>
<table border="1">
<?php
$con =  new mysqli('localhost','root','','latiansite');

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
    echo "<pre>";
 	print_r($_POST);
 	echo "</pre>";

 	if (isset($_POST["nama"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["gender"]) && !isset($_POST["update"]) && !isset($_POST["delete"])) {
 	$name = $_POST["nama"];
 	$email = $_POST["email"];
 	$pass = $_POST["password"];
 	$yesno = $_POST["gender"];
    $con->query("INSERT INTO datacust 
              VALUES (NULL, '$name', '$email', md5('$pass'), '$yesno')");
}
if (isset($_POST["delete"]) && isset($_POST["id"])) {
    	$id = $_POST["id"];
    	$con->query("DELETE FROM datacust WHERE id=$id");
    }

if(isset($_POST["edit"]) && isset($_POST["id"])) {
    	$id = $_POST["id"];
    	$result = $con->query("SELECT * FROM datacust WHERE id=$id");
    	$row = $result->fetch_assoc();
    	$name = $row["nama"];
    	$pass = $row["email"];
    	$email = $row["pass"];
 		$yesno = $row["gender"];
 		?>
 		<form method="post">
		<input type="text" name="nama" value="<?= $name ?>"><br>
		<input type="password" name="email" value="<?= $pass ?>"><br>
		<input type="text" name="pass" value="<?= $email ?>"><br>
		<input type="radio" name="gender" value="male" <?php if($yesno == male) echo "checked"; ?>>Yes
		<input type="radio" name="gender" value="female" <?php if($yesno == female) echo "checked"; ?>>No<br>
		<input type="submit" value="update" name="update"><p></p>
		<?php
}



                         $result = mysqli_query($con,"SELECT * From datacust ");
                        echo "
                            <div class='panel-body'>
                            <div class='table-responsive'>
                            <table border='1'>
                            <thead>
                            <tr>
                            <th align='center''>Id</th>
                            <th align='center''>Username</th>
                            <th align='center''>E-mail</th>
                            <th align='center''>Password</th>
                            <th align='center''>Gender</th>
                            </tr>
                            </thead>";

                            while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo "<td '>" . $row['id'] . "</td>";
                            echo "<td '>" . $row['nama'] . "</td>";
                            echo "<td '>" . $row['email'] . "</td>";
                            echo "<td '>" . $row['password'] . "</td>";
                            echo "<td '>" . $row['gender'] . "</td>";
                            echo "</tr>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='id' value='$id'>";
                            echo "<input type='submit' value='Del' name='delete'></form>";
                            echo "</td><td>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='id' value='$id'>";
                            echo "<input type='submit' value='Edit' name='edit'></form>";
                            echo "</td></tr>";
                        }   
                echo "</table></center>";
                ?>
    }

?>
</table>
</body>
</html>