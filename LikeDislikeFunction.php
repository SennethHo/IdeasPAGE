<?php
session_start();
include('conn.php');

if(!isset($_SESSION['id']) || trim($_SESSION['id']==''))
{
    header('Location: Homepage.php');
    exit(); 
}

$query = mysqli_query($conn, "select * from user where UserID = '".$_SESSION['id']."'");
$row = mysqli_fetch_assoc($query);

if(isset($_POST['upvote']) && isset($_POST['IdeaID'])) {
    $IdeaID = $_POST['IdeaID'];
    $UserID = $_SESSION['id'];
    $voteTypeT = 1;
    $existingVote = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."'");
	if(mysqli_num_rows($existingVote) == 1)
	{
		
		$checkVote = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."' AND VoteType = '1'");
		if(mysqli_num_rows($checkVote) == 1)
		{
			if($row['Roles']== 'DPManager')
			{
				header('Location: DPManager.php');
			}
			else if($row['Roles']== 'QAManager')
			{
				header('Location: QAManager.php');
				
			}
			else
			{
				
				header('Location: Homepage.php');
			}
			
		}
		else
		{
			mysqli_query($conn, "UPDATE likedislikerecord SET VoteType ='1' WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."'");
			mysqli_query($conn, "UPDATE ideas SET likes = likes + 1 WHERE IdeaID = '".$IdeaID."'");
			
		}
		
	}
	else
	{
		mysqli_query($conn, "INSERT INTO likedislikerecord (VUserID, VIdeaID, VoteType) VALUES ('".$UserID."', '".$IdeaID."', '".$voteTypeT."')");
        mysqli_query($conn, "UPDATE ideas SET likes = likes + 1 WHERE IdeaID = '".$IdeaID."'");
    }
}



if(isset($_POST['downvote']) && isset($_POST['IdeaID'])) {
    $IdeaID = $_POST['IdeaID'];
    $UserID = $_SESSION['id'];
    $voteTypeT = -1;
    $existingVote = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."'");
	if(mysqli_num_rows($existingVote) == 1)
	{
		
		$checkVote = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."' AND VoteType = '-1'");
		if(mysqli_num_rows($checkVote) == 1)
		{
			if($row['Roles']== 'DPManager')
			{
				header('Location: DPManager.php');
			}
			else if($row['Roles']== 'QAManager')
			{
				header('Location: QAManager.php');
				
			}
			else
			{
				
				header('Location: Homepage.php');
			}
			
		}
		else
		{
			mysqli_query($conn, "UPDATE likedislikerecord SET VoteType ='-1' WHERE VUserID = '".$UserID."' AND VIdeaID = '".$IdeaID."'");
			mysqli_query($conn, "UPDATE ideas SET likes = likes - 1 WHERE IdeaID = '".$IdeaID."'");
			
		}
		
	}
	else
	{
		mysqli_query($conn, "INSERT INTO likedislikerecord (VUserID, VIdeaID, VoteType) VALUES ('".$UserID."', '".$IdeaID."', '".$voteTypeT."')");
        mysqli_query($conn, "UPDATE ideas SET likes = likes - 1 WHERE IdeaID = '".$IdeaID."'");
		
    }
}




if($row['Roles']== 'DPManager')
{
	header('Location: DPManager.php');
}
else if ($row['Roles']== 'QAManager')
{
	header('Location: QAManager.php');
	
}
else
{
	header('Location: Homepage.php');
}





?>