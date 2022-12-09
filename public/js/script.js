console.log(t1_goals);
console.log(t2_goals);


var team1_result = document.getElementById('team1-result');
var team2_result = document.getElementById('team2-result');

var team1 = document.getElementsByClassName('team1');
var team2 = document.getElementsByClassName('team2');

/*
var t1_json = JSON.parse(t1_goals);
var t2_json = JSON.parse(t2_goals);


for (var x = 0; x < Object.keys(t1_json).length + 1; x++) {
    console.log("LA X DE 1 ES: " + t1_json[x]);
    console.log("LA X DE 2 ES: " + t2_json[x]);
    if (t1_json[x] > t2_json[x]) {

        team1_result.className += " winner";
        team2_result.className += " loser";

        team1.className += " winner";
        team2.className += " loser";

    } else if (t1_json[x] < t2_json[x]) {

        team1_result.className += " loser";
        team2_result.className += " winner";

        team1.className += " loser";
        team2.className += " winner";
    } else {
        team1_result.className += " tie";
        team2_result.className += " tie";

        team1.className += " tie";
        team2.className += " tie";
    }
}*/

if (Number(t1_goals) > (t2_goals)) {

    team1_result.className += " winner";
    team2_result.className += " loser";

    team1.className += " winner";
    team2.className += " loser";



} else if (Number(t1_goals) < (t2_goals)) {
    team1_result.className += " loser";
    team2_result.className += " winner";

    team1.className += " loser";
    team2.className += " winner";


} else {
    team1_result.className += " tie";
    team2_result.className += " tie";

    team1.className += " tie";
    team2.className += " tie";
}






function showPlayerData(id) {
    var data = "data-" + id;
    var player = document.getElementById(data);
    var btn = document.getElementById("btn-data-" + id);

    if (player.style.display == "none") {
        document.getElementById(data).style.display = "grid";
        btn.style.background = "#ea4335";
    } else {
        document.getElementById(data).style.display = "none";
        btn.style.background = "none";
    }
}