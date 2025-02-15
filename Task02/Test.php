<?php

declare(strict_types=1);

require_once "Fraction.php";

function runTest()
{
    // String representation test
    $m1 = new Fraction(4, 8);
    $correct = "1/2";
    echo "Ожидается: $correct" . PHP_EOL;
    echo "Получено: $m1" . PHP_EOL;
    echo ($m1->__toString() === $correct) ? "Тест пройден" . PHP_EOL : "Тест НЕ ПРОЙДЕН" . PHP_EOL;

    // Adding test
    $m2 = new Fraction(1, 4);
    $m3 = $m1->add($m2);
    $correct = "3/4";
    echo "Ожидается: $correct" . PHP_EOL;
    echo "Получено: " . $m3 . PHP_EOL;
    echo ($m3->__toString() === $correct) ? "Тест пройден" . PHP_EOL : "Тест НЕ ПРОЙДЕН" . PHP_EOL;

    // Subtraction test
    $m4 = new Fraction(-5, 2);
    $m5 = $m4->sub($m2);
    $correct = "-2`3/4";
    echo "Ожидается: $correct" . PHP_EOL;
    echo "Получено: " . $m5 . PHP_EOL;
    echo ($m5->__toString() === $correct) ? "Тест пройден" . PHP_EOL : "Тест НЕ ПРОЙДЕН" . PHP_EOL;
}
