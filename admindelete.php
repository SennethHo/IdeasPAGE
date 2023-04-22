
<?php
	// Get the row ID from the request
	$id = $_GET['id'];

	session_start();
	include('conn.php');

	
	// Prepare and execute the DELETE statement
	$stmt = mysqli_prepare($conn, "DELETE FROM user WHERE UserID = ?");
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);

	// Check if any rows were affected
	if (mysqli_affected_rows($conn) > 0) {
	  echo "Row deleted successfully";
	} else {
	  echo "Error deleting row";
	}

	// Close the database connection
	mysqli_close($conn);
?>