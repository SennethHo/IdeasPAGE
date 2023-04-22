<?php
session_start();

include('conn.php');

if(!isset($_SESSION['id']) || trim($_SESSION['id']==''))
{
    header('Location: Login.php');
    exit(); //terminate the session/script
}



	$query = mysqli_query($conn, "select * from user where UserID = '".$_SESSION['id']."'");
	$row = mysqli_fetch_assoc($query);
	$authorDP = $row['Department'];
	$roles=$row['Roles'];

	if(isset($_POST['post']))
	{
		
		$authorID=$_SESSION['id'];
		$Description = $_POST['Description'];
		$Category = $_POST['categorychoice'];
		
	   
		$_SESSION['id']=$authorID;
		$_SESSION['Description'] = $Description;
		$_SESSION['categorychoice'] = $Category;
		
		
		

		

			
			if($Description != '')
			{
				
				
				
				$sqlInsert = "INSERT INTO ideas(Description, authorID, authorDP,Category) VALUES ('$Description','$authorID','$authorDP','$Category')";
				
				mysqli_query($conn, $sqlInsert);
				
				if($row['Roles']== 'DPManager')
				{
					header('Location: DPManager.php?idea=success#add');
				}
				else
				{
					
					header("Location: homepage.php?idea=success#add");
					
				}
				
				
				
			}
			else
			{
				if($row['Roles']== 'DPManager')
				{
					header('Location: DPManager.php?idea=error#add');
				}
				else
				{
					
					header("Location: homepage.php?idea=error#add");
				}
				
					
			}
	}

	
?>