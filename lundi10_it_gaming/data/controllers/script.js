
function changeRegister(){
    document.getElementById("register").style.display = "flex";
    document.getElementById("connection").style.display = "none";
}

function changeConnection(){
    document.getElementById("register").style.display = "none";
    document.getElementById("connection").style.display = "flex";
}

function checkform(register){
    if(register.password.value != register.password2.value)
    {
        document.getElementById("send").disabled = true;
    } else {
    document.getElementById("send").disabled = false;
    }
}

function afficheMdp(){
    var mdp = document.querySelector("#visualise");
    mdp.setAttribute("type", "text");
    document.getElementById("butO").style.display = "none";
    document.getElementById("butX").style.display = "inline";
}

function cacheMdp(){
    var mdp = document.querySelector("#visualise");
    mdp.setAttribute("type", "password");
    document.getElementById("butO").style.display = "inline";
    document.getElementById("butX").style.display = "none";
}

// --------------JON WAY-N--------------

//-------------change formulaire------
// document.querySelector('.display-ins').addEventListener('click', () => {
//     document.querySelector('#inscription').classList.remove('none');
//     document.querySelector('#connection').classList.add('none');
// })
// document.querySelector('.display-con').addEventListener('click', () => {
//     document.querySelector('#inscription').classList.add('none');
//     document.querySelector('#connection').classList.remove('none');
// })

// ------------confirm password------
// const verifPass = function() {           // cont====> function creer fonction anonyme qui ne peut etre remodif
//     var pass1 = document.querySelector('#inscription-password').value;
//     var pass2 = document.querySelector('#inscription-password-verif').value;
//     var but = document.querySelector('#inscription-button');
//     var alert = document.querySelector('alert');
//
//     console.log(pass2);    // pour debugage
//     if (pass1 == pass2) {
//         but.disabled = false;
//         alert.classList.add('none');
//     }else {
//         but.disabled = true;
//         alert.classList.remove('none');
//     }
// }

// ---------------------visualise password------
// document.querySelector('#open').addEventListener('click', () => {
//     document.querySelector('.pass-input').type = 'text';
//     document.querySelector('#open').classList.add('none');
//     document.querySelector('#close').classList.remove('none');
// })
// document.querySelector('#close').addEventListener('click', () => {
//     document.querySelector('.pass-input').type = 'text';
//     document.querySelector('#close').classList.add('none');
//     document.querySelector('#open').classList.remove('none');
// })

// -----------rend fond ecran sur lequel on click vert--------
// --------exemple recup element ou on click---------
// document.querySelector('main').addEventListener('click',(el) => {
//     var el = el.target;
//    // console.log(el);  // pour debug
//     el.classList.add('green');
// })

// --------------------------------------------------------
