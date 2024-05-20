<?php
class Counter
{
    private $count;
    public function __construct()
    {
        $this->count = 0;
    }

    public function up()
    {
        return $this->count += 1;
    }

    public function getValue()
    {
        return $this->count;
    }

    public function down()
    {
        return $this->count -= 1;
    }
    public function resetValue()
    {
        return $this->count = 0;
    }
}

$counter = new Counter;
$counter->up();

echo $counter->getValue(); // => 1と表示される
echo "\n";

$counter->up();

echo $counter->getValue(); // => 2と表示される
echo "\n";

echo $counter->down();
echo "\n";

echo $counter->resetValue();
echo "\n";
