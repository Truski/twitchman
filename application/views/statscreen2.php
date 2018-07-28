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
  margin: 20px 25px;
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
  margin-top: 10px;
  margin-bottom: 15px;
}

.stagerate {
  margin-top: .65em;
  font-size: 1.2em;
  margin-bottom: .85em;
}

.flexer {
  display: flex;
  justify-content: space-between;
  flex-direction: column;
  height: 100%;
}
}
</style>
</head>
<body>
  <div id="left-half">
    <div class="flexer">
      <div class="sec-chars">
        <h1><?=$p1name?></h1>
        <h2>Most Played Characters</h2>
        <?php foreach($p1chars as $char): ?>
        <?php $percent1 = (int) ($char->wins / $char->games * 100);
        $percent2 = 100 - $percent1; ?>
        <div class="charbar">
          <img src="/assets/chars/<?=$char->filename?>.png" />
          <div class="fillbar">
            <div style="width: <?=$percent1?>%" class="fill-left"> 
              <span class="left-text"><?=$char->wins?>W</span>
            </div>
            <div style="width: <?=$percent2?>%" class="fill-right"> 
              <span class="right-text"><?=$char->losses > 0 ? $char->losses . 'L' : ''?></span>
            </div>
            <div class="clearfix"></div>
          </div>
          <span class="winrate"><?=$percent1?>%</span>
          <div class="clearfix"></div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="best-stage">
        <h2>Best Stage</h2>
        <img class="stage" src="/assets/stages/stage<?=$p1stage->stage?>.png" />
        <?php $sum = (int) $p1stage->wins + $p1stage->losses; ?>
        <?php $winrate = (int) ($p1stage->wins / $sum * 100); ?>
        <p class="stagerate"><?=$winrate?>% Win Rate in <?=$sum?> Games</p>
      </div>
    </div>
  </div>
  <div id="right-half">
    <div class="flexer">
      <div class="sec-chars">
        <h1><?=$p2name?></h1>
        <h2>Most Played Characters</h2>
        <?php foreach($p2chars as $char): ?>
        <?php $percent1 = (int) ($char->wins / $char->games * 100);
        $percent2 = 100 - $percent1; ?>
        <div class="charbar">
          <img src="/assets/chars/<?=$char->filename?>.png" />
          <div class="fillbar">
            <div style="width: <?=$percent1?>%" class="fill-left"> 
              <span class="left-text"><?=$char->wins?>W</span>
            </div>
            <div style="width: <?=$percent2?>%" class="fill-right"> 
              <span class="right-text"><?=$char->losses > 0 ? $char->losses . 'L' : ''?></span>
            </div>
            <div class="clearfix"></div>
          </div>
          <span class="winrate"><?=$percent1?>%</span>
          <div class="clearfix"></div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="best-stage">
        <h2>Best Stage</h2>
        <img class="stage" src="/assets/stages/stage<?=$p2stage->stage?>.png" />
        <?php $sum = (int) $p2stage->wins + $p2stage->losses; ?>
        <?php $winrate = (int) ($p2stage->wins / $sum * 100); ?>
        <p class="stagerate"><?=$winrate?>% Win Rate in <?=$sum?> Games</p>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</body>
</html>