<?php
class Book
{
    private $title;
    private $page_size;
    public function __construct($title, $page_size)
    {
        $this->title = $title;
        $this->page_size = $page_size;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function getPageSize()
    {
        return $this->page_size;
    }
    public function setPageSize($value)
    {
        $this->page_size = $value;
    }
}

class Bookshelf
{
    protected $books = [];
    public function addBook($book)
    {
        if (!$this->canAddBook($book)) return false;
        array_push($this->books, $book);
        return true;
    }
    public function canAddBook($book)
    {
        return true;
    }
    public function findBookByTitle($title)
    {
        foreach ($this->books as $book) {
            if ($book->getTitle() === $title) return $book;
        }
        return null;
    }
}

class ThinBookshelf extends LimitedBookshelf
{
    public function canAddBook($book)
    {
        if ($book->getPageSize() >= 20) {
            $this->rejected();
            return false;
        }
        return true;
    }
}

class LimitedBookshelf extends Bookshelf
{
    private $limitedTimes;
    public function __construct()
    {
        $this->limitedTimes = 0;
    }
    public function rejected()
    {
        $this->limitedTimes += 1;
    }
    public function getLimitedTimes()
    {
        return $this->limitedTimes;
    }
}



// 検証用関数
function check($result, $bookshelf)
{
    if ($result) {
        echo "保存されました" . "\n";
    } else {
        echo "保存が拒否されました" . "\n";
    }
    if ($bookshelf->findBookByTitle("坊ちゃん")) {
        echo "'坊ちゃん'はあります" . "\n";
    } else {
        echo "'坊ちゃん'はないです" . "\n";
    }
}

// 動作検証
$bookshelf = new ThinBookshelf;
// 拒否１回目
$result = $bookshelf->addBook(new Book("坊ちゃん", 20));
check($result, $bookshelf);
// 拒否２回目
$result = $bookshelf->addBook(new Book("坊ちゃん", 200));
check($result, $bookshelf);
// 成功
$result = $bookshelf->addBook(new Book("坊ちゃん", 2));
check($result, $bookshelf);
// 拒否回数”２”
echo "拒否回数は" . $bookshelf->getLimitedTimes() . "\n";

$bookshelf2 = new ThinBookshelf;
// 拒否１回目
$result = $bookshelf2->addBook(new Book("坊ちゃん", 20));
check($result, $bookshelf2);
// 成功
$result = $bookshelf2->addBook(new Book("坊ちゃん", 2));
check($result, $bookshelf2);
// 拒否回数”１”
echo "拒否回数は" . $bookshelf2->getLimitedTimes() . "\n";
