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

<img id="charselect" src="/assets/img/charlist.png" border="0" width="1164" height="370" usemap="#charmap" alt="" />
<map name="charmap" id="charmap">
<area class="chararea" alt="drmario" title="" href="#" shape="rect" coords="6,10,127,129" />
<area class="chararea" alt="mario" title="" href="#" shape="rect" coords="136,3,257,122" />
<area class="chararea" alt="luigi" title="" href="#" shape="rect" coords="264,4,385,123" />
<area class="chararea" alt="bowser" title="" href="#" shape="rect" coords="392,4,513,123" />
<area class="chararea" alt="peach" title="" href="#" shape="rect" coords="520,3,641,122" />
<area class="chararea" alt="yoshi" title="" href="#" shape="rect" coords="650,1,771,120" />
<area class="chararea" alt="donkeykong" title="" href="#" shape="rect" coords="779,1,900,120" />
<area class="chararea" alt="falcon" title="" href="#" shape="rect" coords="905,3,1026,122" />
<area class="chararea" alt="ganon" title="" href="#" shape="rect" coords="1033,9,1154,128" />
<area class="chararea" alt="falco" title="" href="#" shape="rect" coords="7,131,128,250" />
<area class="chararea" alt="fox" title="" href="#" shape="rect" coords="133,125,254,244" />
<area class="chararea" alt="ness" title="" href="#" shape="rect" coords="262,124,383,243" />
<area class="chararea" alt="icees" title="" href="#" shape="rect" coords="390,123,511,242" />
<area class="chararea" alt="kirby" title="" href="#" shape="rect" coords="520,124,641,243" />
<area class="chararea" alt="samus" title="" href="#" shape="rect" coords="648,122,769,241" />
<area class="chararea" alt="zelda" title="" href="#" shape="rect" coords="777,124,837,243" />
<area class="chararea" alt="sheik" title="" href="#" shape="rect" coords="837,124,898,243" />
<area class="chararea" alt="link" title="" href="#" shape="rect" coords="905,126,1026,245" />
<area class="chararea" alt="younglink" title="" href="#" shape="rect" coords="1034,134,1155,253" />
<area class="chararea" alt="pichu" title="" href="#" shape="rect" coords="136,249,257,368" />
<area class="chararea" alt="pikachu" title="" href="#" shape="rect" coords="263,247,384,366" />
<area class="chararea" alt="jigglypuff" title="" href="#" shape="rect" coords="389,247,510,366" />
<area class="chararea" alt="mewtwo" title="" href="#" shape="rect" coords="521,246,642,365" />
<area class="chararea" alt="gaw" title="" href="#" shape="rect" coords="648,245,769,364" />
<area class="chararea" alt="marth" title="" href="#" shape="rect" coords="774,247,895,366" />
<area class="chararea" alt="roy" title="" href="#" shape="rect" coords="904,249,1025,368" />
</map>

<img id="commselect" src="/assets/img/cteam.png" border="0" width="1768" height="274" usemap="#commmap" alt="" />
<map name="commmap" id="commmap">
<area class="commarea" alt="0" title="" href="#" shape="rect" coords="0,0,135,274" />
<area class="commarea" alt="1" title="" href="#" shape="rect" coords="136,0,271,274" />
<area class="commarea" alt="2" title="" href="#" shape="rect" coords="272,0,407,274" />
<area class="commarea" alt="3" title="" href="#" shape="rect" coords="408,0,543,274" />
<area class="commarea" alt="4" title="" href="#" shape="rect" coords="544,0,679,274" />
<area class="commarea" alt="5" title="" href="#" shape="rect" coords="680,0,815,274" />
<area class="commarea" alt="6" title="" href="#" shape="rect" coords="816,0,951,274" />
<area class="commarea" alt="7" title="" href="#" shape="rect" coords="952,0,1087,274" />
<area class="commarea" alt="8" title="" href="#" shape="rect" coords="1088,0,1223,274" />
<area class="commarea" alt="9" title="" href="#" shape="rect" coords="1224,0,1359,274" />
<area class="commarea" alt="10" title="" href="#" shape="rect" coords="1360,0,1495,274" />
<area class="commarea" alt="11" title="" href="#" shape="rect" coords="1496,0,1631,274" />
<area class="commarea" alt="12" title="" href="#" shape="rect" coords="1632,0,1767,274" />
</map>
