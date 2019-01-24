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

function addComment(field){
  field.submit();
}


addEvent(document.getElementById('add-comment'), 'submit', function(e, target)
{
  addComment(target);
});
