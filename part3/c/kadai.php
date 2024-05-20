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
            if ($book->getTitle() === $title) {
                echo $title . "はあります" . "\n";
                return $book;
            }
        }
        echo $title . "はないです" . "\n";
        return null;
    }
}

class RejectedBocchanBookshelf extends Bookshelf
{
    public function canAddBook($book)
    {
        if ($book->getTitle() === '坊ちゃん') {
            LimitedBookshelf::rejected();
            return false;
        }
        return true;
    }
}

class ThinBookshelf extends Bookshelf
{
    public function canAddBook($book)
    {
        if ($book->getPageSize() >= 20) {
            LimitedBookshelf::rejected();
            return false;
        }
        return true;
    }
}

class LimitedBookshelf extends Bookshelf
{
    private static $limitedTimes = 0;
    public static function rejected()
    {
        self::$limitedTimes += 1;
    }
    public static function getLimitedTimes()
    {
        echo "拒否回数は" . self::$limitedTimes . "回 \n";
    }
}

$bookshelf = new ThinBookshelf;
$bookshelf->addBook(new Book("坊ちゃん", 20));
$bookshelf->findBookByTitle("坊ちゃん"); // 拒否１回目

$bookshelf = new RejectedBocchanBookshelf;
$bookshelf->addBook(new Book("坊ちゃん", 520));
$bookshelf->findBookByTitle("坊ちゃん"); // 拒否２回目

$bookshelf = new RejectedBocchanBookshelf;
$bookshelf->addBook(new Book("こころ", 520));
$bookshelf->findBookByTitle("こころ"); // 通過

LimitedBookshelf::getLimitedTimes(); // 拒否回数は2回
