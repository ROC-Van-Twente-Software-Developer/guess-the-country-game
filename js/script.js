// Start screen on page load
document.addEventListener("DOMContentLoaded", function () {
    // Count variable to detect end
    showTimes = 0;

    // Get span elements of count
    const spans = document.querySelectorAll('#time span');

    // Number show function
    function showNumber(index) {
        spans.forEach((span, i) => {
            if (i === index) {
                span.classList.add('active');
            } else {
                span.classList.remove('active');
            }
        });
    }

    // Animation
    function animateCount(index) {
        setTimeout(() => {
            showNumber(index);
            showTimes++;
            // When counting is over
            if (showTimes == 4) {
                // Remove startscreen
                startScreen = document.getElementById('time');
                startScreen.style.display = 'none';

                // Show frame of game
                gameFrame = document.getElementById('gameFrame');
                gameFrame.style.display = 'block'

                // Start game
                setNewRound();
                document.getElementById('scoreLine').style.display = 'block'
                document.getElementById('timerLine').style.display = 'block'
                startTimer();
                // Focus cursor in input
                document.getElementById('answer').focus();
                document.getElementById('answer').select();
            }
        }, index * 1000);  // Adjust timing if needed
    }

    // Start animate function
    spans.forEach((span, index) => {
        animateCount(index);
    });
});

var rightAnswer = '';

// Read input
var inputField = document.getElementById("answer");

// Start function on enter key while inputing
inputField.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        checkAnswer();
    }
});

// Get name of chosen file
function setNewRound() {
    fetch('../php/back-end/fileOperation.php')
        .then(response => response.json())
        .then(data => {
            if (data.fileNameWithoutExtension) {
                // Save right answer
                rightAnswer = data.fileNameWithoutExtension;

                // Put flag in div
                const imageField = document.getElementById("flag");
                imageField.innerHTML = `<img src='../../countries/${rightAnswer}.png' alt='' class='img-fluid'>`;
                // Give attribute maxlength to input
                inputField.setAttribute("maxlength", rightAnswer.length);

                // Focus on input
                document.getElementById('answer').focus();
                document.getElementById('answer').select();
            } else {
                alert('No files found in the directory');
            }
        })
        .catch(error => console.error('Error fetching random file:', error));
}


function checkAnswer() {
    // Get checked input
    resultOfCompare = compareWords(inputField.value, rightAnswer);

    // Print result, and show it
    userAnswerLine = document.getElementById('userAnswerLine');
    resultLine = document.getElementById('resultLine');
    userAnswerLine.innerHTML = resultOfCompare.checkedString;
    resultLine.innerText = rightAnswer;
    userAnswerLine.style.visibility = 'visible';
    resultLine.style.visibility = 'visible';
    if (resultOfCompare.isGuessed) {
        document.querySelector('body').style.backgroundColor = 'lightgreen';
        let scoreLine = document.getElementById('score');
        let currentScore = parseInt(scoreLine.innerText);
        scoreLine.innerText = ++currentScore;
    } else {
        document.querySelector('body').style.backgroundColor = '#FF4500';
    }
    // Clean input, hide result lines and go to the next flag (AFTER 1 sec)
    setTimeout(() => {
        inputField.value = '';
        userAnswerLine.style.visibility = 'hidden';
        resultLine.style.visibility = 'hidden';
        document.querySelector('body').style.backgroundColor = 'white';
        setNewRound();
    }, 1000);
}

function compareWords(input, answer) {
    // Split the input string into an array of letters
    var inputArray = input.split('');
    var answerArray = answer.split('');

    var guessedLetters = 0;
    var checkedString = '';
    // Iterate over each letter in the array
    inputArray.forEach((inputLetter, index) => {
        const answerLetter = answerArray[index];

        // Compare letters and create spans
        if (inputLetter.toLowerCase() === answerLetter.toLowerCase()) {
            checkedString += '<span class="text-success">' + inputLetter + '</span>';
            guessedLetters++;
        } else {
            checkedString += '<span class="text-secondary">' + inputLetter + '</span>';
        }
    });

    // Return object result as colored string and if the word was guessed
    var result = {
        checkedString: checkedString,
        isGuessed: (guessedLetters / answer.length) * 100 >= 30
    };

    return result;
}

let timerInterval;
var roundSeconds = (window.roundtime == null) ? 60 : window.roundtime;


function startTimer() {
    // Set the initial time in milliseconds
    let timeRemaining = roundSeconds * 1000; // 60 seconds

    // Get the timer element
    const timerElement = document.getElementById('timer');

    // Check if the timer is already running
    if (!timerInterval) {
        // Start the timer interval only once
        timerInterval = setInterval(function () {
            const minutes = Math.floor(timeRemaining / (60 * 1000));
            const seconds = Math.floor((timeRemaining % (60 * 1000)) / 1000);
            const milliseconds = timeRemaining % 1000;
            
            timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}.${String(milliseconds).padStart(3, '0')}`;

            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                timerElement.textContent = '00:000';
                document.getElementById('gameFrame').style.display = 'none';
                document.getElementById('resultForm').style.display = 'block';
                document.getElementById('timerLine').style.display = 'none';
                saveGameResults(document.getElementById('score').innerText, roundSeconds);
            } else {
                timeRemaining -= 10;
            }
        }, 10);
    }
}

function saveGameResults(score, roundTime) {
    var resultScoreInput = document.getElementById('resultScore');
    var resultRoundTimeInput = document.getElementById('resultRoundTime');
    var resultTimeDateInput = document.getElementById('resultTimeDate');
    // Save round results as values of inputs
    resultScoreInput.value = score;
    resultRoundTimeInput.value = roundTime;
    resultTimeDateInput.value = getCurrentDateTime();
}

function getCurrentDateTime() {
    const now = new Date();
  
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
  
    const formattedDateTime = `${year}-${month}-${day}-${hours}-${minutes}-${seconds}`;
    return formattedDateTime;
  }