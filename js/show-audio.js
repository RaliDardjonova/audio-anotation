
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



function addEvent(node, type, callback) {
  if (node.addEventListener) {
    node.addEventListener(
      type,
      function(e) {
        callback(e, e.target);
      },
      false
    );
  } else if (node.attachEvent) {
    node.attachEvent("on" + type, function(e) {
      callback(e, e.srcElement);
    });
  }
}
/*
addEvent(document.getElementById("add-comment"), 'submit', function(e))
{
  e.preventDefault();
  e.stopPropagation();
  addComment();
});
*/
/*
document.getElementById('add-comment').addEventListener('submit', function(e){
  e.preventDefault();
  e.stopPropagation();
  console.log("123565432");
  addComment();
});

function addComment()
{
  document.getElementById("time").value = audio.currentTime;
  document.getElementById("demo").innerHTML = audio.currentTime;
  var elements = document.getElementById("add-comment").getElementsByTagName("input");
  var formData = new FormData();
//  document.getElementById("demo").innerHTML = elements[3].value;
  for(var i=0; i<elements.length; i++)
  {
      //document.getElementById("demo").innerHTML = elements[i].name;
      formData.append(elements[i].name, elements[i].value);
  }
  var xmlHttp = new XMLHttpRequest();
  document.getElementById("demo").innerHTML = "*-*****";
      xmlHttp.onreadystatechange = function()
      {
          if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
          {
            alert(xmlHttp.responseText);
          }
      };
      document.getElementById("demo").innerHTML = "&";
     xmlhttp.setRequestHeader("Content-type","multipart/form-data");
    //xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xmlHttp.open("POST", "../src/add-comment.php", async=true);
      xmlHttp.send(formData);
}
*/

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById('add-comment').addEventListener('submit', function(e){
    e.preventDefault();
    e.stopPropagation();
    console.log("123565432");
    addComment();
  });

  function addComment()
  {
    var audio = document.getElementById("player");
    document.getElementById("time").value = audio.currentTime;
    var elements = document.getElementById("add-comment").getElementsByTagName("input");
    var formData = new FormData();

    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
        if(elements[i].name == "comment"){
          elements[i].value="";
        }
    }
    var xmlHttp = new XMLHttpRequest();

        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
              console.log(xmlHttp.response);
            }
        };

        xmlHttp.open("POST", "../src/add-comment.php", async=true);
        //xmlHttp.setRequestHeader("Content-type","multipart/form-data");
      //xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlHttp.send(formData);
        //xmlHttp.send('comment=3242423&audioname=493843672&time=213213');
      }
});
/*
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById('select-time').addEventListener('change', function(e){
    console.log("132");
    $('#comment-section').load(document.URL +  ' #comment-section');
  })
});
*/
$(document).ready(function(){
  checkContainer();
  /*$("select").change(function(){
    alert("The text has been changed.");
    console.log("132");
    $('#comment-section').load(document.URL +  ' #comment-section', function(){checkContainer();});
  });*/
});

function checkContainer () {
  if($('#select-time').is(':visible')){ //if the container is visible on the page
    $("select").change(function(){
      //alert("The text has been changed.");
      var option = $( "#select-time" ).val();
      var audio =  $( "#audioname").val();
      console.log(audio);
      $.ajax({
        //url: document.URL,
        url: "../src/get-comments.php",
        type: 'post',
        data: {time: option, audioname:audio},
        dataType:"html",
        success: function(response){
          //alert(response);
          console.log('2');
          $('#fetch-comments').html(response);
          //location.reload();
          //$('#comment-section').load(document.URL +  ' #comment-section', function(){checkContainer();});
        }

});
      //$('#comment-section').load(document.URL +  ' #comment-section', function(){checkContainer();});
    });
  }
}
