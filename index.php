<?php
include "php/db/tableQuery.php";
include "php/back-end/gameHistoryTableFunction.php";
$gamesHistory = getGamesHistory($db);
$bestGameScore = getBestScore($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['resultScore']) && isset($_POST['resultRoundTime']) && isset($_POST['resultTimeDate'])) {
        // Save results from last game
        $lastGameScore = intval($_POST['resultScore']);
        $lastGameRoundTime = intval($_POST['resultRoundTime']);
        $lastGameTimeDate = $_POST['resultTimeDate'];

        // Save it into database
        $stmt = $db->prepare("INSERT INTO games_history (score, date, roundtime) VALUES (:score, :date, :roundtime)");
        $stmt->bindParam(':score', $lastGameScore);
        $stmt->bindParam(':date', $lastGameTimeDate);
        $stmt->bindParam(':roundtime', $lastGameRoundTime);
        $stmt->execute();
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country game!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');
    </style>
</head>

<body>
    <div class="container main-container d-flex align-items-center justify-content-center flex-column">
        <!-- New Card -->
        <div class="card mt-5 bg-dark text-white">
            <div class="card-body p-3">
                <h5 class="card-title mb-3">Best score</h5>
                <table class="table-dark">
                    <tr>
                        <th scope="col" class="p-2">Game</th>
                        <th scope="col" class="p-2">Score</th>
                        <th scope="col" class="p-2">Date</th>
                        <th scope="col" class="p-2">Round duration</th>
                    </tr>
                    <?php
                    makeTable($bestGameScore);
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mt-5 bg-dark text-white">
                    <div class="card-body p-3">
                        <h5 class="card-title mb-3">Choose time of round (default - 60sec):</h5>
                        <div class="form-group form-inline">
                            <input type="number" id="timer-count" placeholder="Seconds" class="form-control">
                        </div>
                        <p class="card-text"></p>
                        <a class="btn btn-success" id="playButton">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mt-5 bg-dark text-white">
                    <div class="card-body p-3">
                        <h5 class="card-title">Last games:</h5>
                        <table class="table-dark">
                            <tr>
                                <th scope="col" class="p-2">Game</th>
                                <th scope="col" class="p-2">Score</th>
                                <th scope="col" class="p-2">Date</th>
                                <th scope="col" class="p-2">Round duration</th>
                            </tr>
                            <?php
                            makeTable($gamesHistory);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('playButton').addEventListener('click', function () {
            var timerCount = document.getElementById('timer-count').value;
            var nextPage = 'pages/game.php?roundtime=' + timerCount;
            window.roundtime = timerCount; // Set a global variable
            window.location.href = nextPage;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>