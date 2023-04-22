<?php
/*Database Connection File*/
//mysqli_connect(server, username, password, database)

$conn = mysqli_connect("localhost", "root", "", "dbidea");

//check connection error - return error code
if(mysqli_connect_errno()) //help to identify the type of error
{
    //mysqli_connect_error - return error description
    echo "Failed to connect to database: ".mysqli_connect_error();

}
?>