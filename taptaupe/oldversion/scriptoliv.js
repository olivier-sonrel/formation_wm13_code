var tap;
var check = [];
var time = 3000;

var game = setInterval(jumpOut, time);

function jumpOut(){
    if(check.length > 8){
        alert("YOU WINNNN YYEEAAAA");
        clearInterval(game);
    }
    if(time < 0){
        alert("YOU LOOSE");
        clearInterval(game);
    }
    var rand = Math.floor(Math.random() * 9);
    var randBlood = rand + 10;
    var tetram = document.getElementById(`${rand}`);
    var blood = document.getElementById(`${randBlood}`);
    if( check.indexOf(rand) === -1){
        tetram.classList.remove('none');
        tetram.onclick = function(){
            clearTimeout(tap);
            tetram.classList.add('none');
            blood.classList.remove('none');
            check.push(rand);
        }
    }
    time = time - 200;
    tap = setTimeout(jumpIn, time, tetram);
}

function jumpIn(param1){
    param1.classList.add('none');
}