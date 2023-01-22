// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// create new element on list
function newElement() {
    var li = document.createElement("li");
    var exercise = document.getElementById("exercise_input").value;
    var series = document.getElementById("series").value;
    var repetitions = document.getElementById("repetitions").value;
    var text = document.createTextNode(exercise + ", series: " + series + " repetitions: " + repetitions);
    li.appendChild(text);

    document.getElementById("exercises_list").appendChild(li);

}
