

<div class="guess-container">
<form action="guess.php" method="post">
    <select name="currentGuess">
        <?php foreach ($this->gameModel->getAnswerChoices() as $choices): ?>
            <option value="<?= $choices; ?>"><?= $choices; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Guess"/>
</form>
</div>

<?php if(($this->gameState->getCurrentGuess())): ?>
    <div class="alert alert-info">
        <h5>previous guesses:
            <?php foreach ($this->gameState->getGuesses() as $guess): ?>
                <?= $guess ?>
            <?php endforeach; ?></h5>
        <h5>hint: your last guess was too <?= $this->gameModel->getHint(); ?>.</h5>
    </div>
<?php endif; ?>
