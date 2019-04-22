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
	session_start();//start a session lol
?>
<html>
	<head><meta charset="utf-8"></head>
	<body>
		<?php
			$mysqli = new mysqli("localhost", "root","", "millionAIR");								//connect to database
			if($mysqli->connect_error) {
				echo ("Fehler ". mysqli_connect_error());
				exit();
			}

			if(!empty($_POST['password'])  &&  !empty($_POST['username']) ) { 				//check if smth was entered
				$username = $_POST["username"];
				$password = $_POST["password"];
				$password = md5($password); 																						//encrypt password using md5

				$pwindb = $mysqli->query("SELECT password, userID, admin FROM users WHERE username LIKE '$username'"); //sql query
				$fetchpw = mysqli_fetch_array($pwindb); 																//save result of query to array
				$gotpw = $fetchpw['password'];																					//save actual value to variable
				$gotID = $fetchpw['userID']; 																						//save actual userID to create session
				$admin = $fetchpw['admin']; 																						//get information if user is an administrator

																																								// compare entered password with password provided by database
				if ($gotpw == $password){
					$_SESSION['userID'] = $gotID;
					if ($admin == 1) {
						$_SESSION['admin'] = true; 																					// set session var for admin
					}
					header ('location:/millionAIR/index.php');														//HIER MUSS AUF STARTSEITE VERWIESEN WERDEN!

				}

				elseif ($gotpw != $password){
				header('location:/millionAIR/sites/wrong_pw.php'); 											//different password? go back to login page
				exit;
				}
			}	else {
				header('location:/millionAIR/sites/wrong_pw.php');
			}
			$mysqli->close();																													//close connection to database
		?>
	</body>
</html>
