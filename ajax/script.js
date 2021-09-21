var cardCall;
var cardCallLink = document.querySelector('#cards-list');
var cardDiv = document.getElementById("card-img");

var artistCall;
var artistCallLink = document.querySelector('#content');
var artistCards;
var artistIllus;

var colorCase = document.getElementById("card-color");
var cardId;
var list = '';
var artistNameButton = '';
var cards;
var index;
var i;

function allCards(){
    document.querySelector('#content').innerHTML = '<h2 id="card-name"></h2><p id="card-link"></p><div id="card-img"></div><p id="card-artist"></p> <div id="card-color" class="flex"></div>' ;
    fetch('https://api.scryfall.com/catalog/card-names')
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        cards = data.data;
        
        for(i= 0; i < 20; i++){
            cardId = "card"+String(i);
            list+= `<li id="${cardId}">${cards[i]}</li>`;
            listColor(cards[i], cardId);
        }
        document.querySelector('#cards-list').innerHTML = list;
        index = i;
    })
}

function detailCard(){
    cardCallLink.addEventListener('click', (el) => {
        el = el.target;
        console.log(el.target);
        cardCall = el.innerText || elt.textContent;
        fetch(`https://api.scryfall.com/cards/named?exact=${cardCall}`)
        .then(function(response){
            return response.json();
        })
        .then(function(card){
            var cardName = card.name;
            var cardLink = card.scryfall_uri;
            if(typeof(card.image_uris) != 'undefined'){
                var cardImg = card.image_uris.normal;
            }else{
                var cardImg = card.card_faces[0].image_uris.normal;
            }
            var cardArtist = card.artist;
            var cardColorId = card.color_identity;
            cardDiv.style.background = '';
            cardDiv.style.backgroundColor = "";
            if(cardColorId == "W"){
                cardDiv.style.backgroundColor = "burlywood";
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_white.png" alt="">`;

            }else if(cardColorId == "U"){
                cardDiv.style.backgroundColor = "blue";
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_blue.png" alt="">`;
                document.querySelector('#say-please').classList.add('say-please');
                document.querySelector('#please-button').addEventListener('click', () => {
                    document.querySelector('#say-please').classList.remove('say-please');
                })
            }else if(cardColorId == "G"){
                cardDiv.style.backgroundColor = "green";
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_green.png" alt="">`;
            }else if(cardColorId == "R"){
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_red.png" alt="">`;
                cardDiv.style.backgroundColor = "red";
            }else if(cardColorId == "B"){
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_black.png" alt="">`;
                cardDiv.style.backgroundColor = "black";
            }else if(cardColorId == ""){
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_neutre.png" alt="">`;
                cardDiv.style.backgroundColor = "grey";
            }else{
                colorCase.innerHTML = `<p>Colors : </p><img class="mana-symbole" src="image/mana_multi.png" alt="">`;
                cardDiv.style.background = 'linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%), linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%), linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%)';
            }
            document.querySelector('#card-name').innerHTML = cardName;
            document.querySelector('#card-link').innerHTML = `<a href="${cardLink}" target="_blank">On the site</a>`;
            document.querySelector('#card-img').innerHTML = `<img class="card-img" src="${cardImg}" alt="">`;
            document.querySelector('#card-artist').innerHTML = cardArtist;
        })
    })
}

function allArtist(){
    fetch('https://api.scryfall.com/catalog/artist-names')
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        artists = data.data;
        for(var ar= 0; ar < artists.length; ar++){
            artistNameButton+= `<button>${artists[ar]}</button>`;
        }
        document.querySelector('#content').innerHTML = artistNameButton;
        document.querySelector('#content').classList.add("content2");
    })
}

function detailArtist(){
    artistCallLink.addEventListener('click', (el) => {
        artistIllus = "";
        el = el.target;
        artistCall = el.innerText || elt.textContent;
        artistCall = artistCall.replace(" ", "");
        fetch(`https://api.scryfall.com/cards/search?as=grid&order=name&q=artist%3A${artistCall}`)      
        .then(function(response){
            return response.json();
        }).then(function(artist){
            artistCards = artist.data;
            artistCards.forEach(card => {
                var illus = card.image_uris.art_crop;
                artistIllus += `<img class="illus" src="${illus}" alt=""></img>`;
            })
            document.querySelector('#content').innerHTML = artistIllus;
            document.querySelector('#content').classList.add("content2");
        });
    })
}

function next(a){
    var b = a+20;
    list = '';
    for(i= a; i < b; i++){
        cardId = "card"+String(i);
        list+= `<li id="${cardId}">${cards[i]}</li>`;
        listColor(cards[i], cardId);
    }
    document.querySelector('#cards-list').innerHTML = list;
    index = i;
    console.log(index);
}

function before(a){
    var b = a-20;
    list = '';
    for(i= a; i > b; i--){
        cardId = "card"+String(i);
        list+= `<li id="${cardId}">${cards[i]}</li>`;
        listColor(cards[i], cardId);
    }
    document.querySelector('#cards-list').innerHTML = list;
    index = i;
    console.log(index);
}

function listColor(name, cardId){
    fetch(`https://api.scryfall.com/cards/named?exact=${name}`)
    .then(function(response){
        return response.json();
    })
    .then(function(card){
        var cardColorId = card.color_identity;
        cardLi = document.getElementById(cardId);
        cardLi.style.background = 'none';
        cardLi.style.backgroundColor = "none";
        cardLi.style.color = "none";
        if(cardColorId == "W"){
            return cardLi.style.backgroundColor = "burlywood";
        }else if(cardColorId == "U"){
            return cardLi.style.backgroundColor = "blue";
        }else if(cardColorId == "G"){
            return cardLi.style.backgroundColor = "green";
        }else if(cardColorId == "R"){
            return cardLi.style.backgroundColor = "red";
        }else if(cardColorId == "B"){
            cardLi.style.color = "white";
            return cardLi.style.backgroundColor = "black";
        }else if(cardColorId == ""){
            return cardLi.style.backgroundColor = "grey";
        }else{
            return cardLi.style.background = 'linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%), linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%), linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%)';
        }
    })
}
    


detailCard();
allCards();
detailArtist();

document.querySelector('#next').addEventListener('click',function(){next(index)});
document.querySelector('#before').addEventListener('click',function(){before(index)});
document.querySelector('#cards-button').addEventListener('click',function(){allCards()});
document.querySelector('#artists-button').addEventListener('click',function(){allArtist()});

