<?php
session_start();

include('conn.php');

if(!isset($_SESSION['id']) || trim($_SESSION['id']==''))
{
    header('Location: admin.php');
    exit(); //terminate the session/script
}


//select unique record using primary key
$query = mysqli_query($conn, "select * from user where UserID = '".$_SESSION['id']."'");
$row = mysqli_fetch_assoc($query);

?>
<!DOCTYPE HTML>
<HTML>      
	<HEAD>
		<link rel ="stylesheet" href = "css/navbar.css">
		<link rel ="stylesheet" href = "css/admin.css">
	</HEAD>
	<BODY>
		<ul class="navbar">
			<div class="navL">
				<li>
					<img class="nav-logo segi" width="200px" src="Segi.png"></img>
				</li>
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
			<div class="list">
				
				<li>
					<a href="admin.php">
						<span class="word">User</span>
					</a>
				</li>
				<li>
					<a href="admin2.php">
						<span class="word">Idea</span>
					</a>
				</li>
			</div>
		</ul>
		
		<div class ="content">
			<table id="Database">
			  <tr>
				<th>ID</th>
				<th>Description</th>
				<th>AuthorID</th>
				<th>likes</th>
			  </tr>		 
			 <?php
			 $querytabledata = mysqli_query($conn, "SELECT * FROM ideas");
			  while ($row2 = mysqli_fetch_assoc($querytabledata)) {
				echo "<tr>";
				echo "<td>" . $row2['ideaID'] . "</td>";
				echo "<td>" . $row2['Description'] . "</td>";
				echo "<td>" . $row2['authorID'] . "</td>";
				echo "<td>" . $row2['likes'] . "</td>";
				echo "</tr>";
			  }?>
  
			</table>
		
		</div>
		
	</BODY>
</HTML>