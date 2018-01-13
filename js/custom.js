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

var mapa = {};

function getPlayerMap(){
	var ajaxUrl = "/op/getPlayerMap";
	$.ajax({url: ajaxUrl, success: function(result){
		var array = JSON.parse(result);
		for(var i = 0; i < array.length; i++){
			mapa[array[i].tag] = array[i].playerid;
		}
	}});
}

$(document).ready(function() {
	operation('Init');
	getPlayerMap();
	sleep(100);
	$("#initbox").hide();
	$("#progbox").toggleClass("hidden");
	sleep(100);
	$('#selectmatch').trigger('click');
	$.ajax({
	 type: 'GET',
	 url: 'https://api.twitch.tv/kraken/streams/vjasmash',
	 headers: {
	   'Client-ID': '7elmiqvvpz0z61dnmkjd7tk4xqej72'
	 },
	 success: function(data) {
	 	if(data.stream != null)
	   		$('#viewers').text(data.stream.viewers + " viewers")
	   	else
	   		$('#viewers').text("Stream is offline");
	   	var time = new Date();
		$('#lastupdated').text(
		    ("0" + time.getHours()%12).slice(-2)   + ":" + 
		    ("0" + time.getMinutes()).slice(-2) + ":" + 
		    ("0" + time.getSeconds()).slice(-2));
	 }
	});
	setInterval( function(){
		$.ajax({
		 type: 'GET',
		 url: 'https://api.twitch.tv/kraken/streams/vjasmash',
		 headers: {
		   'Client-ID': '7elmiqvvpz0z61dnmkjd7tk4xqej72'
		 },
		 success: function(data) {
		 	if(data.stream != null)
		   		$('#viewers').text(data.stream.viewers + " viewers");
		   	else
		   		$('#viewers').text("Stream is offline.");
		   	var time = new Date();
			$('#lastupdated').text(
			    ("0" + time.getHours()%12).slice(-2)   + ":" + 
			    ("0" + time.getMinutes()).slice(-2) + ":" + 
			    ("0" + time.getSeconds()).slice(-2));
		 }
		});
	}, 60000);
});

$('#p1win').click(function() {
	$('#p1score').html(parseInt($('#p1score').html()) + 1);
	operation('Win/1');
});

$('#p2win').click(function() {
	$('#p2score').html(parseInt($('#p2score').html()) + 1);
	operation('Win/2');
});

$('#p1lose').click(function() {
	$('#p1score').html(parseInt($('#p1score').html()) - 1);
	operation('Lose/1');
});

$('#p2lose').click(function() {
	$('#p2score').html(parseInt($('#p2score').html()) - 1);
	operation('Lose/2');
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
	var ajaxUrl = "/op/truskistats/"+p1+"/"+p2;
	$.ajax({url: ajaxUrl, success: function(result){
		var obj = JSON.parse(result);
		$('#elochart').remove();
		$('#elochartc').append('<canvas id="elochart"></canvas>');
		var ctx1 = document.getElementById("elochart").getContext("2d");
		var myChart = new Chart(ctx1, {
			type: 'line',
			data: {
				labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
				datasets: [{
					label: match.player1name,
					data: obj.p1elo,
					borderColor: 'blue',
					fill: false
				}, {
					label: match.player2name,
					data: obj.p2elo,
					borderColor: 'red',
					fill: false
				}]
			},
			options: {
				scales: {
					xAxes:  [{
						display: false
					}]
				}
			}
		});
		$('#winchart').remove();
		$('#winchartc').append('<canvas id="winchart"></canvas>');
		var ctx2 = document.getElementById("winchart").getContext("2d");
		var myChart = new Chart(ctx2, {
			type: 'bar',
			data: {
				labels: [match.player1name, match.player2name],
				datasets: [{
					label: 'Wins',
					data: [obj.p1wins, obj.p2wins],
					backgroundColor: [
						'blue',
						'blue',
					],
					borderColor: [
						'darkblue',
						'darkblue'
					],
					borderWidth: 4
				}, {
					label: 'Losses',
						data: [obj.p1losses, obj.p2losses],
					backgroundColor: [
						'red',
						'red'
					],
					borderColor: [
						'darkred',
						'darkred'
					],
					borderWidth: 4
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}, 
				animation: {
					onComplete: function(animation) {

						var ctx = this.chart.ctx;
						var chart = this;

						ctx.textAlign = "center";
						ctx.textBaseline = "bottom";
						ctx.font = "26px arial";

						let datasets = this.config.data.datasets;
						datasets.forEach(function (dataset, i) {
							chart.getDatasetMeta(i).data.forEach(function (p, j) {
								ctx.fillText(datasets[i].data[j], p._model.x, p._model.y - 0);
							});
						});
					}
				}
			}
		});
	}});
}

function setmatch(matchid){
	match = myMatches[matchid];
	$('#p1').html(match.player1name);
	$('#p2').html(match.player2name);
	$('#p1score').html(0);
	$('#p2score').html(0);
	$('#round').html(match.tournamentname+' - '+match.round);
	loadTruskiStats(mapa[match.player1name], mapa[match.player2name]);
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

var charsel = null;

$('#sp1char').click(function() {
	charsel = 1;
	$('#charselect').css('display', 'block');
});

$('#sp2char').click(function() {
	charsel = 2;
	$('#charselect').css('display', 'block');
});

$('.chararea').click(function(e){
	$('#p'+charsel+'charpic').css('background-image', "url('/assets/chars/"+e.target.alt+".png')");
	operation('SetImg/'+charsel+'/'+e.target.alt);
	$('#charselect').css('display', 'none');
});

var commselect = null;

$('#leftcommselect').click(function(){
	commselect = "left";
	$('#commselect').css('display', 'block');
});

$('#rightcommselect').click(function(){
	commselect = "right";
	$('#commselect').css('display', 'block');
});

var imagenames = ['lynx', 'hat', 'dino', 'alfster', 'silverbullet', 'leafeon', 'sead', 'truski', 'jeffthechef', 'killgore52', 'rhyden', 'hawaii4oh', 'nina'];
var commnames = ['Lynx', 'Hat', 'Dino', 'Alfster', 'Silverbullet', 'Leafeon523', 'Sea D', 'Truski', 'Jeffthechef', 'Killgore52', 'Rhyden', 'Hawaii4oh', 'YoshiGirl'];
var twitters = ['@SgtSkills', '', 'YT: DinoProductions', '', '@zackwind', '', '@Jeke68', 'Twitch: folevilis', '', '', '', '', ''];

$('.commarea').click(function(e){
	$('#'+commselect + 'commpic').attr('src', "/assets/comms/"+imagenames[parseInt(e.target.alt)]+".jpg");
	$('#'+commselect + 'commname').text(commnames[parseInt(e.target.alt)]);
	operation('SetComms/'+commselect+'/'+e.target.alt);
	$('#commselect').css('display', 'none');
});

$(document).keydown(function(event) {
	if(event.keycode != 122)
  		event.preventDefault();
});