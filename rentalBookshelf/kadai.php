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
