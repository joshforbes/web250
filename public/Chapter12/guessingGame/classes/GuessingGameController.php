<?php

class GuessingGameController {

    function __construct(GuessingGameModel $gameModel, GuessingGameState $gameState)
    {
        $this->gameModel = $gameModel;
        $this->gameState = $gameState;
    }

    /**
     * initialize a new game
     */
    private function init() {
        if (!$this->gameState->getAnswer()) {
            $answer = $this->gameModel->generateAnswer();
            $this->gameState->setAnswer($answer);
        }
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

    /**
     * @param $guess
     * @param $answer
     * @return bool
     * compares the supplied guess to the correct answer
     */
    private function evaluateGuess($guess, $answer)
    {
        if ($guess == $answer) {
            return true;
        } elseif ($guess > $answer){
            $this->gameModel->setHint('high');
            return false;
        } else {
            $this->gameModel->setHint('low');
            return false;
        }
    }

    /**
     * acts as a router for the game
     */
    public function run()
    {
        if (isset($_GET['newGame'])) {
            $this->gameState->destroyState();
        }

        if (isset($_GET['quitGame'])) {
            $this->gameState->destroyState();
            return $this->renderGame('quit.php');
        }

        $this->init();

        if ($this->evaluateGuess($this->gameState->getCurrentGuess(), $this->gameState->getAnswer())) {
            $this->renderGame('victory.php');
        } else {
            $this->gameState->addGuess($this->gameState->getCurrentGuess());
            $this->renderGame('game.php');
        }

    }
}