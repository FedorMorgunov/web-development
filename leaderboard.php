<?php
session_start();
include 'navbar.php';

// check if the user's name and score are set in the session
if (isset($_SESSION['username']) && isset($_POST['score'])) {
    // add the user's name and score to the leaderboard array
    $leaderboard = array();
    if (file_exists('leaderboard.txt')) {
        $leaderboard_json = file_get_contents('leaderboard.txt');
        $leaderboard = json_decode($leaderboard_json, true);
    }
    $username = $_SESSION['username'];
    $score = $_POST['score'];
    // check if the user already has a score in the leaderboard
    $userIndex = array_search($username, array_column($leaderboard, 'username'));
    if ($userIndex !== false) {
        // if the user already has a score, update it if the new score is better
        if ($score > $leaderboard[$userIndex]['score']) {
            $leaderboard[$userIndex]['score'] = $score;
        }
    } else {
        // if the user doesn't have a score, add it to the leaderboard
        $leaderboard[] = array('username' => $username, 'score' => $score);
    }
    // sort the leaderboard array by score in descending order
    usort($leaderboard, function($a, $b) {
        return $b['score'] - $a['score'];
    });

    // store the leaderboard array in a file
    $leaderboard_json = json_encode($leaderboard);
    file_put_contents('leaderboard.txt', $leaderboard_json);
}

// HTML code for the leaderboard page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Meta viewport tag for responsive layout -->
<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    #leaderboard {
        background-color: #f2f2f2;
        box-shadow: 5px 5px 5px grey;
        padding: 10px;
        margin: 0 auto;
        max-width: 800px;
    }
    table {
        border-collapse: separate;
        border-spacing: 2px;
        width: 100%;
    }
    th {
        background-color: blue;
        color: white;
    }
    th, td {
        padding: 5px;
        text-align: center;
        border: 1px solid black;
    }
    /* Responsive styles */
    @media screen and (max-width: 600px) {
        #leaderboard {
            padding: 5px;
        }
        th, td {
            padding: 2px;
        }
    }
</style>

</head>
<body>
    <div id="leaderboard">
        <h1>Leaderboard</h1>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Best Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // PHP code to populate the leaderboard
                    if (file_exists('leaderboard.txt')) {
                        $leaderboard_json = file_get_contents('leaderboard.txt');
                        $leaderboard = json_decode($leaderboard_json, true);
                        foreach ($leaderboard as $user) {
                            echo "<tr>";
                            echo "<td>".$user['username']."</td>";
                            echo "<td>".$user['score']."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>