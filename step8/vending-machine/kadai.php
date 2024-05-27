<?php

class Item
{
    private $name;
    private $price;
    public function __construct($name, $price)
    {
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

    public function addItem(Item $item, int $quantity)
    {
        $itemIndex = $this->isExists($item);
        if ($itemIndex === null) {
            array_push($this->items, ['item' => $item, 'quantity' => $quantity]);
        } else {
            $this->items[$itemIndex]['quantity'] += $quantity;
        }
    }

    public function isExists(Item $item): null | int
    {
        foreach ($this->items as $index => $arrayItem) {
            if ($item->getName() === $arrayItem['item']->getName()) return $index;
        }
        return null;
    }

    public function getItems()
    {
        var_dump($this->items);
    }
}



$vendingMachine = new VendingMachine;
$vendingMachine->addItem(new Item('a', 112), 1);
$vendingMachine->addItem(new Item('b', 112), 1);
$vendingMachine->addItem(new Item('c', 112), 1);
$vendingMachine->addItem(new Item('c', 112), 100);

$vendingMachine->getItems();