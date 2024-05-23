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
        return $book;
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

class RentalBookshelf extends Bookshelf
{
    private $rentedBooks;
    public function __construct()
    {
        $this->rentedBooks = [];
    }

    public function rentBook($book)
    {
        // （$booksに本が存在する && 貸出されていない）ときに$rentedBooksに追加
        if ($this->findBookByTitle($book->getTitle()) && !$this->isRented($book)) {
            array_push($this->rentedBooks, $book);
            return $book;
        } else {
            return null;
        }
    }
    public function returnBook($book)
    {
        foreach ($this->rentedBooks as $index => $rentedBook) {
            if ($rentedBook === $book) {
                unset($this->rentedBooks[$index]);
                return $book;
            }
        }
        return false;
    }
    public function listRentedBooks()
    {
        return $this->rentedBooks;
    }
    public function isRented($book)
    {
        return in_array($book, $this->rentedBooks);
    }
}



// 動作検証
$bookshelf = new RentalBookshelf;
$bocchan = $bookshelf->addBook(new Book('坊っちゃん', 200));
$kokoro = $bookshelf->addBook(new Book('こころ', 200));
$mon = $bookshelf->addBook(new Book('門', 200));
$dummy = new Book('ダミー', 200);

echo "-----rentBook()" . "\n";
// 坊っちゃんを借りる（成功）
$result = $bookshelf->rentBook($bocchan);
if ($result) {
    echo $result->getTitle() . "を借りました" . "\n";
} else {
    echo "本は存在しないか貸出されています" . "\n";
}
// 坊っちゃんを借りる（失敗：貸出されている）
$result = $bookshelf->rentBook($bocchan);
if ($result) {
    echo $result->getTitle() . "を借りました" . "\n";
} else {
    echo "本は存在しないか貸出されています" . "\n";
}
// ダミーを借りる（失敗：存在しない）
$result = $bookshelf->rentBook($bocchan);
if ($result) {
    echo $result->getTitle() . "を借りました" . "\n";
} else {
    echo "本は存在しないか貸出されています" . "\n";
}
// こころを借りる（成功）
$result = $bookshelf->rentBook($kokoro);
if ($result) {
    echo $result->getTitle() . "を借りました" . "\n";
} else {
    echo "本は存在しないか貸出されています" . "\n";
}
// 門を借りる（成功）
$result = $bookshelf->rentBook($mon);
if ($result) {
    echo $result->getTitle() . "を借りました" . "\n";
} else {
    echo "本は存在しないか貸出されています" . "\n";
}

echo "-----returnBook()" . "\n";
// 坊っちゃんを返却する（成功）
$result = $bookshelf->returnBook($bocchan);
if ($result) {
    echo $result->getTitle() . "を返却しました" . "\n";
} else {
    echo "本は返却できませんでした" . "\n";
}
// ダミーを返却する（失敗：存在しない）
$result = $bookshelf->returnBook($bocchan);
if ($result) {
    echo $result->getTitle() . "を返却しました" . "\n";
} else {
    echo "本は返却できませんでした" . "\n";
}

echo "-----listRentedBooks()" . "\n";
// こころ、門の２つ
$result = $bookshelf->listRentedBooks();
foreach ($result as $rentedBook) {
    echo $rentedBook->getTitle() . "\n";
}

echo "-----isRented()" . "\n";
// 坊っちゃんは貸出されていません
$result = $bookshelf->isRented($bocchan);
if ($result) {
    echo "坊っちゃんは貸出されています" . "\n";
} else {
    echo "坊っちゃんは貸出されていません" . "\n";
}
// こころは貸出されています
$result = $bookshelf->isRented($kokoro);
if ($result) {
    echo "こころは貸出されています" . "\n";
} else {
    echo "こころは貸出されていません" . "\n";
}
// 門は貸出されています
$result = $bookshelf->isRented($mon);
if ($result) {
    echo "門は貸出されています" . "\n";
} else {
    echo "門は貸出されていません" . "\n";
}
