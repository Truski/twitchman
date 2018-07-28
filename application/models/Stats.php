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
    $sql = "SELECT SUM(losses) as sum FROM matches WHERE winnerid = ? AND loserid = ?";
    $leftGameLossWins = current($this->db->query($sql, array($p2, $p1))->result_array())['sum'];
    $rightGameLossWins = current($this->db->query($sql, array($p1, $p2))->result_array())['sum'];
    if($leftGameLossWins != NULL){
      $leftGameWins += $leftGameLossWins;
    }
    if($rightGameLossWins != NULL){
      $rightGameWins += $rightGameLossWins;
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

  public function elochanges(){
    $sql = "SELECT * FROM matches ORDER BY matchid";
    $result = $this->db->query($sql)->result_array();
    $tourneyid = 0;
    foreach ($result as $match){
      if($match['tourneyid'] != -1 && $tourneyid != $match['tourneyid']){
        // Run changes script with $tourneyid
        $sql = "SELECT playerid, elo FROM statistics ORDER BY elo DESC";
        foreach ($this->db->query($sql)->result_array() as $row){
          $query = "INSERT INTO elochanges (tourneyid, playerid, elo) VALUES (?, ?, ?)";
          $this->db->query($query, array($tourneyid, $row['playerid'], $row['elo']));
          echo 'Success - ' . $tourneyid . ' - ' . $row['playerid'] . ' - ' . $row['elo'] . '<br />';
        }

        $tourneyid = $match['tourneyid'];
      }

      $winner = $match['winnerid'];
      $loser = $match['loserid'];
      $elochange = $match['winChange'];
      $sql = "UPDATE statistics SET wins = wins + 1, elo = elo + ? WHERE playerid = ?";
      $this->db->query($sql, array($elochange, $winner));
      $sql = "UPDATE statistics SET losses = losses + 1, elo = elo - ? WHERE playerid = ?";
      $this->db->query($sql, array($elochange, $loser));
    }
    $sql = "SELECT playerid, elo FROM statistics ORDER BY elo DESC";
    foreach ($this->db->query($sql)->result_array() as $row){
      $query = "INSERT INTO elochanges (tourneyid, playerid, elo) VALUES (?, ?, ?)";
      $this->db->query($query, array($tourneyid, $row['playerid'], $row['elo']));
      echo 'Success - ' . $tourneyid . ' - ' . $row['playerid'] . ' - ' . $row['elo'] . '<br />';
    }
  }

  public function getTopCharacters($playerid){
    $sql = "SELECT filename, longname AS 'Character',  COUNT(*) AS games, SUM(CASE WHEN type = 'WIN' THEN 1 ELSE 0 END) as wins, SUM(CASE WHEN type='LOSS' THEN 1 ELSE 0 END) as losses FROM (SELECT 'WIN' as type, winnerchar as name FROM games WHERE winnerid = ? UNION ALL SELECT 'LOSS' as type, loserchar as name FROM games WHERE loserid = ?) AS temp INNER JOIN chars ON temp.name = chars.id GROUP BY name ORDER BY games DESC LIMIT 3";
    return $this->db->query($sql, array($playerid, $playerid))->result();
  }

  public function getBestStage($playerid){
    $sql = "SELECT stage FROM (SELECT stage, COUNT(*) as count FROM games WHERE winnerid = ? GROUP BY stage) as g WHERE count = (SELECT MAX(count) FROM (SELECT stage, COUNT(*) as count FROM games WHERE winnerid = ? GROUP BY stage) AS t)";
    $stage = $this->db->query($sql, array($playerid, $playerid))->result()[0]->stage;
    $sql = "SELECT COUNT(*) as count FROM games WHERE winnerid = ? AND stage = ?";
    $wins = $this->db->query($sql, array($playerid, $stage))->result()[0]->count;
    $sql = "SELECT COUNT(*) as count FROM games WHERE loserid = ? AND stage = ?";
    $losses = $this->db->query($sql, array($playerid, $stage))->result()[0]->count;
    $obj = new stdClass();
    $obj->stage = $stage;
    $obj->wins = $wins;
    $obj->losses = $losses;
    return $obj;
  }

}