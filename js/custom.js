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
	updating();
	var ajaxUrl = "/op/init";
	$.ajax({url: ajaxUrl, success: function(result){
		uptodate();
	}});
	sleep(100);
	$("#initbox").hide();
	$("#progbox").toggleClass("hidden");
});

$('#p1win').click(function() {
	$('#p1score').html(parseInt($('#p1score').html()) + 1);
	operation('Win/1');
})

$('#p2win').click(function() {
	$('#p2score').html(parseInt($('#p2score').html()) + 1);
	operation('Win/2');
})

$('#reset').click(function() {
	$('#p1score').html(0);
	$('#p2score').html(0);
	operation("Reset");
})

$('#switch').click(function() {
	var p1 = $('#p1').html();
	var p1score = $('#p1score').html();
	$('#p1').html($('#p2').html());
	$('#p2').html(p1);
	$('#p1score').html($('#p2score').html());
	$('#p2score').html(p1score);
	operation("Switch");
});

var myMatches = new Object();

function loadTruskiStats(p1, p2){
	// To-do
}

function setmatch(matchid){
	var match = myMatches[matchid];
	$('#p1').html(match.player1name);
	$('#p2').html(match.player2name);
	$('#p1score').html(0);
	$('#p2score').html(0);
	$('#round').html(match.tournamentname+' - '+match.round);
	loadTruskiStats(match.player1name, match.player2name);
	$('#myModal').modal('hide');
	$('.modal-body').empty();
	$('.modal-body').append('<p>Loading...</p>');
	operation('match/' + match.player1name + '/' + match.player2name + '/' + match.tournamentname + '/' + match.round);
}

$('#selectmatch').click(function() {
	$('#myModal').modal('show');
	var ajaxUrl = "/op/getTournaments";
	$.ajax({url: ajaxUrl, success: function(result){
		var array = JSON.parse(result);
		$('.modal-body').empty();
		for(var i = 0; i < array.length; i++){
			var p = array[i];
			if(!myMatches.hasOwnProperty(p.matchid)){
				$('.modal-body').append('<div onclick="setmatch('+p.matchid+')" class="match center" id="'+p.matchid+'"><h3>'+p.tournamentname+'</h3><h2 class="text-primary">'+p.player1name+' vs '+p.player2name+' <span class="label label-default">New</span></h2><h3>'+p.round+'</h3></div>');
			} else {
				$('.modal-body').append('<div onclick="setmatch('+p.matchid+')" class="match center" id="'+p.matchid+'"><h3>'+p.tournamentname+'</h3><h2 class="text-primary">'+p.player1name+' vs '+p.player2name+' </h2><h3>'+p.round+'</h3></div>');
			}
			myMatches[p.matchid] = p;
		}
	}});
});

$('#closeModal').click(function() {
	$('#myModal').modal('hide');
	$('.modal-body').empty();
	$('.modal-body').append('<p>Loading...</p>');
});