<?php

class GuessingGameModel {

    /**
     * @var int
     */
    private $answer;

    /**
     * @var array
     * possible answer choices
     */
    private $answerChoices;

    /**
     * @var array
     * if no answer specified, then use defaultAnswers
     */
    private $defaultAnswers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    /**
     * @var string
     * stores a hint for the user, whether the guess was high or low
     */
    private $hint;

    function __construct($answerChoices = null)
    {
        $this->answerChoices = isset($answerChoices)
            ? $answerChoices
            : $this->defaultAnswers;
    }

    /**
     * generates initial answer
     */
    public function generateAnswer()
    {
        $answerKey = array_rand($this->answerChoices);
        return $this->answer = $this->answerChoices[$answerKey];
    }

    /**
     * @return int
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return array
     */
    public function getAnswerChoices()
    {
        return $this->answerChoices;
    }

    /**
     * @return string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     */
    public function setHint($hint)
    {
        $this->hint = $hint;
    }








}