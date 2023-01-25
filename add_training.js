// global array to store exercises to add
var exercises_array = [];
var series_array = []
var repetitions_array = []

// create new element on list
function newElement() {
    var li = document.createElement("li");
    var exercise = document.getElementById("exercise_input").value;
    var series = document.getElementById("series").value;
    var repetitions = document.getElementById("repetitions").value;
    var text = document.createTextNode(exercise + ", series: " + series + " repetitions: " + repetitions);
    li.appendChild(text);

    document.getElementById("exercises_list").appendChild(li);

    exercises_array.push(exercise);
    series_array.push(series);
    repetitions_array.push(repetitions);

    var send_exercises = exercises_array.join(',');
    console.log(send_exercises);
    $.post("add_training.php", {send_exercises: send_exercises});
}
