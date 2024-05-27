<?php

class Item
{
    private $name;
    private $price;
    public function __construct(string $name, int $price)
    {
        if ($name === '') throw new Exception('nameが空です');
        if ($price <= 0) throw new Exception('priceは正の値にする必要があります');

        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

class VendingMachine
{
    private $items;
    public function __construct()
    {
        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function isExists(string $name): null | int
    {
        foreach ($this->items as $index => $arrayItem) {
            if ($name === $arrayItem['item']->getName()) return $index;
        }
        return null;
    }

    public function addItem(Item $item, int $quantity)
    {
        if ($quantity < 0) throw new Exception('quantityは0以上の値にする必要があります');

        $itemIndex = $this->isExists($item->getName());
        if ($itemIndex === null) {
            array_push($this->items, ['item' => $item, 'quantity' => $quantity]);
        } else {
            $this->items[$itemIndex]['quantity'] += $quantity;
        }
    }

    public function buy(string $name, int $cash)
    {
        $index = $this->isExists($name);
        if ($index === null) throw new Exception($name . 'は存在しません');

        if ($this->items[$index]['quantity'] === 0) {
            throw new Exception($name . 'の在庫がありません');
        } else if ($cash < $this->items[$index]['quantity']) {
            throw new Exception('cashが足りません');
        } else {
            $this->items[$index]['quantity']--;
            return $this->items[$index]['item'];
        }
    }

    public function canBuy(string $name): bool
    {
        $index = $this->isExists($name);

        return $this->items[$index]['quantity'] !== 0;
    }
}



// 動作チェック
echo "-----初期値のセット \n";
$vendingMachine = new VendingMachine;
$vendingMachine->addItem(new Item('コーラ', 100), 0);
$vendingMachine->addItem(new Item('オレンジ', 100), 1);
$vendingMachine->addItem(new Item('ソーダ', 100), 1);
var_dump($vendingMachine->getItems()); // 上３種類が出る

// (↓↓例外処理が走る)
// $vendingMachine->addItem(new Item('', 100), 1); // nameが空です
// $vendingMachine->addItem(new Item('エラー', 0), 1); // priceは正の値にする必要があります
// $vendingMachine->addItem(new Item('エラー', 100), -1); // quantityは0以上の値にする必要があります


echo "-----補充 \n";
$vendingMachine->addItem(new Item('ソーダ', 100), 100);
var_dump($vendingMachine->getItems()); // ソーダが101に増える


echo "-----購入 \n";
var_dump($vendingMachine->buy('オレンジ', 200)); // オレンジが返ってくる

// (↓↓例外処理が走る)
var_dump($vendingMachine->buy('ファンタ', 200)); // ファンタは存在しません


echo "-----在庫確認 \n";
var_dump($vendingMachine->canBuy('コーラ')); // false
var_dump($vendingMachine->canBuy('オレンジ')); // false
var_dump($vendingMachine->canBuy('ソーダ')); // true


echo "-----異常系の確認 \n";
// $vendingMachine->buy('ソーダ', 10); // cashが足りません
// $vendingMachine->buy('コーラ', 200); // コーラの在庫がありません
