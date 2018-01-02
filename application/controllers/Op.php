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
		edit('round', 'Pools');
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

	public function scoreLose($side){
		edit('p' . $side . 'score', contents('p' . $side . 'score') - 1);
	}

	public function scoreMatch($p1, $p2, $tourney, $round){
		edit('p1', urldecode($p1));
		edit('p2', urldecode($p2));
		edit('p1score', 0);
		edit('p2score', 0);
		edit('title', urldecode($tourney) . ' - ' . urldecode($round));
		edit('round', urldecode($round));
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

		// Place desired tournaments to fetch matches from
		$tourney_names = array("btest1234");

		// Get all open matches from the tapitest tournament
		$matches = array();
		$tournies = array();
		$players = array();

		foreach($tourney_names as $pool){
			$rawMatches = $c->getMatches($pool, array('state'=>'open'));
			if($rawMatches == false){
				echo "[]";
				return;
			}

			// Get Matches
			foreach($rawMatches->match as $m){
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
				$tournies[$key] = (string) $c->getTournament($key)->name;
			}

			// Get Player Names
			$playerNames = $c->getParticipants($pool)->participant;
			foreach($playerNames as $p){
				$players[(int)$p->id] = (string) $p->name;
			}
		}


		// Set Tournament and Player names in returned array
		foreach($matches as $m){
			$m->player1name = $players[$m->player1];
			$m->player2name = $players[$m->player2];
			$m->tournamentname = $tournies[$m->tournament];
		}

		echo json_encode($matches);
	}

	// Return a JSON array of combos from tag to id in database
	public function getPlayerMap() {
		$this->load->database();
		$this->load->model('stats');
		$players = $this->stats->getPlayerMap();
		echo json_encode($players);
	}
}
