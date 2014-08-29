<?php

class GuessingGameState {

    /**
     * @var array
     * previous guess the user has made
     */
    private $guesses;

    /**
     * @var int
     * the correct answer
     */
    private $answer;

    /**
     * @var int
     * users current guess
     */
    private $currentGuess;


    function __construct(GuessingGameModel $gameModel)
    {
        $this->gameModel = $gameModel;

        if (!isset($_SESSION)) {
            session_start();
        }

        $this->currentGuess = isset($_GET['currentGuess'])
            ? $_GET['currentGuess']
            : null;

        $this->guesses = isset($_SESSION['guesses'])
            ? $_SESSION['guesses']
            : array();

        $this->answer = isset($_SESSION['answer'])
            ? $_SESSION['answer']
            : null;
    }

    /**
     * @return int
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param int $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        $_SESSION['answer'] = $answer;
    }

    /**
     * @return array
     */
    public function getGuesses()
    {
        return $this->guesses;
    }

    /**
     * @param array $guesses
     */
    public function setGuesses($guesses)
    {
        $this->guesses = $guesses;
        asort($this->guesses);
        $_SESSION['guesses'] = $guesses;
    }

    public function addGuess($guess)
    {
        $this->guesses[] = $guess;
        $this->setGuesses($this->guesses);
    }

    /**
     * @return int
     */
    public function getCurrentGuess()
    {
        return $this->currentGuess;
    }

    /**
     * kills the current session and session data
     */
    public function destroyState()
    {
        $_SESSION = array();
        session_destroy();
    }







}