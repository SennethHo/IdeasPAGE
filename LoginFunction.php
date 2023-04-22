<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
		
    </head>
    <body>
	
       
        <?php
	
		
			
			/*Check if username and password exist in database*/
        
			if(isset($_POST['login'])) //check if the user click on login button
			{
			
				session_start();
				include('conn.php');
        
            
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				
				
            
        
				//get email and password from database
				//to check if it is an existing user
				$query = mysqli_query($conn, "select * from user where Email = '$email' && Password = '$password' && Roles = 'Normal'");
				$query2 = mysqli_query($conn, "select * from user where Email = '$email' && Password = '$password' && Roles = 'Admin'");
				$query3 = mysqli_query($conn, "select * from user where Email = '$email' && Password = '$password' && Roles = 'DPManager'");
				$query4 = mysqli_query($conn, "select * from user where Email = '$email' && Password = '$password' && Roles = 'QAManager'");
				
				
				
				if(mysqli_num_rows($query) == 1) //verify if there is any record in database
				{
				//mysqli_fetch_array() = get database record and store in the array
					$row = mysqli_fetch_array($query);
				
					//store the primary key as session id (unique)
					$_SESSION['id'] = $row['UserID'];
						
					$_SESSION['message'] = "Success.User exist.";

					//redirect user to login successful page
					header('location:homepage.php?login=true#login');
				}
				else if(mysqli_num_rows($query2) == 1) //verify if there is any record in database
				{
					
					//mysqli_fetch_array() = get database record and store in the array
					$row = mysqli_fetch_array($query2);
				
					//store the primary key as session id (unique)
					$_SESSION['id'] = $row['UserID'];
						
					$_SESSION['message'] = "Success.User exist.";

					//redirect user to login successful page
					header('location:admin.php?login=true#login');
					
				}
				else if(mysqli_num_rows($query3) == 1) //verify if there is any record in database
				{
					
					//mysqli_fetch_array() = get database record and store in the array
					$row = mysqli_fetch_array($query3);
				
					//store the primary key as session id (unique)
					$_SESSION['id'] = $row['UserID'];
						
					$_SESSION['message'] = "Success.User exist.";

					//redirect user to login successful page
					header('location:DPManager.php?login=true#login');
					
				}
				else if(mysqli_num_rows($query4) == 1) //verify if there is any record in database
				{
					
					//mysqli_fetch_array() = get database record and store in the array
					$row = mysqli_fetch_array($query4);
				
					//store the primary key as session id (unique)
					$_SESSION['id'] = $row['UserID'];
						
					$_SESSION['message'] = "Success.User exist.";

					//redirect user to login successful page
					header('location:QAManager.php?login=true#login');
					
				}
				else //user not found
					{
				  $_SESSION['message'] = "Login failed. The user does not exist.";

				  //go back to the landing page (to login form)
				  //header() - redirect user to certain web page
				  header('location:Login.php?login=failed#login');
				}
            
                
                   
            
			}
			else
			{
				header('location:Login.php?login=notfilled#login');
            
			}
        
        ?>
    </body>
</html>