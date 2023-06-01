<?php
session_start();
include 'navbar.php';
?>
<html>
<head>
   <title>Game</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }


		body {
			display: flex;
      height: 100vh;
      margin-top: 50px;
		}

		#game-board {
			background-color: #ccc;
			box-shadow: 0 0 5px #333;
			display: none;
			flex-wrap: wrap;
			justify-content: center;
			padding: 20px;
			margin: auto;
            perspective: 1000px;
		}

    button {
  display: block;
  margin: auto;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  font-size: 1.2em;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

#timer {
    display: none;
    justify-content: center;
    align-items: center;
    font-size: 36px;
    font-weight: bold;
    text-align: center;
    color: #464646;
    background-color: #F2F2F2;
    border: 5px solid #C5C5C5;
    border-radius: 100%;
    width: 150px;
    height: 150px;
    margin: 70px auto 0;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translate(-50%, 0);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    font-family: 'Orbitron', sans-serif;
}

#countdown {
    color: #464646;
    font-size: 48px;
}

		.card {
			width: 200px;
			height: 200px;
			position: relative;
			margin: 5px;
            transform: scale(1);
            transform-style: preserve-3d;
            transition: transform .5s;
		}

        .card:active {
            transform: scale(.97);
            transition: transform .2s;
        }

        .card.flip {
            transform: rotateY(180deg);
        }

		.card-back,
		.card-front {
        width: 100%;
        height: 100%;
        padding: 20px;
        position: absolute;
        border-radius: 5px;
        backface-visibility: hidden;
		}

        .card-front {
            transform: rotateY(180deg);
        }
    
        #confirm-dialog {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 1rem;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  align-items: center;
}

#confirm-dialog p {
  margin: 0 0 1rem;
}

#confirm-dialog button {
  margin: 2px;
}

#confirm-dialog .button-container {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

.navbar {
position: fixed;
top: 0;
width: 100%;
background-color: blue;
}
	</style>
</head>
<body>

<button id="start-button">Start the game</button>

<div id="timer">
        <span id="countdown"></span>
    </div>
  

<!-- Add a placeholder element for the confirmation dialog -->
<div id="confirm-dialog-placeholder"></div>


	<div id="game-board">
	  <div class="card" data-name="1">
	    <img class="card-front" src="asap.jpg" alt="card1">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	  <div class="card" data-name="1">
	    <img class="card-front" src="asap.jpg" alt="card1">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	  <div class="card" data-name="2">
	    <img class="card-front" src="uzi.jpg" alt="card2">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	  <div class="card" data-name="2">
	    <img class="card-front" src="/uzi.jpg" alt="card2">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	  <div class="card" data-name="3">
	    <img class="card-front" src="travy.jpeg" alt="card3">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	  <div class="card" data-name="3">
	    <img class="card-front" src="travy.jpeg" alt="card3">
	    <img class="card-back" src="arcade-unsplash.jpg" alt="back">
	  </div>
	</div>

<script>

