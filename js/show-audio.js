
document.addEventListener('DOMContentLoaded', function() {
  var vid = document.getElementById("player");

  function submitForm(){
    document.getElementById("add-comment").submit();
    document.getElementById("add-comment").method='post';
  }

  document.getElementById("add-comment").onkeydown=function(e){
    if(e.keyCode=='13'){
        document.getElementById("time").value = vid.currentTime;
        submitForm();
    }
  }
}, false);
