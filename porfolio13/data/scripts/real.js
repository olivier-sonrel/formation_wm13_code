var numBlocks = 16;
var sqrt = 100/Math.sqrt(numBlocks);
var board = document.querySelector('#boardgame');
var timer;
var interval = 3000;
var rand;
var block;
var score;
var timerGeneral;
var timeGame;
var randImage;

document.querySelector('#startGame').addEventListener('click', () => {
    score = 0;
    document.querySelector('#boardgame').classList.remove('none');
    document.querySelector('#defeat').classList.add('none');
    document.querySelector('#victory').classList.add('none');
    document.querySelector('#score').innerHTML = score;
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

function generalTimer() {
    timeGame = 30;
    timerGeneral = setInterval(() => {
        timeGame--;
        document.querySelector('#time').innerHTML = `${timeGame} s`;
        if (timeGame == 0) {
            clearInterval(timerGeneral);
            clearInterval(timer);
            document.querySelector('#boardgame').classList.add('none');
            document.querySelector('#defeat').classList.remove('none');
        }
    }, 1000);
}

document.querySelector('#boardgame').addEventListener('click', (el) => {
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

function checkVictory() {
    if (score == 50) {
        document.querySelector('#boardgame').classList.add('none');
        document.querySelector('#victory').classList.remove('none');
        clearInterval(timerGeneral);
        clearInterval(timer);
    }
}

function nextTurn() {
    if (score > 0) {
        score--;
    }
    displayChoco();
}

function displayChoco() {
    if (rand) {
        //block = document.querySelector(`[data-id='${rand}']`);  // Commenté car non obligatoire
        block.style.backgroundImage = '';
    }
    document.querySelector('#score').innerHTML = score;
    rand = Math.floor(Math.random()*numBlocks) + 1;
    block = document.querySelector(`[data-id='${rand}']`);
    randImage = Math.floor(Math.random()*3) + 1;
    console.log(`../img/choco${randImage}.jpg`);
    block.style.backgroundImage = `URL('public/img/choco${randImage}.jpg')`;
}