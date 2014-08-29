<?php
@include 'classes/GuessingGameModel.php';
@include 'classes/GuessingGameState.php';
@include 'classes/GuessingGameController.php';

$gameModel = new GuessingGameModel();
$gameState = new GuessingGameState($gameModel);
$gameController = new GuessingGameController($gameModel, $gameState);

$gameController->run();




