<?php
session_start();

include('conn.php');
?>
<!DOCTYPE HTML>
<HTML>      
	<HEAD>
		<TITLE>Login</TITLE>
		
		<link rel = "stylesheet" href="css/main.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		
		<!-- Favicons -->
		<link rel="Segi" sizes="180x180" href="Segi.png">
		<!--<link rel="icon" type="image/png" sizes="32x32" href="Code/Segi.png">
		<link rel="icon" type="image/png" sizes="16x16" href="Code/Segi.png">
		<link rel="manifest" href="/site.webmanifest">-->
		
	</HEAD>
	<BODY>
		<div class = "intro">
			<img class = "logo" src = "Segi.png"></img>
			<form class = "login" method = "post" action ="LoginFunction.php">
				<label>
					Login
				</label>
				<br>
				<input class = "email" name="email" type = "email" placeholder=" Email Address">
				<br>
				<input class = "password" name="password" type = "password" placeholder=" Password">
				<br>
				
				
				<div>
					<input type = "checkbox" class = "terms" id = "TnC" />
					<p> I Have Read & Agree to 
						<a href="">
							Terms and Conditions
						</a>
					</p>
				</div>
				<input class = "button" name="login" type = "submit" value = "Login">
				
			</form>
		</div>
	
			

		<?php  
					if(isset($_GET['login'])) {
						if ($_GET['login'] == 'failed')
                            {
								
                                echo "<script>alert('User not found !');</script>";
							}
							else if ($_GET['login'] == 'true')
                            {
								
                                echo "<script>alert('U got in!');</script>";
							}
							else if ($_GET['login'] == 'notfilled')
                            {
								
                                echo "<script>alert('Not filled!');</script>";
							}
	
                        ?>
                    <?php } ?>
					<script>
						document.querySelector(".login").addEventListener("submit", login);

					function login(event) {
						if(!document.getElementById("TnC").checked) {
							alert("Checkbox was not ticked");
							event.preventDefault(); 
						}
					}
					</script>
	</BODY>
	
</HTML>
