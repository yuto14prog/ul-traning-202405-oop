<?php
class Counter
{
    private $value;

    public function __construct()
    {
        $this->value = 0;
    }

    public function addValue($number)
    {
        if (gettype($number) == 'integer' || 'double') $this->value += $number;
    }

    public function getValue()
    {
        return $this->value;
    }
}

$counter = new Counter; // 数値をカウントアップするクラス
$counter->addValue(1); //ここでcounterの値を一つ増やしたい
echo $counter->getValue() . "\n";
$counter->addValue(1); //ここでcounterの値を一つ増やしたい
echo $counter->getValue() . "\n";
