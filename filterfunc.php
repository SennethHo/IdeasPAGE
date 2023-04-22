<?php
session_start();

include('conn.php');

$category = $_POST['category'];

if ($category == 'all') {
  $queryidea = mysqli_query($conn, "SELECT * FROM ideas ORDER BY ideaID DESC");
} else {
  $queryidea = mysqli_query($conn, "SELECT * FROM ideas WHERE Category = '$category' ORDER BY ideaID DESC");
}

while ($rowIdea = mysqli_fetch_array($queryidea)) {
	$authorID= $rowIdea["authorID"];
	$queryAName = mysqli_query($conn,"select * from user WHERE UserID = '".$authorID."'");
	$rowGetADetails = mysqli_fetch_assoc($queryAName);
	$rowGetCategory = $rowIdea['Category'];
	
  echo '<div class="created">';
	echo'<div class="user">';
		
				echo'<img class="profile"src="huh.png"></img>';
				echo '<p class ="name">';
				
				
				echo "<br>".$rowGetADetails['Name']."<br>";
				echo $rowGetCategory."<br>";
				echo $rowIdea["Description"];
				
				echo '</p>';
			echo'</div>';
			
			
			echo '<form method="post" action="LikeDislikeFunction.php">';
			
			echo '<input type="hidden" name="IdeaID" value="<?php echo $rowIdea["ideaID"]; ?>">';
			  echo '<div class="like">';
				echo'<p>';
				  
					echo $rowIdea["likes"];
				  
				echo '</p>
				<img class="liked" width="25px" height="25px" src="like.png">&nbsp;</img>
			  </div>
			  <div class="option">
				<button class="upvote" type="submit" name="upvote">Like</button>';
				
				$validlike = mysqli_query($conn, "SELECT * FROM likedislikerecord WHERE VUserID ='".$_SESSION['id']."' AND VIdeaID ='".$rowIdea["ideaID"]."' AND VoteType='1'");
				if(mysqli_num_rows($validlike) == 1)
				{
					echo '<button class="downvote" type="submit" name="downvote">Dislike</button>';
				}else
				{
					
					echo '<button class="downvote" type="submit" name="downvote" disabled>Dislike</button>';
				}
				
				
			  echo '</div>
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
						<div class="user">';

								
								$queryComment = mysqli_query($conn, "SELECT * FROM comment WHERE IdeaID = '".$rowIdea['ideaID']."' ORDER BY CommentID DESC");
								while ($rowComment = mysqli_fetch_array($queryComment)) {	
									$CommentUserID= $rowComment['CUserID'];
									$queryCName = mysqli_query($conn,"select * from user WHERE UserID = '".$CommentUserID."'");
									$rowGetCDetails = mysqli_fetch_assoc($queryCName);
							
							echo '<img class="profile"src="huh.png"></img>
							<p class ="name">';
								
								echo "<br>".$rowGetCDetails['Name']."<br>";
								echo $rowComment["CommentDescription"]."<br>";
								
								
							echo '</p>';

								 }
						echo '</div>
					</div>
					

						
					</div>

						
					</div>
				</div>	
			</div>';
			
			}
  echo '</div>';
?>