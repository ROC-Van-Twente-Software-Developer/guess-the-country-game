<?php
include "php/db/tableQuery.php";
include "php/back-end/gameHistoryTableFunction.php";
$gamesHistory = getGamesHistory($db);

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
    <div class="container main-container d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card mt-5 bg-dark text-white">
                    <div class="card-body p-3">
                        <h5 class="card-title mb-3">Choose time of round (default - 60sec):</h5>
                        <div class="form-group form-inline">
                            <input type="number" id="timer-count" placeholder="Seconds" class="form-control">
                        </div>
                        <p class="card-text"></p>
                        <a href="pages/game.php" class="btn btn-success">Play</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>