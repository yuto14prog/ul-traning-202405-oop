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

$counter1 = new Counter;
$counter2 = new Counter;

echo "counter1は" . $counter1->getValue(); // 0
echo "counter2は" . $counter2->getValue(); // 0
echo "\n";

$counter1->up();

echo "counter1は" . $counter1->getValue(); // 1
echo "counter2は" . $counter2->getValue(); // 0
echo "\n";

$counter1->up();
$counter2->up();

echo "counter1は" . $counter1->getValue(); // 2
echo "counter2は" . $counter2->getValue(); // 1
echo "\n";

$counter1->down();

echo "counter1は" . $counter1->getValue(); // 1
echo "counter2は" . $counter2->getValue(); // 1
echo "\n";

$counter2->resetValue();

echo "counter1は" . $counter1->getValue(); // 1
echo "counter2は" . $counter2->getValue(); // 0
echo "\n";
