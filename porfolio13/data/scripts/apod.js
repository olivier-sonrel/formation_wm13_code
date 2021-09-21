var imgurl = '/images/portrait.jpg';

function getApod(){
    fetch('https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY')
    .then(function(response){
        return response.json();
    })
    .then(function(data){
        imgurl = data.url;
        document.querySelector('.nasa-background').style.backgroundImage = `url(${imgurl})`;
    })
}

getApod();