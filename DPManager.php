<?php
session_start();

include('conn.php');

if(!isset($_SESSION['id']) || trim($_SESSION['id']==''))
{
    header('Location: Homepage.php#last-scroll-position');
    exit(); //terminate the session/script
}


//select unique record using primary key
$query = mysqli_query($conn, "select * from user where UserID = '".$_SESSION['id']."'");
$row = mysqli_fetch_assoc($query);
?>



<!DOCTYPE HTML>
<HTML>      
	<HEAD>
		<TITLE>DPhomepage</TITLE>
		<link rel ="stylesheet" href = "css/Home.css">
		<link rel ="stylesheet" href = "css/navbar.css">
		
		
	</HEAD>
	<BODY>
		<ul class="navbar">
			<div class="navL">
				<li>
					<img class="nav-logo segi" width="200px" src="Segi.png"></img>
				</li>
			</div>
			<div class="navFilter">
			  <form method="post">
				<label for="filtercategory">Filter by Category:</label>
				<select id="filtercategory" name="filtercategory">
				  <option value="all">All Category</option>
				  <option value="Schedule">Schedule</option>
				  <option value="Management">Management</option>
				</select>
				<button type="submit" name="filter">Filter</button>
			  </form>
			</div>
			<div class="navR">
				<li>
					<a href="Login.php">
					<button class="LogOut">
						Log Out
					</button>
					</a>
				</li>
			</div>
		</ul>
		<ul class="sidebar">
			<li class="options option1">
				<img class="icons home"src="house.png"></img>
				<span class="word">Home</span>
			</li>
			<li class="options option2">
				<img class="icons profile"src="huh.png"></img>
				<span class="word"><?php echo $row['Name']; ?></span>
			</li>			
			<hr class="divider">			
			<li class="options option3">
				<img class="icons posted"src="device.png"></img>
				<a href="DPManagerTable.php"><span class="word">Ideas</span></a>
			</li>
		</ul>
		
		<div class="content">
		<div class="create">		
			<form method = "post" action = "saveidea.php" enctype = "multipart/form-data" class="ideas">
				<img class="profile"src="huh.png"></img>				
				<textarea class="suggest" name = "Description" placeholder="Share Your Ideas ..."></textarea>
				<br/>
				<label>category: </label>
					<select name ="categorychoice" id ="category">
						<option value="Schedule"> Schedule</option>
						<option value="Management"> Management</option>
					</select>
				<input class = "post" type = "submit" value = "Post" name="post"/>
			</form>
			<?php if(isset($_GET['idea'])) { ?>
                    <?php 
                        if ($_GET['idea'] == 'success') 
                        {
                            echo "<script>alert('Idea Added Successfully');</script>";
                        }
                        else if ($_GET['idea'] == 'error')
                        {
                            echo "<script>alert('Idea was not filled!');</script>";
                        }
                    ?>
                <?php } ?>
				<?php if(isset($_GET['comment'])) { ?>
                    <?php 
                        if ($_GET['comment'] == 'success') 
                        {
                            echo "<script>alert('Comment Added Successfully');</script>";
                        }
                        else if ($_GET['comment'] == 'error')
                        {
                            echo "<script>alert('Comment was not filled!');</script>";
                        }
                    ?>
                <?php } ?>
		</div>		
	
		<?php
				
				if (isset($_POST['filter'])) {
				$filcat = $_POST['filtercategory'];
				if ($filcat == 'all') {
				  $ideas = $conn->query("SELECT * FROM ideas ORDER BY ideaID DESC");
				} else {
				  $ideas = $conn->query("SELECT * FROM ideas WHERE Category ='$filcat' ORDER BY ideaID DESC");
				}
			  } else {
				$ideas = $conn->query("SELECT * FROM ideas ORDER BY ideaID DESC");
			  }
				while ($rowIdea = mysqli_fetch_array($ideas)) {
					$authorID= $rowIdea["authorID"];
					$queryAName = mysqli_query($conn,"select * from user WHERE UserID = '".$authorID."'");
					$rowGetADetails = mysqli_fetch_assoc($queryAName);
					$rowGetCategory = $rowIdea['Category'];
				?>
		
		<div class= "created">
			<div class="user">
		
				<img class="profile"src="huh.png"></img>
				<p class ="name">
				<?php
				
				echo "<br>".$rowGetADetails['Name']."<br>";
				echo $rowGetCategory."<br>";
				echo $rowIdea["Description"];
				?>
				</p>
			</div>
			
			
			<form method="post" action="LikeDislikeFunction.php">
			
			<input type="hidden" name="IdeaID" value="<?php echo $rowIdea["ideaID"]; ?>">
			  <div class="like">
				<p>
				  <?php
					echo $rowIdea["likes"];
				  ?>
				</p>
				<img class="liked" width="25px" height="25px" src="like.png">&nbsp;</img>
			  </div>
			  <div class="option">
				<button class="upvote" type="submit" name="upvote">Like</button>
				<?php
				$validlike = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID ='".$_SESSION['id']."' AND VIdeaID ='".$rowIdea["ideaID"]."' AND VoteType='1'");
				if(mysqli_num_rows($validlike) == 1)
				{
					echo '<button class="downvote" type="submit" name="downvote">Dislike</button>';
				}else
				{
					
					echo '<button class="downvote" type="submit" name="downvote" disabled>Dislike</button>';
				}
				?>
			  </div>
				<button class="commentbtn" id="commentbtn" type="button" name="commentbtn" data-ideaid="<?php echo $rowIdea["ideaID"]; ?>">
				  Comment
				</button>			  
			  
			</form>
			<div id="commentform-<?php echo $rowIdea["ideaID"]; ?>" class="commentform">
				<div class = "commentcontent">
					<div class = "commenthere">
						<span class="close">&times;</span>								
						<form method = "post" action = "savecomment.php" enctype = "multipart/form-data" class="comment">
						 <input type="hidden" name="IdeaID" value="<?php echo $rowIdea["ideaID"]; ?>">
						<textarea class="commentbox" name="CommentDescription" placeholder="Comment....."></textarea>		
						<input class = "commented" type = "submit" value = "Post" name="commented"/>
							
						</form>
						<div class= "commenters">
						<div class="user">

								<?php
								$queryComment = mysqli_query($conn, "SELECT * FROM comment WHERE IdeaID = '".$rowIdea['ideaID']."' ORDER BY CommentID DESC");
								while ($rowComment = mysqli_fetch_array($queryComment)) {	
									$CommentUserID= $rowComment['CUserID'];
									$queryCName = mysqli_query($conn,"select * from user WHERE UserID = '".$CommentUserID."'");
									$rowGetCDetails = mysqli_fetch_assoc($queryCName);
							?>
							<img class="profile"src="huh.png"></img>
							<p class ="name">
								<?php
								echo "<br>".$rowGetCDetails['Name']."<br>";
								echo $rowComment["CommentDescription"]."<br>";
								
								?>
							</p>

								<?php } ?>
						</div>
					</div>
					

						
					</div>

						
					</div>
				</div>	
		</div>
		
		<?php }?>

		</div>
		
    <script>
	const commentBtns = document.querySelectorAll('.commentbtn');
	  const commentForms = document.querySelectorAll('.commentform');
	  const closeBtns = document.querySelectorAll('.close');

	  commentBtns.forEach((btn) => {
		btn.addEventListener('click', () => {
		  const ideaID = btn.getAttribute('data-ideaid');
		  const commentForm = document.querySelector(`#commentform-${ideaID}`);
		  commentForm.style.display = 'block';
		});
	  });

	  closeBtns.forEach((btn) => {
		btn.addEventListener('click', () => {
		  const commentForm = btn.closest('.commentform');
		  commentForm.style.display = 'none';
		});
	  });
        
    </script>
	</BODY>
</HTML>
 
