<?php
class EvenCounter
{
    private $number;
    private $counter;
    public function __construct()
    {
        $this->number = 0;
        $this->counter = 0;
    }

    public function up()
    {
        $this->counter += 1;
        if ($this->counter % 2 === 0) {
            return $this->number += 1;
        }
    }

    public function getValue()
    {
        return $this->number;
    }
}


$counter = new EvenCounter;
$counter->up(); // => ここではアップしない
$counter->up(); // => ここでアップ

echo $counter->getValue(); // => 1と表示される
echo "\n";

$counter->up(); // => ここではアップしない
$counter->up(); // => ここでアップ

echo $counter->getValue(); // => 2と表示される
echo "\n";
