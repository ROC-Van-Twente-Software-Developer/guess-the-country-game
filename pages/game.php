<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Game</title>
    <script src="../../js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/startScreen.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center flex-column">
        <div class="card custom-card mt-5 bg-dark text-white" id="gameFrame" style="display: none;">
            <div class="card-header">Country Game</div>
            <div class="card-body">
                <h5 class="card-title mb-5">Flag</h5>
                <div id="flag" class="image-container mt-3 mb-3"></div>
                <label for="answer" class="form-label">Name?</label>
                <input type="text" id="answer" class="form-control" name="land" autocomplete="none">
                <button id="button" class="btn btn-primary mt-3" onclick="checkAnswer()">Answer</button>
                <h1 id="userAnswerLine" class="mb-3 text-center fs-4"></h1>
                <h1 id="resultLine" class="text-center fs-4"></h1>
            </div>
        </div>
        <h3 class="m-3" style="display: none;" id="scoreLine">Score: <strong id="score">0</strong> </h3>
        <h3 class="m-3" style="display: none;" id="timerLine">Time left: <strong id="timer">60:000</strong></h3>
    </div>

    <!-- Start screen element -->
    <h1 id="time" class="position-absolute top-50 start-50 translate-middle">
        <span class="customSpan" id="one" class="active">1</span>
        <span class="customSpan" id="two">2</span>
        <span class="customSpan" id="three">3</span>
        <span class="customSpan" id="start">Start!</span>

        <!-- Start screen element -->

    </h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>