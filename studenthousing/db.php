<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_housing2";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sh_db_result = mysqli_select_db($conn,$dbname);
if(!$sh_db_result)
{
    mysqli_close($conn);
    die("Selection problem..");
}
    
@mysqli_query($conn, "SET NAMES 'utf8'");

function sh_db_close()
{
    global $conn;
    @mysqli_close($conn);
}  



?>
