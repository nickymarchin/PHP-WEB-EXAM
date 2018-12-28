<?php

namespace App\Http;


use App\Data\EditDTO;
use App\Data\BookDTO;
use App\Service\GenreService;
use App\Service\GenreServiceInterface;
use App\Service\BookService;
use App\Service\BookServiceInterface;
use App\Service\UserService;
use App\Service\UserServiceInterface;

class BookHttpHandler extends UserHttpHandlerAbstract
{

    /**
     * @param BookServiceInterface $bookService
     * @param UserServiceInterface $userService
     * @param GenreServiceInterface $genreService
     * @param array $formData
     * @throws \Exception
     */
    public function add(BookServiceInterface $bookService,
                        UserServiceInterface $userService,
                        GenreServiceInterface $genreService,
                        array $formData = [])
    {
        /** @var BookDTO $book */
        $book = $this->dataBinder->bind($formData, BookDTO::class);

        /** @var EditDTO $editDTO */
        $editDTO = new EditDTO();
        $editDTO->setBook($book);
        $editDTO->setGenres($genreService->getAll());

        if(isset($formData['save'])){
            $this->handleInsertProcess($bookService, $userService, $genreService, $formData);
        }else{
            $this->render("books/add", $editDTO);
        }
    }

    public function allBooks(BookServiceInterface $bookService)
    {
        $this->render("books/all", $bookService->all());
    }

    public function allMyBooks(BookServiceInterface $bookService, array $sessData = [])
    {
        $this->render("books/my_all", $bookService->myAll($sessData['id']));
    }

    public function edit(BookServiceInterface $bookService,
                         UserServiceInterface $userService,
                         GenreServiceInterface $genreService,
                         array $formData = [], array $getData = [])
    {

        $book = $bookService->getOne(intval($getData['id']));

        $editDTO = new EditDTO();
        $editDTO->setBook($book);
        $editDTO->setGenres($genreService->getAll());

        if(isset($formData['save'])){
            $this->handleEditProcess($bookService, $userService, $genreService, $formData, $getData);
        }else{
            $this->render("books/edit", $editDTO);
        }
    }

    public function delete(BookServiceInterface $bookService, array $getData = []){
        if(!isset($getData['id'])){
            $this->redirect("my_books.php");
        }
        $bookService->delete(intval($getData['id']));
        $this->redirect("my_books.php");
    }

    /**
     * @param $bookService
     * @param $userService
     * @param $genreService
     * @param $formData
     * @throws \Exception
     */
    private function handleInsertProcess($bookService, $userService, $genreService, $formData)
    {

        /** @var BookDTO $book */
        $book = $this->dataBinder->bind($formData, BookDTO::class);

        /** @var UserService $userService */
        $user = $userService->currentUser();
        /** @var GenreService $genreService */
        $genre = $genreService->getOne(intval($formData['genre_id']));

        $book->setGenre($genre);
        $book->setUser($user);

        /** @var BookService $bookService */
        $bookService->add($book);

        $this->redirect("my_books.php");

    }

    private function handleEditProcess($bookService, $userService, $genreService, $formData, $getData)
    {
        try {
            /** @var BookDTO $book */
            $book = $this->dataBinder->bind($formData, BookDTO::class);
            /** @var UserService $userService */
            $user = $userService->currentUser();
            /** @var GenreService $genreService */
            $genre = $genreService->getOne(intval($formData['genre_id']));

            $book->setUser($user);
            $book->setGenre($genre);
            $book->setId($getData['id']);

            /** @var BookService $bookService */
            $bookService->edit($book, intval($getData['id']));

            $this->redirect("my_books.php");
        }catch (\Exception $ex){

        }
    }

}