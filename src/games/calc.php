<?php

namespace BrainGames\calc;

use function BrainGames\Cli\greeting;
use function BrainGames\Cli\startGame;

const MSG_INSTRUCTIONS = 'What is the result of the expression?';

function run()
{
    $name = greeting(MSG_INSTRUCTIONS);
    startGame($name);
}

function getQuestion()
{
    $randomNumber1 = rand(1, 20);
    $randomNumber2 = rand(1, 20);
    $arrayOfOperations = ['+', '-', '*'];
    $randomOperation = $arrayOfOperations[rand(0, 2)];

    $question = $randomNumber1 . ' ' . $randomOperation . ' ' . $randomNumber2;

    return $question;
}

function getExpected($question)
{
    $expected = function () use ($question) {
        if (strpos($question, '+') !== false) {
            return firstNum($question, '+') + secondNum($question);
        } elseif (strpos($question, '-') !== false) {
            return firstNum($question, '-') - secondNum($question);
        }
        return firstNum($question, '*') * secondNum($question);
    };

    return $expected;
}

function firstNum($question, $operation)
{
    return strstr($question, $operation);
}

function secondNum($question)
{
    return substr($question, (strrpos($question, ' ')));
}
