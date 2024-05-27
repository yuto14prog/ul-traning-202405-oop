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
    public function findBookByTitle($title)
    {
        foreach ($this->books as $book) {
            if ($book->getTitle() === $title) return $book;
        }
        return null;
    }
    public function sumPageSize()
    {
        $size = 0;
        foreach ($this->books as $book) {
            $size += $book->getPageSize();
        }
        return $size;
    }
    public function size()
    {
        return count($this->books);
    }
    public function canAddBook($book)
    {
        return true;
    }
}

class LimitedBookshelf extends Bookshelf
{
    private $max_size;

    public function __construct($max_size = 3)
    {
        $this->max_size = $max_size;
    }

    public function canAddBook($book)
    {
        return count($this->books) < $this->max_size;
    }
}

class DebugBookshelf extends LimitedBookshelf
{
    public function addBook($book)
    {
        $returnValue = parent::addBook($book);
        echo "↓↓addBook()↓↓ \n";
        echo "引数：";
        var_dump($book);
        echo "戻り値：";
        var_dump($returnValue);
        echo "-------- \n";
        return $returnValue;
    }
    public function canAddBook($book)
    {
        $returnValue = parent::canAddBook($book);
        echo "↓↓cabAddBook()↓↓ \n";
        echo "引数：";
        var_dump($book);
        echo "戻り値：";
        var_dump($returnValue);
        echo "-------- \n";
        return $returnValue;
    }
}



putenv('DEBUG=true');
if (getenv('DEBUG') == 'true') {
    $bookshelf = new DebugBookshelf;
} else {
    $bookshelf = new LimitedBookshelf;
}

$bookshelf->addBook(new Book("坊ちゃん", 520));
$bookshelf->addBook(new Book("我輩は猫である", 454));
$bookshelf->addBook(new Book("こころ", 876));

if (!$bookshelf->addBook(new Book("門", 345))) {
    echo "新しい本を追加できませんでした。今の本の数: " . $bookshelf->size() . "\n";
}

print_r($bookshelf->findBookByTitle("こころ"));
echo $bookshelf->sumPageSize();
echo "\n";
