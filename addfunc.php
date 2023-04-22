<!DOCTYPE html>
<html>
    <head>
        <title>add function</title>
    </head>
    <body>
       
        <?php
			if(isset($_POST['addsubmit'])) //check if the user click on login button
			{
			
				session_start();
				include('conn.php');
				
				$pass = $_POST['password'];
				$email = $_POST['email'];
				$name = $_POST['name'];
				$roles = $_POST['roles'];
				$department = $_POST['department'];
				
            
        
				//get email and password from database
				//to check if it is an existing user
				$query = "INSERT INTO `user`(`Email`, `Password`, `Name`, `Roles`,`Department`) VALUES ('$email','$pass','$name','$roles','$department')";
				if(mysqli_query($conn, $query)) 
				{
					
					header('Location: adminadd.php?add=success#add');
					exit();
				} 
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
				
			
				
        
        ?>
    </body>
</html>