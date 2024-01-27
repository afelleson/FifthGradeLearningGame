<!-- Ajax Call -->

<?php

require_once('/etc/LearningGame/config.php');

$username = $_REQUEST["username"];
$dayuserscore = $_REQUEST["dayuserscore"];
$weekuserscore = $_REQUEST["weekuserscore"];
$monthuserscore = $_REQUEST["monthuserscore"];
$alltimeuserscore = $_REQUEST["alltimeuserscore"];
$userid = $_REQUEST["userid"];
if(!$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME))
{

	die("failed to connect!");
}

$query1 = "UPDATE DayLeaderboard SET score= '$dayuserscore' where user_id='$userid'";
$query2 = "UPDATE MonthLeaderboard SET score= '$monthuserscore' where user_id='$userid'";
$query3 = "UPDATE WeekLeaderboard SET score= '$weekuserscore' where user_id='$userid'";
$query4 = "UPDATE AllTimeLeaderboard SET score= '$alltimeuserscore' where user_id='$userid'";

mysqli_query($connection, $query1);
mysqli_query($connection, $query2);
mysqli_query($connection, $query3);
mysqli_query($connection, $query4);
?>
