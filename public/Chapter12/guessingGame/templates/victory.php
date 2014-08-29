
<div class="victory-container">
    <h4><span class="glyphicon glyphicon-star"></span> Congratulations! Your guess was correct <span class="glyphicon glyphicon-star"></h4>
    <p>You guessed the correct answer in <span class="highlight"><?= count($this->gameState->getGuesses()); ?></span> guesses</p>
    <a href="guess.php?newGame"><button class="btn btn-primary">Try again</button></a>
    <a href="guess.php?quitGame"><button class="btn btn-danger">Quit</button></a>
</div>
