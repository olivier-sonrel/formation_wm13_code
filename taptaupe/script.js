var numBlocks = 16;
var sqrt = 100/Math.sqrt(numBlocks);
var board = document.querySelector('#boardgame');
var victory = document.querySelector('#victory');
var defeat = document.querySelector('#defeat');
var timer;
var interval = 3000;
var rand;
var block;
var score;
var timerGeneral;
var timeGame;
var randImage;
var blkChoice;

document.querySelector('#startGame').addEventListener('click', () => {
    score = 0;
    blkChoice = document.getElementById('blkChoice').value;
    document.querySelector('#rules').classList.add('none');
    defeat.classList.add('none');
    victory.classList.add('none');
    document.querySelector('#score').innerHTML = score;
    board.classList.remove('none');
    clearInterval(timer);
    clearInterval(timerGeneral);
    board.innerHTML = '';
    for (var i = 1; i <= numBlocks; i++) {
        var element = `<div class="block" data-id="${i}"></div>`;
        board.innerHTML += element;
    }
    document.querySelectorAll('.block').forEach((block) => {
        block.style.width = `${sqrt}%`;
        block.style.height = `${sqrt}%`;
    })
    timer = setInterval(nextTurn, interval);
    generalTimer();
})

board.addEventListener('click', (el) => {
    el = el.target;
    if (el.dataset.id == rand) {
        score++;
        if (interval > 800) {
            interval -= 100;
        }
        clearInterval(timer);
        timer = setInterval(nextTurn, interval);
        displayChoco();
    } else {
        if (score > 0) {
            score--;
        }
    }
    document.querySelector('#score').innerHTML = score;
    checkVictory();
})

function generalTimer() {
    timeGame = 30;
    timerGeneral = setInterval(() => {
        timeGame--;
        document.querySelector('#time').innerHTML = `${timeGame} s`;
        checkDefeat();
    }, 1000);
}

function nextTurn() {
    if (score > 0) {
        score--;
        document.querySelector('#score').innerHTML = score;
    }
    displayChoco();
    return;
}

function displayChoco() {
    if (rand) {
        //block = document.querySelector(`[data-id='${rand}']`);  // Commenté car non obligatoire
        block.style.backgroundImage = '';
    }
    //console.log(blkChoice);
    rand = Math.floor(Math.random()*numBlocks) + 1;
    block = document.querySelector(`[data-id='${rand}']`);
    randImage = Math.floor(Math.random()*3) + 1;
    block.style.backgroundImage = `URL('image/tetram${randImage}.jpg')`;
}

function checkDefeat() {
    if (timeGame == 0) {
        defeat.classList.remove('none');
        endgame();
    }
    return;
}

function checkVictory() {
    if (score == 50) {
        victory.classList.remove('none');
        endgame();
    }
    return;
}

function endgame() {
    board.classList.add('none');
    clearInterval(timerGeneral);
    clearInterval(timer);
    return;
}