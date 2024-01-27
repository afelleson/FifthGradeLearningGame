<!-- Leaderboard index -->

If this page is blank, there's probably a problem with the database. Either the login credentials are wrong, or an expected database, table, column, etc., is not being found.

<?php

require_once('/etc/LearningGame/config.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$week_table_name = "WeekLeaderboard";
$month_table_name = "MonthLeaderboard";
$alltime_table_name = "AllTimeLeaderboard";

//create connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//get data from database
$weektable = mysqli_query($connection, "SELECT * FROM " . $week_table_name . " ORDER BY Score DESC");
$monthtable = mysqli_query($connection, "SELECT * FROM " . $month_table_name . " ORDER BY Score DESC");
$alltable = mysqli_query($connection, "SELECT * FROM " . $alltime_table_name . " ORDER BY Score DESC");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="./leaderboard.css">
    <link rel="stylesheet" href="../starstyle.css">
  </head>
  <body>

  <div class=header
    <header>LEADERBOARD <i class="fa-solid fa-rocket"></i></header>
  </div>


  <div class="button-group" data-left="4px">
    <button onClick="buttonClick('4px');showtable('WeekTable');">This week</button>
    <button onClick="buttonClick('33%');showtable('MonthTable');">This month</button>
    <button onClick="buttonClick('66%');showtable('AllTimeTable');">All time</button>
  </div>


  <div class="tableFixHead" id="WeekTable">
    <table>
      <thead>
        <tr>
          <th>Rank</th>
          <th></th>
          <th>Name</th>
          <th>Badges</th>
          <th>Score</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $rank = 0;
        while ($row = mysqli_fetch_array($weektable)) {
          $rank++; ?>
          <tr> <td> <?php echo strval($rank); ?> </td>
          <td> <?php echo $row['Avatar']; ?> </td>
          <td> <?php echo $row['Name']; ?> </td>
          <td> <?php
            //if student has a badge, append the appropriate icon html to their badges array
            if($row['FirstTry']==1){echo '<div class="tooltip"><object data="./BadgeIcons/dictionary.svg" height="30"></object><span class="tooltiptext">Guessed a word on the first try</span></div> ';}
            if($row['Five']==1){echo '<div class="tooltip"><object data="./BadgeIcons/five.svg" height="30"></object><span class="tooltiptext">Got a 5-question streak</span></div> ';}
            if($row['Ten']==1){echo '<div class="tooltip"><object data="./BadgeIcons/ten.svg" height="30"></object><span class="tooltiptext">Got a 10-question streak</span></div> ';}
            if($row['Coins']==1){echo '<div class="tooltip"><object data="./BadgeIcons/coins.svg" height="30"></object><span class="tooltiptext">Collected 10000 coins</span></div> ';}
            if($row['Mars']==1){echo '<div class="tooltip"><object data="./BadgeIcons/mars.svg" height="30"></object><span class="tooltiptext">Reached Mars</span></div> ';}
            if($row['Jupiter']==1){echo '<div class="tooltip"><object data="./BadgeIcons/jupiter.svg" height="30"></object><span class="tooltiptext">Reached Jupiter</span></div> ';}
            if($row['Saturn']==1){echo '<div class="tooltip"><object data="./BadgeIcons/saturn.svg" height="30"></object><span class="tooltiptext">Reached Saturn</span></div> ';}
            if($row['Uranus']==1){echo '<div class="tooltip"><object data="./BadgeIcons/uranus.svg" height="30"></object><span class="tooltiptext">Reached Uranus</span></div> ';}
            if($row['Neptune']==1){echo '<div class="tooltip"><object data="./BadgeIcons/neptune.svg" height="30"></object><span class="tooltiptext">Reached Neptune</span></div> ';}
            if($row['Pluto']==1){echo '<div class="tooltip"><object data="./BadgeIcons/pluto.svg" height="30"></object><span class="tooltiptext">Reached Pluto</span></div> ';}
            if($row['Space']==1){echo '<div class="tooltip"><object data="./BadgeIcons/stars.svg" height="30"></object><span class="tooltiptext">Reached space</span></div> ';}
            if($row['FiveAsteroids']==1){echo '<div class="tooltip"><object data="./BadgeIcons/asteroid.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
            if($row['DayChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/day.svg" height="30"></object><span class="tooltiptext">Current best of the day</span></div> ';}
            if($row['WeekChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/calendar.svg" height="30"></object><span class="tooltiptext">Has ended a week as week champ</span></div> ';}
            if($row['LongestStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/streak.svg" height="30"></object><span class="tooltiptext">Holds the record for longest streak</span></div> ';}
            if($row['LongestActiveStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/activestreak.svg" height="30"></object><span class="tooltiptext">Longest active streak</span></div> ';} ?> </td>
          <td> <?php echo $row['Score']; ?> </td>
          </tr>
        <?php } //end loop over rows ?>
    </table>
  </div>

  <div class="tableFixHead" id="MonthTable" style="display:none">
    <table>
      <thead>
        <tr>
          <th>Rank</th>
          <th></th>
          <th>Name</th>
          <th>Badges</th>
          <th>Score</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $rank = 0;
        while ($monthrow = mysqli_fetch_array($monthtable)) {
          $rank++; ?>
          <tr> <td> <?php echo strval($rank); ?> </td>
          <td> <?php echo $monthrow['Avatar']; ?> </td>
          <td> <?php echo $monthrow['Name']; ?> </td>
          <td> <?php
            //if student has a badge, append the appropriate icon html to their badges array
            if($monthrow['FirstTry']==1){echo '<div class="tooltip"><object data="./BadgeIcons/dictionary.svg" height="30"></object><span class="tooltiptext">Guessed a word on the first try</span></div> ';}
            if($monthrow['Five']==1){echo '<div class="tooltip"><object data="./BadgeIcons/five.svg" height="30"></object><span class="tooltiptext">Got a 5-question streak</span></div> ';}
            if($monthrow['Ten']==1){echo '<div class="tooltip"><object data="./BadgeIcons/ten.svg" height="30"></object><span class="tooltiptext">Got a 10-question streak</span></div> ';}
            if($monthrow['Coins']==1){echo '<div class="tooltip"><object data="./BadgeIcons/coins.svg" height="30"></object><span class="tooltiptext">Collected 10000 coins</span></div> ';}
            if($monthrow['Mars']==1){echo '<div class="tooltip"><object data="./BadgeIcons/mars.svg" height="30"></object><span class="tooltiptext">Reached Mars</span></div> ';}
            if($monthrow['Jupiter']==1){echo '<div class="tooltip"><object data="./BadgeIcons/jupiter.svg" height="30"></object><span class="tooltiptext">Reached Jupiter</span></div> ';}
            if($monthrow['Saturn']==1){echo '<div class="tooltip"><object data="./BadgeIcons/saturn.svg" height="30"></object><span class="tooltiptext">Reached Saturn</span></div> ';}
            if($monthrow['Uranus']==1){echo '<div class="tooltip"><object data="./BadgeIcons/uranus.svg" height="30"></object><span class="tooltiptext">Reached Uranus</span></div> ';}
            if($monthrow['Neptune']==1){echo '<div class="tooltip"><object data="./BadgeIcons/neptune.svg" height="30"></object><span class="tooltiptext">Reached Neptune</span></div> ';}
            if($monthrow['Pluto']==1){echo '<div class="tooltip"><object data="./BadgeIcons/pluto.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
            if($monthrow['Space']==1){echo '<div class="tooltip"><object data="./BadgeIcons/stars.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
            if($monthrow['FiveAsteroids']==1){echo '<div class="tooltip"><object data="./BadgeIcons/asteroid.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
            if($monthrow['DayChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/day.svg" height="30"></object><span class="tooltiptext">Current best of the day</span></div> ';}
            if($monthrow['WeekChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/calendar.svg" height="30"></object><span class="tooltiptext">Has ended a week as week champ</span></div> ';}
            if($monthrow['LongestStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/streak.svg" height="30"></object><span class="tooltiptext">Holds the record for longest streak</span></div> ';}
            if($monthrow['LongestActiveStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/activestreak.svg" height="30"></object><span class="tooltiptext">Longest active streak</span></div> ';} ?> </td>
          <td> <?php echo $monthrow['Score']; ?> </td>
          </tr>
        <?php } //end loop over rows ?>
    </table>
    </div>

    <div class="tableFixHead" id="AllTimeTable" style="display:none;">
      <table>
        <thead>
          <tr>
            <th>Rank</th>
            <th></th>
            <th>Name</th>
            <th>Badges</th>
            <th>Score</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $rank = 0;
          while ($monthrow = mysqli_fetch_array($alltable)) {
            $rank++; ?>
            <tr> <td> <?php echo strval($rank); ?> </td>
            <td> <?php echo $monthrow['Avatar']; ?> </td>
            <td> <?php echo $monthrow['Name']; ?> </td>
            <td> <?php
              //if student has a badge, append the appropriate icon html to their badges array
              if($monthrow['FirstTry']==1){echo '<div class="tooltip"><object data="./BadgeIcons/dictionary.svg" height="30"></object><span class="tooltiptext">Guessed a word on the first try</span></div> ';}
              if($monthrow['Five']==1){echo '<div class="tooltip"><object data="./BadgeIcons/five.svg" height="30"></object><span class="tooltiptext">Got a 5-question streak</span></div> ';}
              if($monthrow['Ten']==1){echo '<div class="tooltip"><object data="./BadgeIcons/ten.svg" height="30"></object><span class="tooltiptext">Got a 10-question streak</span></div> ';}
              if($monthrow['Coins']==1){echo '<div class="tooltip"><object data="./BadgeIcons/coins.svg" height="30"></object><span class="tooltiptext">Collected 10000 coins</span></div> ';}
              if($monthrow['Mars']==1){echo '<div class="tooltip"><object data="./BadgeIcons/mars.svg" height="30"></object><span class="tooltiptext">Reached Mars</span></div> ';}
              if($monthrow['Jupiter']==1){echo '<div class="tooltip"><object data="./BadgeIcons/jupiter.svg" height="30"></object><span class="tooltiptext">Reached Jupiter</span></div> ';}
              if($monthrow['Saturn']==1){echo '<div class="tooltip"><object data="./BadgeIcons/saturn.svg" height="30"></object><span class="tooltiptext">Reached Saturn</span></div> ';}
              if($monthrow['Uranus']==1){echo '<div class="tooltip"><object data="./BadgeIcons/uranus.svg" height="30"></object><span class="tooltiptext">Reached Uranus</span></div> ';}
              if($monthrow['Neptune']==1){echo '<div class="tooltip"><object data="./BadgeIcons/neptune.svg" height="30"></object><span class="tooltiptext">Reached Neptune</span></div> ';}
              if($monthrow['Pluto']==1){echo '<div class="tooltip"><object data="./BadgeIcons/pluto.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
              if($monthrow['Space']==1){echo '<div class="tooltip"><object data="./BadgeIcons/stars.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
              if($monthrow['FiveAsteroids']==1){echo '<div class="tooltip"><object data="./BadgeIcons/asteroid.svg" height="30"></object><span class="tooltiptext">Destroyed 5 asteroids in one run</span></div> ';}
              if($monthrow['DayChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/day.svg" height="30"></object><span class="tooltiptext">Current best of the day</span></div> ';}
              if($monthrow['WeekChamp']==1){echo '<div class="tooltip"><object data="./BadgeIcons/calendar.svg" height="30"></object><span class="tooltiptext">Has ended a week as week champ</span></div> ';}
              if($monthrow['LongestStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/streak.svg" height="30"></object><span class="tooltiptext">Holds the record for longest streak</span></div> ';}
              if($monthrow['LongestActiveStreak']==1){echo '<div class="tooltip"><object data="./BadgeIcons/activestreak.svg" height="30"></object><span class="tooltiptext">Longest active streak</span></div> ';} ?> </td>
            <td> <?php echo $monthrow['Score']; ?> </td>
            </tr>
          <?php } //end loop over rows ?>
      </table>
      </div>

  <div id="stars"></div>
	<div id="stars2"></div>
	<div id="stars3"></div>
      
  <script src="./leaderboard.js"></script>
  </body>
</html>
