<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document implements the function to log in to the website		                                        -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<?php
	// Start a session
    session_start();
?>
<html>
	<head><meta charset="utf-8"></head>
	<body>
		<?php
			$mysqli = new mysqli("localhost", "root","", "millionAIR"); //open connection to database
			if($mysqli->connect_error) {
				echo ("Fehler ". mysqli_connect_error());
				exit();
			}
            $tablecol = array('username', 'firstname', 'lastname', 'street', 'city', 'postal_code', 'password');
          	$userID = $_SESSION["userID"];
			$pwindb = $mysqli->query("SELECT username, firstname, lastname, street, city, postal_code, password FROM users WHERE userID = {$userID}"); //sql query
			$fetch = mysqli_fetch_array($pwindb); //save result of query to array
            foreach($tablecol as $key) {
            	if(!empty($_POST[$key]) && $_POST[$key] !== $fetch[$key]) {
            		if($key === 'password') {
            			echo "password!";
            			if($_POST[$key] === $_POST[$key . '2']) {
	            			$var = md5($_POST[$key]);
	            			echo "password var set";
            			} else {
	            			echo "no password var set";
            				continue;
            			}
            		} else {
            			$var = $_POST[$key];
            		}
            		$var = "'" . $var . "'";
        			$sql = "UPDATE users SET {$key}={$var} WHERE userID={$userID}";
        			echo $sql. "<br>";
        			$insert = $mysqli->query($sql);
        			if($insert) {
        				echo "<br>Insert successful!<br>";
        			} else {
        				echo "<br>Insert failed!<br>";
        			}
            	}
            }
			header("location:/millionAIR/sites/profile.php");
			$mysqli->close(); //close connection
		?>
	</body>
</html>
