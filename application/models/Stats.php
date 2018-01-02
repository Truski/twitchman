<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends CI_Model {

  public function getWinRate($playerid){
    $sql = "SELECT wins, losses FROM statistics WHERE playerid = ?";
    return $this->db->query($sql, $playerid)->row_array();
  }

  public function getElohistory($p1){
    $sql = "SELECT elo FROM elochanges WHERE playerid = ? ORDER BY tourneyid ASC";
    $result = $this->db->query($sql, array($p1))->result_array();
    $history = array();
    foreach($result as $change){
      $history[] = $change['elo'];
    }
    return $history;
  }

  public function getPlayerMap(){
    $sql = "SELECT tag, playerid FROM profiles";
    return $this->db->query($sql)->result_array();
  }

  public function matchup($p1, $p2){
    $arr = array();
    $sql = "SELECT elo FROM elochanges WHERE playerid = ? ORDER BY tourneyid ASC";
    $result = $this->db->query($sql, array($p1))->result_array();
    $history = array();
    foreach($result as $change){
      $history[] = $change['elo'];
    }
    $arr['leftHistory'] = $history;

    $result = $this->db->query($sql, array($p2))->result_array();
    $history = array();
    foreach($result as $change){
      $history[] = $change['elo'];
    }
    $arr['rightHistory'] = $history;

    // Head to head stats

    // Sets

    $sql = "SELECT count(*) as count FROM matches WHERE winnerid = ? AND loserid = ?";
    $leftWins = current($this->db->query($sql, array($p1, $p2))->result_array())['count'];
    $rightWins = current($this->db->query($sql, array($p2, $p1))->result_array())['count'];
    $arr['leftWins'] = $leftWins;
    $arr['rightWins'] = $rightWins;

    // Games
    $sql = "SELECT SUM(wins) as sum FROM matches WHERE winnerid = ? AND loserid = ?";
    $leftGameWins = current($this->db->query($sql, array($p1, $p2))->result_array())['sum'];
    $rightGameWins = current($this->db->query($sql, array($p2, $p1))->result_array())['sum'];
    if($leftGameWins == NULL){
      $leftGameWins = 0;
    }
    if($rightGameWins == NULL){
      $rightGameWins = 0;
    }
    $arr['leftGameWins'] = $leftGameWins;
    $arr['rightGameWins'] = $rightGameWins;

    // Last time played

    $sql = "SELECT winner.tag as winner, loser.tag as loser, wins, losses, tourneyname, roundname FROM matches m NATURAL JOIN tournaments NATURAL JOIN rounds INNER JOIN profiles winner ON m.winnerid = winner.playerid INNER JOIN profiles loser ON m.loserid = loser.playerid  WHERE winnerid = ? AND loserid = ? OR winnerid = ? AND loserid = ? ORDER BY matchid DESC LIMIT 1";
    $result = $this->db->query($sql, array($p1, $p2, $p2, $p1))->result_array();
    if(empty($result)){
      $arr['last'] = NULL;
    } else {
      $arr['last'] = current($result);
    }

    // get winrates

    $sql = "SELECT wins, losses FROM statistics WHERE playerid = ?";
    $result = current($this->db->query($sql, array($p1))->result_array());
    $arr['cLeftWins'] = $result['wins'];
    $arr['cLeftLosses'] = $result['losses'];

    $result = current($this->db->query($sql, array($p2))->result_array());
    $arr['cRightWins'] = $result['wins'];
    $arr['cRightLosses'] = $result['losses'];
    return $arr;
  }

}