const startButton = document.getElementById('start-button');
const gameBoard = document.getElementById('game-board');
const timer_countdown = document.getElementById('timer');
startButton.addEventListener('click', () => {
  // Hide the button
  startButton.style.display = 'none';
  gameBoard.style.display = 'flex';
  timer_countdown.style.display = 'flex';

shuffle_deck();

var downloadTimer;

start_countdown();

const cards = document.querySelectorAll('.card');
let flipped = false;
let firstCard, secondCard;
let boardLocked = false;
let moves = 0;
let timeElapsed = 0;
let pairsFound = 0;
let score = 0;

let timer = setInterval(() => {
  timeElapsed++;
}, 1000);

const MAX_GUESSES = 5;
let incorrectGuesses = 0;

function clicked() {
  if (!boardLocked && !this.classList.contains('flip')) {
    this.classList.add("flip");

    if (!flipped) {
      flipped = true;
      firstCard = this;
    } else {
      flipped = false;
      secondCard = this;

      if (firstCard.dataset.name === secondCard.dataset.name) {
        firstCard.removeEventListener('click', clicked);
        secondCard.removeEventListener('click', clicked);
        pairsFound++;
        if (pairsFound === 3 && incorrectGuesses < MAX_GUESSES) {
          score = calculateScore(moves, timeElapsed);

 if (document.cookie.indexOf('username=') !== -1) {

  pause_timer();

  // Create the custom dialog
  const dialog = document.createElement('div');
  dialog.id = 'confirm-dialog';
  dialog.innerHTML = `
    <p>Congratulations! You completed the game in ${moves} moves and ${timeElapsed} seconds. Your score is ${score}. Do you want to submit your score or play again?</p>
    <button id="submit-score">Submit</button>
    <button id="play-again">Play Again</button>
  `;

  // Add event listeners to the buttons
  dialog.querySelector('#submit-score').addEventListener('click', () => {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Define the URL of the PHP script that will handle the POST request
    var url = "leaderboard.php";

    // Define the data to be sent in the request body
    var data = "score=" + score;

    // Define the HTTP method to be used (POST)
    var method = "POST";

    // Initialize the request
    xhr.open(method, url, true);

    // Set the content type of the request
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the callback function to handle the server response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        console.log(xhr.responseText);
      }
    };

    // Send the request with the data
    xhr.send(data);
    reset_board();

    // Remove the dialog from the DOM
    dialog.remove();
  });

  dialog.querySelector('#play-again').addEventListener('click', () => {
    reset_board();

    // Remove the dialog from the DOM
    dialog.remove();
  });

  // Add the dialog to the DOM
  const dialogPlaceholder = document.getElementById('confirm-dialog-placeholder');
  dialogPlaceholder.appendChild(dialog);

}

else {
  alert(`Congratulations! You completed the game in ${moves} moves and ${timeElapsed} seconds. Your score is ${score}.`);

 reset_board();
}
  
} 


      } else {
        boardLocked = true;
        setTimeout(() => {
          firstCard.classList.remove('flip');
          secondCard.classList.remove('flip');
          boardLocked = false;
        }, 500);
        incorrectGuesses++;
        if (incorrectGuesses >= MAX_GUESSES) {
          game_over();
        }
      }
      moves++;
    }
  }
}

function reset_board() {
  reset_timer();
  shuffle_deck();
  clearInterval(timer);
  score = 0;
  moves = 0;
  pairsFound = 0;
  incorrectGuesses = 0;
  timeElapsed = 0;
  flipped = false;
  boardLocked = false;
  firstCard = null;
  secondCard = null;
  cards.forEach(card => {
    card.classList.remove('flip');
    card.addEventListener('click', clicked);
  });
  timer = setInterval(() => {
    timeElapsed++;
  }, 1000);
}

function calculateScore(moves, timeElapsed) {
  const SCORE_FACTOR = 1000;
  const score = Math.floor((moves / timeElapsed) * SCORE_FACTOR);
  return score;
}

function shuffle_deck() {
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => {
    let randomPos = Math.floor(Math.random() * cards.length);
    card.style.order = randomPos;
  });
}

function game_over(){
  alert("Game over! You've made too many incorrect guesses or have exceeded the time limit. Please try again.");
	reset_board();
}

function start_countdown() {
  var timeleft = 20 * 1000; // set time in milliseconds
  downloadTimer = setInterval(function() {
    var milliseconds = (timeleft % 1000) / 10; // calculate milliseconds
    var seconds = Math.floor((timeleft / 1000) % 60);
    var minutes = Math.floor((timeleft / 1000 / 60) % 60);
    document.getElementById("countdown").textContent = `${minutes}:${seconds.toString().padStart(2, '0')}:${milliseconds.toString().padStart(2, '0')}`;
    if (timeleft <= 0)
      clearInterval(downloadTimer, game_over());
    timeleft -= 100; // decrease time by 100ms
  }, 100);
}

function reset_timer() {
   clearInterval(downloadTimer);
   document.getElementById("countdown").textContent = "";
   start_countdown();
}

function pause_timer() {
   clearInterval(downloadTimer);
}

function format_time(time) {
   return time.toString().padStart(2, "0");
}

function format_milliseconds(milliseconds) {
   return Number((milliseconds / 10).toFixed(2)).toString().replace(/\.?0+$/, '');
}

cards.forEach(card => card.addEventListener('click', clicked));

});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>