<?php

namespace App\Repository;


use App\Data\GenreDTO;
use App\Data\BookDTO;
use App\Data\UserDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * @var DataBinderInterface
     */
    private $dataBinder;

    public function __construct(DatabaseInterface $db, DataBinderInterface $dataBinder)
    {
        $this->db = $db;
        $this->dataBinder = $dataBinder;
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function findAll(): \Generator
    {
       $lazyTaskResult = $this->db->query("
            SELECT 
              books.id AS book_id, 
              title, 
              author, 
              description,
              image,
              users.id AS user_id,
              users.username,
              users.password,
              users.full_name,
              users.born_on,
              genres.id AS genre_id,
              genres.name,
              added_on
            FROM books
            INNER JOIN users users ON books.user_id = users.id
            INNER JOIN genres genres ON books.genre_id = genres.id
        ")->execute()
            ->fetch();

        foreach ($lazyTaskResult as $row){

            /** @var BookDTO $book */
            $book = $this->dataBinder->bind($row, BookDTO::class);
            /** @var UserDTO $user */
            $user = $this->dataBinder->bind($row, UserDTO::class);
            /** @var GenreDTO $genre */
            $genre = $this->dataBinder->bind($row, GenreDTO::class);

            $book->setId($row['book_id']);
            $user->setId($row['user_id']);
            $genre->setId($row['genre_id']);

            $book->setUser($user);
            $book->setGenre($genre);

            yield $book;
        }
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function findMyAll($id): \Generator
    {
        $lazyTaskResult = $this->db->query("
            SELECT 
              books.id AS book_id, 
              title, 
              author, 
              description,
              image,
              users.id AS user_id,
              users.username,
              users.password,
              users.full_name,
              users.born_on,
              genres.id AS genre_id,
              genres.name,
              added_on
            FROM books
            INNER JOIN users users ON books.user_id = users.id
            INNER JOIN genres genres ON books.genre_id = genres.id
            WHERE users.id = ?
        ")->execute([$id])
            ->fetch();

        foreach ($lazyTaskResult as $row){

            /** @var BookDTO $book */
            $book = $this->dataBinder->bind($row, BookDTO::class);
            /** @var UserDTO $user */
            $user = $this->dataBinder->bind($row, UserDTO::class);
            /** @var GenreDTO $genre */
            $genre = $this->dataBinder->bind($row, GenreDTO::class);

            $book->setId($row['book_id']);
            $user->setId($row['user_id']);
            $genre->setId($row['genre_id']);

            $book->setUser($user);
            $book->setGenre($genre);

            yield $book;
        }
    }

    public function findOne(int $id): BookDTO
    {
        $row = $this->db->query("
            SELECT 
              books.id AS book_id, 
              title, 
              author, 
              description,
              image,
              users.id AS user_id,
              users.username,
              users.password,
              users.full_name,
              users.born_on,
              genres.id AS genre_id,
              genres.name,
              added_on
            FROM books
            INNER JOIN users users ON books.user_id = users.id
            INNER JOIN genres genres ON books.genre_id = genres.id
            WHERE books.id = ?
        ")->execute([$id])
            ->fetch()
            ->current();

        /** @var BookDTO $book */
        $book = $this->dataBinder->bind($row, BookDTO::class);
        /** @var UserDTO $user */
        $user = $this->dataBinder->bind($row, UserDTO::class);
        /** @var GenreDTO $genre */
        $genre = $this->dataBinder->bind($row, GenreDTO::class);

        $book->setId($row['book_id']);
        $user->setId($row['user_id']);
        $genre->setId($row['genre_id']);

        $book->setGenre($genre);
        $book->setUser($user);

        return $book;
    }

    public function insert(BookDTO $bookDTO): bool
    {
        $this->db->query("
                INSERT INTO books (title, author, description, image, genre_id, user_id, added_on) 
                VALUES (?,?,?,?,?,?,?)
            ")->execute([
            $bookDTO->getTitle(),
            $bookDTO->getAuthor(),
            $bookDTO->getDescription(),
            $bookDTO->getImage(),
            $bookDTO->getGenre()->getId(),
            $bookDTO->getUser()->getId(),
            $bookDTO->getAddedOn()
        ]);

        return true;
    }

    public function update(BookDTO $bookDTO, int $id): bool
    {
        $this->db->query("
                UPDATE books
                SET 
                  title = ?,
                  author = ?,
                  description = ?,
                  image = ?,
                  genre_id = ?,
                  user_id = ?,
                  added_on = ?
                WHERE id = ?  
            ")->execute([
            $bookDTO->getTitle(),
            $bookDTO->getAuthor(),
            $bookDTO->getDescription(),
            $bookDTO->getImage(),
            $bookDTO->getGenre()->getId(),
            $bookDTO->getUser()->getId(),
            $bookDTO->getAddedOn(),
                $id
        ]);

        return true;
    }

    public function remove(int $id): bool
    {
       $this->db->query("DELETE FROM books WHERE id = ?")->execute([$id]);
       return true;
    }
}