<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document adds a new user to the database						                                    -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html>
	<head><meta charset="utf-8"></head>
	<body>
		<?php
			$mysqli = new mysqli("localhost", "root","", "millionAIR"); //open connection to database
			if($mysqli->connect_error) {
				echo ("Fehler ". mysqli_connect_error());
				exit();
			}

			if(!empty($_POST['password'])  &&  !empty($_POST['username']) ) { //check if smth was entered
				//save all informations entered to local variables
				$username = $_POST["username"];
				$password = $_POST["password"];
				$password2 = $_POST["password2"];
				$firstname = $_POST["firstname"];
				$lastname = $_POST["lastname"];
				$street = $_POST["street"];
				$city = $_POST["city"];
				$postal = $_POST["postal"];

				if ($password != $password2) { //check if both passwords are unequal
					header('location:register_error.php'); //if not go back with error message
					exit;
				}
			}
			else {
				header('location:register_error.php');
				exit;
			}

			$password = md5($password);//encrypt password using md5

			$result = $mysqli->query("SELECT userID FROM users WHERE username LIKE '$username'");//sql query
			$menge = $mysqli->affected_rows;//check if there is already a user with this username

			if($menge == 0) { //if not, insert the new user to the table
				$entry = "INSERT INTO users (username, firstname, lastname, street, city, postal_code, password)
							VALUES ('$username','$firstname','$lastname','$street','$city','$postal','$password')";
				$insert = $mysqli->query($entry);
				if($insert === true) { //check for the result of the insert
					header('location:to_login0.php'); //go to login page
					}
				else {
					header('location:register_error.php');//insert didnt work, go back with an error
				}
			}
			else {//if user already existed
				header('location:to_login.php');//go straight to login page
			}
			$mysqli->close(); //close connection
		?>
	</body>
</html>
