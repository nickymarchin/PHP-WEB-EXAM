<?php
/**
 * Created by PhpStorm.
 * User: nikim
 * Date: 11-Nov-18
 * Time: 10:28 AM
 */

namespace App\Data;


class EditDTO
{
    /**
     * @var BookDTO
     */
    private $book;

    /**
     * @var GenreDTO[]
     */
    private $genres;

    /**
     * @return BookDTO
     */
    public function getBook(): BookDTO
    {
        return $this->book;
    }

    /**
     * @param BookDTO $book
     */
    public function setBook(BookDTO $book): void
    {
        $this->book = $book;
    }

    /**
     * @return GenreDTO[]
     */
    public function getGenres() //: array
    {
        return $this->genres;
    }

    /**
     * @param GenreDTO[] $genres
     */
    public function setGenres($genres): void
    {
        $this->genres = $genres;
    }

}