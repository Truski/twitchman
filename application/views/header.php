<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="A Twitch Stream Manager">
	<meta name="author" content="Daniel Wojtowicz">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 sidebar">
				<h2 class="text-center">Twitch Manager</h2>
				<ul class="list-group">
					<a href="#" id="selectmatch"><li class="list-group-item">Select Match</li></a>
					<a href="#" id="selectcomms"><li class="list-group-item">Select Commentators</li></a>
				</ul>
				<iframe frameborder="0"
				scrolling="no" 
				id="chat_embed" 
				src="http://www.twitch.tv/<?=TWITCH_NAME?>/chat" 
				height="725" 
				width="100%">
			</iframe>
		</div>
		<div class="col-md-9">