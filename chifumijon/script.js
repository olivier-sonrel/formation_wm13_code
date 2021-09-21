const choices = ['rock', 'paper', 'scisors'];
var playerPoints;
var computerPoints;

document.querySelector('#start').addEventListener('click', () => {
    document.querySelector('#banner').classList.add('none');
    document.querySelector('#gameboard').classList.remove('none');
    playerPoints = 0;
    computerPoints = 0;

})

document.querySelector('#player-choice').addEventListener('click', (el) => {
    document.querySelector('#computer-choice').innerHTML = '';

    document.querySelectorAll('.icon').forEach((element) => {
        element.classList.remove('border');
    })
    el.target.classList.add('border');

    var player = el.target.dataset.choice;
    var rand = Math.floor(Math.random()*3);
    var computer = choices[rand];

    var x = document.createElement("img");
    x.setAttribute("src", `${computer}.png`);
    x.setAttribute("class", "icon");
    document.querySelector('#computer-choice').appendChild(x);
    
    if(player == computer) {
        result = "Egalite!!"
    } else if (player == 'rock' && computer == 'scisors'){
        result = 'You win';
        playerPoints += 1;
    } else if (player == 'scisors' && computer == 'paper'){
        result = 'You win';
        playerPoints += 1;
    } else if (player == 'paper' && computer == 'rock'){
        result = 'You win';
        playerPoints += 1;
    } else {
        result = 'You Loose.....';
        computerPoints += 1;
    }
    
    document.querySelector('#result').innerHTML = result;
    document.querySelector('#player-points').innerHTML = playerPoints;
    document.querySelector('#computer-points').innerHTML = computerPoints;
    verifScore();
    

});

function verifScore(){
    if(playerPoints == 3){
        document.querySelector('#winboard').classList.remove('none');
    }
    if(computerPoints == 3){
        document.querySelector('#looseboard').classList.remove('none');
    }
    return;
}