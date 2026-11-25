<?php

class Calculator
{

    public function add(int ...$numbers): int
    {
        return array_sum($numbers);
    }

}

$calc = new Calculator();

echo $calc->add(10, 20);
echo "<br>";

echo $calc->add(10, 20, 30);

?>