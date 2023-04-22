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
						<span class="word">Table 1</span>
					</a>
				</li>
				<li>
					<a href="admin2.php">
						<span class="word">Table 2</span>
					</a>
				</li>
			</div>
		</ul>
		
		<div class ="content">
		<form method="post" action="addfunc.php">
		<h1>Add User</h1>
		<label for="email">Email</label>
		<input type="text" name="email" id="email" required>

		<label for="password">Password</label>
		<input type="password" name="password" id="password" required>

		<label for="name">Name</label>
		<input type="text" name="name" id="name" required>

		<label for="roles">Roles</label>
		<select name="roles" id="roles" required>
			<option value="">Select a role</option>
			<option value="Normal">Normal</option>
			<option value="DPManager">DPManager</option>
			<option value="QAManager">QAManager</option>
		</select>
		
		<label for="department">Department</label>
		<select name="department" id="department" required>
			<option value="">Select a department</option>
			<option value="InformatioTechnology">Information Technology</option>
			<option value="Culinary">Culinary</option>
			<option value="Business">Business</option>
		</select>
		
		<input type="submit" value="Add User" name="addsubmit">
	</form>
		
		<?php if(isset($_GET['add'])) { ?>
                    <?php 
                        if ($_GET['add'] == 'success') 
                        {
                            echo "<script>alert('User added');</script>";
                        }
                        else if ($_GET['add'] == 'error')
                        {
                            echo "<script>alert('User not added');</script>";
                        }
                    ?>
                <?php } ?>
		 
		
			
		</div>
	</BODY>
</HTML>