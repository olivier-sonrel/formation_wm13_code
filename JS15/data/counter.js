function repeatWhileMouseOver(element, action, time) {
    var interval = null;
    element.addEventListener('mouseover', function() {
        interval = setInterval(action, time);
    });
  
    element.addEventListener('mouseout', function() {
        clearInterval(interval);
    });
  }
  
  var counter = 1;
  function count() {
    console.log(counter++);
  }
  repeatWhileMouseOver(document.getElementById('presentation'), count, 1000);