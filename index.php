<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="guitar, guitar riffs, online game, competition, high score" />
    <meta name="description" content="Guitar Wars is a fun and challenging online game where players compete to score
    the most points by playing guitar riffs." />
    <title>Guitar Wars - The Guitar Competiton</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<h2>Guitar Wars - High Scores</h2>
<p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
<hr />

<?php
require_once ('inc/appvars.php');
require_once ('inc/connectvars.php');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Retrieve the score data from MySQL
$query = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";
$data = mysqli_query($dbc, $query);

// Loop through the array of score data, formatting it as HTML
echo '<table>';
$i = 0;
while ($row = mysqli_fetch_array($data)) {
    // Display the score data
    if ($i === 0) {
        echo '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
    }
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td>';
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
        echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score Screenshot" /></td></tr>';
    }
    else {
        echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified Score" /></td></tr>';
    }
    $i++;
}
echo '</table>';

mysqli_close($dbc);
?>

</body>
</html>

