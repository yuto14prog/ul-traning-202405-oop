<?php
class PointCalculator
{
    private $results = [
        ['name' => '鈴木', 'point' => 80],
        ['name' => '田中', 'point' => 92],
        ['name' => '佐藤', 'point' => 75]
    ];

    public function sum()
    {
        $sum = 0;
        foreach ($this->results as $result) {
            $sum += $result['point'];
        }
        return $sum;
    }

    public function average()
    {
        return $this->sum() / count($this->results);
    }

    public function findMax()
    {
        $max = null;
        foreach ($this->results as $result) {
            if ($max === null || $max['point'] < $result['point']) {
                $max = $result;
            }
        }
        return $max['name'];
    }

    public function setData($data)
    {
        array_push($this->results, $data);
    }
}

$pointCalculator = new PointCalculator;
echo "----全員のポイント合計 \n";
echo $pointCalculator->sum() . "\n"; // 247

echo "----全員のポイント平均 \n";
echo $pointCalculator->average() . "\n"; // 82.33...

echo "----最高得点の人の'name' \n";
echo $pointCalculator->findMax() . "\n"; // 田中

echo "----[ name => '阿部', point => 95 ]を追加 \n";
$pointCalculator->setData(['name' => '阿部', 'point' => 95]);
echo "----全員のポイント合計 \n";
echo $pointCalculator->sum() . "\n"; // 342

echo "----全員のポイント平均 \n";
echo $pointCalculator->average() . "\n"; // 85.5

echo "----最高得点の人の'name' \n";
echo $pointCalculator->findMax() . "\n"; // 阿部
