<html>
<head>
<style>
html, body {
	padding: 0px;
	margin: 0px;
	font-family: "Copperplate Gothic";
	color: white;
	font-weight: bold;
	font-size: 105%;
}

body {
	background-image: url("/assets/img/statsbg.png");
	box-sizing: border-box;
}

#title > div {
	display: inline-block;
	font-size: 3rem;
}

#vs {
	text-align: center;
	width: 100px;
	font-size: 0%;
}

#leftname {
	text-align: right;
	width:590px;
}

#rightname {
	text-align: left;
	width:580px;
}

#title {
	width: 1280px;
	font-size: 0;
	margin-top: 20px;
}

.mini {
	font-size: 75%;
}

.chartsq {
	width: 500px;
	height: 300px;
	background-color: rgba(255, 255, 255, 1);
	border: 1px solid black;
	display: inline-block;
	box-sizing: border-box;
}

#chartdiv {
	margin-top: 5px;
}

#windiv {
	margin-left: 90px;
}

#elodiv {
	margin-left: 100px;
	padding: 5px;
}

#headtohead {
	text-align: center;
	width: 500px;
	margin-left: 140px;
	margin-top: 20px;
	display: inline-block;
	float: left;
}

h3 {
	margin-top: 5px;
}

h1 {
	margin-bottom: 5px;
}

#matchhistory {
	text-align: center;
	width: 500px;
	margin-top: 20px;
	display: inline-block;
	float: left;
}

#matchhistory > h1 {
	font-size: 155%;
	margin: 8px;
}

#matchhistory > h2 {
	margin-bottom: 30px;
}

#rounddiv {
	text-align: center;
	font-size: 130%;
	margin-top: 5px;
}

#headtohead > h1 {
	margin-top: 0;
}

#headtohead > h2 {
	margin-bottom: 10px;
}

#wl {
	width: 500px;
	text-align: center;
	margin-left: 90px;
}
#elolabel {
	width: 500px;
	text-align: center;
	margin-left: 100px;
}

#labels {
	width: 1280px;
}

#labels > h2 {
	display: inline-block;
	padding: 0px;
	margin-bottom: 0px;
	margin-top: 5px;
}

</style>
<script src="/js/Chart.bundle.min.js"></script>
</head>
<body>
<div id="title">
<div id="leftname"><?=$p1name?></div>
<div id="vs"><span class="mini">VS</span></div>
<div id="rightname"><?=$p2name?></div>
</div>
<div id="rounddiv"><?=$roundname?></div>
<div id="labels">
<h2 id="wl">Wins and Losses</h2>
<h2 id="elolabel">Elo Rating</h2>
</div>
<div id="chartdiv">
<div class="chartsq" id="windiv">
<canvas id="winchartjs" width="500" height="300"></canvas>
</div>
<div class="chartsq" id="elodiv">
<canvas id="elochartjs" width="480" height="280"></canvas>
</div>
</div>
<div id="headtohead">
<h2>Head - To - Head</h2>
<h1><?=$leftWins?> - <?=$rightWins?></h1>
<h3>Sets</h3>
<h1><?=$leftGameWins?> - <?=$rightGameWins?></h1>
<h3>Games</h3>
</div>
<div id="matchhistory">
<h2>Last Time Played</h2>
<?php if ($last != NULL) : ?>
<h1><?=$last['winner'] ?> won<br /><?=$last['wins'] . ' - ' . $last['losses']?></h1>
<h1><?=$last['roundname']?></h1>
<h1><?=$last['tourneyname']?></h1>
<?php else : ?>
	<h1>No match history.</h1>
<?php endif; ?>
</div>

<script>

	var ctx = document.getElementById("winchartjs").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["<?=$p1name?>", "<?=$p2name?>"],
			datasets: [{
				label: 'Wins',
				data: [<?=$cLeftWins.','.$cRightWins?>],
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
				data: [<?=$cLeftLosses.','.$cRightLosses?>],
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

	var ctx = document.getElementById("elochartjs").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
			datasets: [{
				label: '<?=$p1name?>',
				data: <?=json_encode($leftHistory)?>,
				borderColor: 'blue',
				fill: false
			}, {
				label: '<?=$p2name?>',
				data: <?=json_encode($rightHistory)?>,
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

</script>
</body>
</html>