var numBlocks = 16;
var sqrt = 100/Math.sqrt(numBlocks);
var board = document.querySelector('#boardgame');
var timer;
var interval = 3000;
var rand;
var block;
var score;
var time;
var stopChrono;


document.querySelector('#startGame').addEventListener('click', () => {
    time = 0;
    score = 0;
    clearInterval(timer);
    clearTimeout(stopChrono);
    board.innerHTML = '';
    for (var i = 1; i <= numBlocks; i++) {
        var element = `<div class="block" data-id="${i}"></div>`;
        board.innerHTML += element;
    }
    document.querySelectorAll('.block').forEach((block) => {
        block.style.width = `${sqrt}%`;
        block.style.height = `${sqrt}%`;
    })
    chrono();
    timer = setInterval(displayChoco, interval);
})

document.querySelector('#boardgame').addEventListener('click', (el) => {
    el = el.target;
    if (el.dataset.id == rand) {
        score += 2;
        imageClicked();
    }
})

function chrono(){
    document.getElementById("time").value = time;
    if (time > 60){
        clearTimeout(stopChrono);
        clearInterval(timer);
        alert("End game");
    }
    time ++;
    stopChrono = setTimeout(chrono, 1000);
}

function imageClicked() {
    clearInterval(timer);
    timer = setInterval(displayChoco, interval);
    displayChoco();
}

function displayChoco() {
    if (rand) {
        block.classList.remove('chocobo'); //block = document.querySelector(`[data-id='${rand}']`);  // Commenté car non obligatoire
    }
    rand = Math.floor(Math.random()*numBlocks) + 1;
    block = document.querySelector(`[data-id='${rand}']`);
    block.classList.add('chocobo');
    if (score > 0){
        score --;
    }
    document.getElementById("score").value = score;
    //console.log(rand);
}