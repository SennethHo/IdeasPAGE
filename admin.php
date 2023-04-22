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
			<table id = "Database">
			  <tr>
				<a><th>ID</th><a>
				<th>Email</th>
				<th>Name</th>
				<th>Roles</th>
				<th>Department</th>
			  </tr>		 
			 <?php
			 $querytabledata = mysqli_query($conn, "SELECT * FROM user WHERE Roles <> 'admin'");
			  while ($row2 = mysqli_fetch_assoc($querytabledata)) {
				echo "<tr>";
				echo "<td>" . $row2['UserID'] . "</td>";
				echo "<td>" . $row2['Email'] . "</td>";
				echo "<td>" . $row2['Name'] . "</td>";
				echo "<td>" . $row2['Roles'] . "</td>";
				echo "<td>" . $row2['Department'] . "</td>";
				echo "<td><button onclick='editRow(this)'>UPDATE</button> <button onclick='deleteRow(this)'>DELETE</button></td>";
				echo "</tr>";
			  }?>
  
			</table>
			<div class = "buttonrow">
				<a href="adminadd.php">
				<button>
					ADD
				</button>
				</a>
			</div>
		</div>
		<?php if(isset($_GET['edit'])) { ?>
                    <?php 
                        if ($_GET['edit'] == 'success') 
                        {
                            echo "<script>alert('User Updated');</script>";
                        }
                    ?>
                <?php } ?>
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
			  xhr.open("GET", "admindelete.php?id=" + id, true);
			  xhr.send();
			}
		  }
		
		
		
		
		
			
		  function editRow(button) {
			var row = button.parentNode.parentNode;
			var cells = row.getElementsByTagName("td");
			var id = cells[0].innerText;
			var email = cells[1].innerText;
			var name = cells[2].innerText;
			var roles = cells[3].innerText;

			// Prompt the user to enter the updated information
			email = prompt("Enter updated email", email);
			if(email == null)
			{
				 email = cells[1].innerText;
			}
			name = prompt("Enter updated name", name);
			if(name == null)
			{
				 name = cells[2].innerText;
			}
			roles = prompt("Enter updated roles", roles);
			if(roles == null)
			{
				 roles = cells[3].innerText;
			}

			// Send an AJAX request to update the user's information in the database
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					// Update the row in the table with the new information
					cells[1].innerText = email;
					cells[2].innerText = name;
					cells[3].innerText = roles;
					alert("User updated successfully!");
				}
			};
			xhr.open("POST", "adminedit.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.send("id=" + id + "&email=" + email + "&name=" + name + "&roles=" + roles);
		}
		
		
		</script>
	

	</BODY>
</HTML>