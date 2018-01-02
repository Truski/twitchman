<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Op extends CI_Controller {

	public function scoreInit(){
		if(!file_exists(DIRECTORY)){
			mkdir(DIRECTORY, 0777, true);
		}
		edit('p1', 'Player 1');
		edit('p2', 'Player 2');
		edit('p1score', 0);
		edit('p2score', 0);
		edit('title', 'Pools');
		edit('p1img', 'fox');
		edit('p2img', 'falco');
		edit('leftcomm', 'Left Commie');
		edit('rightcomm', 'Right Commie');
		edit('lefttwitter', '@DanWojtowicz');
		edit('righttwitter', 'YT: mroyo0920');
	}

	public function scoreReset(){
		edit('p1score', 0);
		edit('p2score', 0);
	}

	public function scoreSwitch(){
		$p1 = contents('p1');
		$p1s = contents('p1score');
		edit('p1', contents('p2'));
		edit('p2', $p1);
		edit('p1score', contents('p2score'));
		edit('p2score', $p1s);
	}

	public function scoreWin($side){
		edit('p' . $side . 'score', contents('p' . $side . 'score') + 1);
	}

	public function scoreMatch($p1, $p2, $tourney, $round){
		edit('p1', $p1);
		edit('p2', $p2);
		edit('p1score', 0);
		edit('p2score', 0);
		edit('title', urldecode($tourney) . ' - ' . urldecode($round));
	}

	public function submitScore($tourneyID, $matchID, $winnerID, $score){
		include('/application/third_party/challonge.class.php');
		$c = new ChallongeAPI(API_KEY);
		$c->verify_ssl = false;

		$c->updateMatch($tourneyID, $matchID, array('match[winner_id]'=>$winnerID,'match[scores_csv]'=>$score));
	}

	public function getTournaments(){
		include('/application/third_party/challonge.class.php');
		$c = new ChallongeAPI(API_KEY);
		$c->verify_ssl = false;

		// Get all open matches from the tapitest tournament
		$tournaments = $c->getMatches('tapitest', array('state'=>'open'));
		if($tournaments == false){
			echo "[]";
			return;
		}
		$matches = array();
		$tournies = array();
		foreach($tournaments->match as $m){
			$match = new stdClass;
			$match->player1 = (int)$m->{'player1-id'};
			$match->player2 = (int)$m->{'player2-id'};
			$match->tournament = (int)$m->{'tournament-id'};
			$match->round = round_name($m->round);
			$match->matchid = (int)$m->id;
			array_push($matches, $match);
			$tournies[(int)$match->tournament] = null;
		}
		
		// Get Tournament Names
		foreach($tournies as $key=>$val){
			$tournies[$key] = (string)$c->getTournament($key)->name;
		}

		// Get Player Names
		$playerg = $c->getParticipants('tapitest')->participant;
		$players = array();
		foreach($playerg as $p){
			$players[(int)$p->id] = (string)$p->name;
		}

		// Set Tournament and Player names in returned array
		foreach($matches as $m){
			$m->player1name = $players[$m->player1];
			$m->player2name = $players[$m->player2];
			$m->tournamentname = $tournies[$m->tournament];
		}
		echo json_encode($matches);
	}
}
