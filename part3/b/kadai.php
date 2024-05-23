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

class ThinBookshelf extends Bookshelf
{
    public function canAddBook($book)
    {
        return $book->getPageSize() < 20;
    }
}



$bookshelf = new ThinBookshelf;
$title = "坊ちゃん";
$result = $bookshelf->addBook(new Book($title, 20));
// 20以上のページ数なので保存されない
if ($result) {
    echo "保存されました" . "\n";
} else {
    echo "保存が拒否されました" . "\n";
}
if ($bookshelf->findBookByTitle($title)) {
    echo $title . "はあります" . "\n";
} else {
    echo $title . "はないです" . "\n";
}

$title = "こころ";
$result = $bookshelf->addBook(new Book($title, 2));
// 20未満のページ数なので保存される
if ($result) {
    echo "保存されました" . "\n";
} else {
    echo "保存が拒否されました" . "\n";
}
if ($bookshelf->findBookByTitle($title)) {
    echo $title . "はあります" . "\n";
} else {
    echo $title . "はないです" . "\n";
}
