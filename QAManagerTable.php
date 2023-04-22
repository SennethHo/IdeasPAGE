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
$DPmanager=$row['Department']
?>



<!DOCTYPE HTML>
<HTML>      
	<HEAD>
		<TITLE>DPhomepage</TITLE>
		
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
				<a href="QAManager.php"><span class="word">Home</span> </a>
			</li>
			<li class="options option2">
				<img class="icons profile"src="huh.png"></img>
				<span class="word"><?php echo $row['Name']; ?></span>
			</li>			
			<hr class="divider">			
			<li class="options option3">
				<img class="icons posted"src="device.png"></img>
				<span class="word">Ideas</span>
			</li>
		</ul>
		
		<div class="content">
		<div class="create">	
		<table id="Database">
			  <tr>
				<th>ID</th>
				<th>Description</th>
				<th>Author Name</th>
				<th>likes</th>
			  </tr>		 
			 <?php

			 $querytabledata = mysqli_query($conn, "SELECT * FROM ideas");
			  while ($row2 = mysqli_fetch_assoc($querytabledata)) {
				$authorID= $row2["authorID"];
				$queryAuthorName = mysqli_query($conn,"select * from user WHERE UserID = '".$authorID."'");
				$rowGetADetails = mysqli_fetch_assoc($queryAuthorName);
				echo "<tr>";
				echo "<td>" . $row2['ideaID'] . "</td>";
				echo "<td>" . $row2['Description'] . "</td>";
				echo "<td>" . $rowGetADetails['Name'] . "</td>";
				echo "<td>" . $row2['likes'] . "</td>";
				echo "<td><button onclick='deleteRow(this)'>DELETE</button></td>";
				echo "</tr>";
			  }?>
  
			</table>
			<script>
			function deleteRow(button) {
			var row = button.parentNode.parentNode;
			var cells = row.getElementsByTagName("td");
			var id = cells[0].innerText;

			// Confirm the delete action
			if (confirm("Are you sure you want to delete this row?")) {
			  // Send an AJAX request to delete the row
			  var xhr = new XMLHttpRequest();
			  xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  // Remove the row from the table
				  row.parentNode.removeChild(row);
				}
			  };
			  xhr.open("GET", "deleteidea.php?id=" + id, true);
			  xhr.send();
			}
		  }
			
			</script>
	</BODY>
</HTML>
 
