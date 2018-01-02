<div class="row">

	<div class="col-md-12" id="initbox">
		<h1 class="text-center">Program initializing...</h1>
	</div>

	<div class="col-md-12 hidden center" id="progbox">

		<div class="col-md-7">

			<div class="row">
				<h2><span id="round">Pools</span></h2>
			</div>
			<div class="row">
				<div class="col-md-5 boxed" id="p1charpic">
					<a class="btn btn-primary" id="sp1char">Char</a>
					<h2><span id="p1">Player 1</span></h2>
					<h3><span id="p1score">0</span></h3>
					<a class="btn btn-success" id="p1win">Win</a>
					<a class="btn btn-danger" id="p1lose">Lose</a>
				</div>
				<div class="col-md-5 col-md-offset-2 boxed" id="p2charpic">
					<a class="btn btn-primary" id="sp2char">Char</a>
					<h2><span id="p2">Player 2</span></h2>
					<h3><span id="p2score">0</span></h3>
					<a class="btn btn-success" id="p2win">Win</a>
					<a class="btn btn-danger" id="p2lose">Lose</a>
				</div>
			</div>
			<div class="row">
				<p><a class="btn btn-primary" id="reset">Reset Score</a> <a class="btn btn-primary" id="switch">Switch Sides</a></p>
			</div>
			<div class="row">
				<p><a class="btn btn-warning disabled" id="submit">Submit to Challonge</a></p>
			</div>
			<div class="row">
				<p id="status" class="text-success">Up-To-Date</p>
			</div>
			<div class="row">
				<h1>Commentators</h1>
			</div>
			<div class="row">
				<div class="commblock">
					<h2><span id="leftcommname">Lynx</span></h2>
					<img class="commpic" id="leftcommpic" src="/assets/comms/lynx.jpg" />
					<p><a class="btn btn-primary" id="leftcommselect">Select</a></p>
				</div>				
				<div id="commdiv"></div>
				<div class="commblock">
					<h2><span id="rightcommname">Hat</span></h2>
					<img class="commpic" id="rightcommpic" src="/assets/comms/hat.jpg" />
					<p><a class="btn btn-primary" id="rightcommselect">Select</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-5" id="darkstats">
			<h2>TruskiStats &reg;</h2>
			<div id="stats">
				<div class="chart" id="winchartc">
					<canvas id="winchart"></canvas>
				</div>
				<div class="chart" id="elochartc">
					<canvas id="elochart"></canvas>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog" id="modal1">

		<!-- Modal1 content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Select Match</h4>
			</div>
			<div class="modal-body" id="mod-matches">
				<p>Loading...</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-danger" id="closeModal">Close</a>
			</div>
		</div>

	</div>
	<div class="modal-dialog hidden" id="modal2">

		<!-- Modal2 content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Successfully Submitted Match</h4>
			</div>
			<div class="modal-body">
				<p>Successfully submitted match.</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-success" id="closeModal2">Select New Match</a>
			</div>
		</div>

	</div>
</div>