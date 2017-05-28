function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if ((new Date().getTime() - start) > milliseconds){
			break;
		}
	}
}

function updating(){
	$('#status').toggleClass("text-success");
	$('#status').html("Updating Scoreboard");
	$('#status').toggleClass("text-warning");
}

function uptodate(){
	$('#status').toggleClass("text-warning");
	$('#status').html("Up-To-Date");
	$('#status').toggleClass("text-success");
}

function operation(cmd){
	updating();
	var ajaxUrl = "/op/score" + cmd;
	$.ajax({url: ajaxUrl, success: function(result){
		uptodate();
	}});
}

$(document).ready(function() {
	operation('Init');
	sleep(100);
	$("#initbox").hide();
	$("#progbox").toggleClass("hidden");
});

$('#p1win').click(function() {
	$('#p1score').html(parseInt($('#p1score').html()) + 1);
	operation('Win/1');
});

$('#p2win').click(function() {
	$('#p2score').html(parseInt($('#p2score').html()) + 1);
	operation('Win/2');
});

$('#reset').click(function() {
	$('#p1score').html(0);
	$('#p2score').html(0);
	operation("Reset");
});

var swap = false;

$('#switch').click(function() {
	var p1 = $('#p1').html();
	var p1score = $('#p1score').html();
	$('#p1').html($('#p2').html());
	$('#p2').html(p1);
	$('#p1score').html($('#p2score').html());
	$('#p2score').html(p1score);
	operation("Switch");
	swap = !swap;
});

var myMatches = new Object();

var match = null;

function loadTruskiStats(p1, p2){
	// To-do
}

function setmatch(matchid){
	match = myMatches[matchid];
	$('#p1').html(match.player1name);
	$('#p2').html(match.player2name);
	$('#p1score').html(0);
	$('#p2score').html(0);
	$('#round').html(match.tournamentname+' - '+match.round);
	loadTruskiStats(match.player1name, match.player2name);
	swap = false;
	$('#myModal').modal('hide');
	$('#submit').removeClass('disabled');
	operation('match/' + match.player1name + '/' + match.player2name + '/' + match.tournamentname + '/' + match.round);
}

function getMatches(){
	var ajaxUrl = "/op/getTournaments";
	$.ajax({url: ajaxUrl, success: function(result){
		var array = JSON.parse(result);
		$('#mod-matches').empty();
		for(var i = 0; i < array.length; i++){
			var p = array[i];
			if(!myMatches.hasOwnProperty(p.matchid)){
				$('#mod-matches').append('<div onclick="setmatch('+p.matchid+')" class="match center" id="'+p.matchid+'"><h3>'+p.tournamentname+'</h3><h2 class="text-primary">'+p.player1name+' vs '+p.player2name+' <span class="label label-default">New</span></h2><h3>'+p.round+'</h3></div>');
			} else {
				$('#mod-matches').append('<div onclick="setmatch('+p.matchid+')" class="match center" id="'+p.matchid+'"><h3>'+p.tournamentname+'</h3><h2 class="text-primary">'+p.player1name+' vs '+p.player2name+' </h2><h3>'+p.round+'</h3></div>');
			}
			myMatches[p.matchid] = p;
		}
		if(array.length == 0){
			$('#mod-matches').append('<p>No matches available.</p>');
		}
	}});
}

$('#selectmatch').click(function() {
	$('#modal2').addClass('hidden');
	$('#modal1').removeClass('hidden');
	$('#mod-matches').empty();
	$('#mod-matches').append('<p>Loading...</p>');
	$('#myModal').modal('show');
	getMatches();
});

$('#submit').click(function() {
	var winner;
	var p1s = $('#p1score').html();
	var p2s = $('#p2score').html();
	if(p1s == p2s){
		alert("Game cannot end in a tie!");
		return;
	}
	if(p1s > p2s){
		if(!swap){
			winner = match.player1;
		} else {
			winner = match.player2;
		}
	} else {
		if(!swap){
			winner = match.player2;
		} else {
			winner = match.player1;
		}
	}
	var score;
	if(!swap){
		score = p1s + '-' + p2s;
	} else {
		score = p2s + '-' + p1s;
	}
	alert(match.tournament);
	var ajaxUrl = "/op/submitScore/" + match.tournament + "/" + match.matchid + "/" + winner + "/" + score;
	$.ajax({url: ajaxUrl, success: function(result){
		$('#submit').addClass('disabled');
		$('#modal1').addClass('hidden');
		$('#modal2').removeClass('hidden');
		$('#myModal').modal('show');
	}});
});

$('#closeModal').click(function() {
	$('#myModal').modal('hide');
});

$('#closeModal2').click(function() {
	$('#mod-matches').empty();
	$('#mod-matches').append('<p>Loading...</p>');
	$('#modal2').addClass('hidden');
	$('#modal1').removeClass('hidden');
	getMatches();
});