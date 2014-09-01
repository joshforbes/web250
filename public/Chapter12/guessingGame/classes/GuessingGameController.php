<?php

class GuessingGameController {

    function __construct(GuessingGameModel $gameModel, GuessingGameState $gameState)
    {
        $this->gameModel = $gameModel;
        $this->gameState = $gameState;
    }

    /**
     * generates a new correct answer and clears stored guesses
     * renders the game template
     */
    public function startNewGame()
    {
        $answer = $this->gameModel->generateAnswer();
        $this->gameState->setAnswer($answer);
        $this->gameState->setGuesses([]);

        $this->renderGame('game.php');
    }

    /**
     * destroys session to quit game
     */
    public function quitGame()
    {
        $this->gameState->destroyState();
        $this->renderGame('quit.php');
    }

    /**
     * the user makes a guess
     * add the guess to the guesses array
     * check to see if the guess is correct
     * render victory or continue game with a hing
     */
    public function makeGuess()
    {
        $this->gameState->addGuess($this->gameState->getCurrentGuess());

        if ($this->isCorrectGuess()) {
            $this->renderGame('victory.php');
        } else {
            $this->createHint();
            $this->renderGame('game.php');
        }
    }

    /**
     * creates a hint based on current guess
     */
    public function createHint()
    {
        if ($this->gameState->getCurrentGuess() > $this->gameState->getAnswer()) {
            $this->gameModel->setHint('high');
        } else {
            $this->gameModel->setHint('low');
        }
    }

    /**
     * @return bool
     *  determines whether current guess is correct
     */
    public function isCorrectGuess()
    {
        return ($this->gameState->getCurrentGuess() == $this->gameState->getAnswer());
    }

    /**
     * @param $template
     * renders the game in html using the requested template
     */
    private function renderGame($template)
    {
        $templatePath = 'templates/' . $template;
        $mainTemplatePath = 'templates/mainTemplate.php';

        require($mainTemplatePath);
    }


    public function run()
    {
        if (isset($_GET['quitGame'])) {
            return $this->quitGame();
        }

        if (isset($_GET['currentGuess'])) {
            return $this->makeGuess();
        }

        return $this->startNewGame();

    }

}