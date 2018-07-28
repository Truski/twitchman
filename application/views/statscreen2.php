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
  background-image: url("/assets/img/inferno-2018-bg.png");
  box-sizing: border-box;
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
  font-size: 3rem;
  margin-top: 10px;
  text-align: center;
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

#left-half {
  width: 50%;
  float: left;
}

#right-half {
  width: 50%;
  float: right;
}

h1 {
  text-align: center;
  font-size: 3em;
}

h2 {
  text-align: center;
}

.fillbar {
  width: 50%;
  height: 50px;
  float: left;
}

.fill-left {
  background-color: #1070c0;
  height: 100%;
  float: left;
  text-align: left;
  line-height: 50px;
}

.fill-right {
  background: #d04040;
  height: 100%;
  float: left;
  text-align: right;
}

.left-text {
  padding-left: 1em;
}

.right-text {
  padding-right: 1em;
}

.charbar img {
  float: left;
  margin-right: 1.5em;
}

.charbar {
  margin: 25px;
  margin-top:10px;
  padding: 1em 2em;
  background-color: rgba(0, 0, 0, .5);
  height: 50px;
  line-height: 50px;
}

.cleafix {
  clear: both;
}

.winrate {
  padding-left: 1.25em;
  width: 5em;
  text-align: center;
  float: left;
}

.stage {
  height: 150px;
}

.best-stage {
  text-align: center;
}

h1 {
  margin-top: 15px;
}
h2 {
  margin-bottom: 15px;
}

.stagerate {
  margin-top: .25em;
  font-size: 1.2em;
}
</style>
</head>
<body>
  <div id="left-half">
    <h1><?=$p1name?></h1>
    <h2>Top Characters</h2>
    <div class="charbar">
      <img src="/assets/chars/falco.png" />
      <div class="fillbar">
        <div style="width: 60%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 40%" class="fill-right"> 
          <span class="right-text">6L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <span class="winrate">60%</span>
      <div class="clearfix"></div>
    </div>
    <div class="charbar">
      <img src="/assets/chars/fox.png" />
      <div class="fillbar">
        <div style="width: 0%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 100%" class="fill-right"> 
          <span class="right-text">3L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <span class="winrate">0%</span>
      <div class="clearfix"></div>
    </div>
    <div class="charbar">
      <img src="/assets/chars/donkeykong.png" />
      <div class="fillbar">
        <div style="width: 60%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 40%" class="fill-right"> 
          <span class="right-text">6L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="winrate">60%</div>
      <div class="clearfix"></div>
    </div>
    <div class="best-stage">
      <h2>Best Stage</h2>
      <img class="stage" src="/assets/stages/stage0.png" />
      <p class="stagerate">72% W/L in 8 games</p>
    </div>
  </div>
  <div id="right-half">
    <h1><?=$p2name?></h1>
    <h2>Top Characters</h2>
    <div class="charbar">
      <img src="/assets/chars/fox.png" />
      <div class="fillbar">
        <div style="width: 60%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 40%" class="fill-right"> 
          <span class="right-text">6L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <span class="winrate">60%</span>
      <div class="clearfix"></div>
    </div>
    <div class="charbar">
      <img src="/assets/chars/peach.png" />
      <div class="fillbar">
        <div style="width: 0%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 100%" class="fill-right"> 
          <span class="right-text">3L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <span class="winrate">0%</span>
      <div class="clearfix"></div>
    </div>
    <div class="charbar">
      <img src="/assets/chars/icees.png" />
      <div class="fillbar">
        <div style="width: 60%" class="fill-left"> 
          <span class="left-text">18W</span>
        </div>
        <div style="width: 40%" class="fill-right"> 
          <span class="right-text">6L</span>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="winrate">60%</div>
      <div class="clearfix"></div>
    </div>
    <div class="best-stage">
      <h2>Best Stage</h2>
      <img class="stage" src="/assets/stages/stage0.png" />
      <p class="stagerate">72% W/L in 8 games</p>
    </div>
  </div>
  <div class="clearfix"></div>
</body>
</html>