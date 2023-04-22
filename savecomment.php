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

	if(isset($_POST['commented']) && isset($_POST['IdeaID']))
	{
	
		$IdeaID = $_POST['IdeaID'];
		$CommentUserID=$_SESSION['id'];
		$CommentDescription = $_POST['CommentDescription'];
		
	   
		$_SESSION['id']=$CommentUserID;
		$_SESSION['CommentDescription'] = $CommentDescription;
		
		
		

		

			
			if($CommentDescription != '')
			{
				
				
				
				$sqlInsert = "INSERT INTO comment(CUserID, IdeaID, CommentDescription) VALUES ('$CommentUserID','$IdeaID','$CommentDescription')";
				
				mysqli_query($conn, $sqlInsert);
				
				if($row['Roles']== 'DPManager')
				{
					header('Location: DPManager.php?comment=success#add');
				}
				else
				{
					
					header("Location: homepage.php?comment=success#add");
					
				}
				
			}
			else
			{
				
				if($row['Roles']== 'DPManager')
				{
					header('Location: DPManager.php?comment=error#add');
				}
				else
				{
					
					header("Location: homepage.php?comment=error#add");
				}
				
					
			}
	}

	
?>