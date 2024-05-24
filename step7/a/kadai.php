<?php
class Counter
{
    private $value;

    public function __construct()
    {
        $this->value = 0;
    }

    public function addValue()
    {
        $this->value++;
    }

    public function getValue()
    {
        return $this->value;
    }
}

$counter = new Counter; // 数値をカウントアップするクラス
$counter->addValue(); //ここでcounterの値を一つ増やしたい
echo $counter->getValue() . "\n";
$counter->addValue(); //ここでcounterの値を一つ増やしたい
echo $counter->getValue() . "\n";
