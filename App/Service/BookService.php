<?php

namespace App\Service;


use App\Data\BookDTO;
use App\Repository\BookRepositoryInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->bookRepository->findAll();
    }

    /**
     * @param int $id
     * @return BookDTO
     * @throws \Exception
     */
    public function getOne(int $id): BookDTO
    {
        $task = $this->bookRepository->findOne($id);

        if ($task === null) {
            throw new \Exception("Task not exist!");
        }

        return $task;
    }

    public function add(BookDTO $bookDTO): bool
    {
        return $this->bookRepository->insert($bookDTO);
    }

    /**
     * @param BookDTO $taskDTO
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function edit(BookDTO $bookDTO, int $id): bool
    {
        $task = $this->bookRepository->findOne($id);

        if ($task === null) {
            throw new \Exception("Task not exist!");
        }

        return $this->bookRepository->update($bookDTO, $id);
    }

    /**
     * @return \Generator|BookDTO[]
     */
    public function all(): \Generator
    {
        return $this->bookRepository->findAll();
    }

    public function myAll($id): \Generator
    {
        return $this->bookRepository->findMyAll($id);
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $task = $this->bookRepository->findOne($id);

        if ($task === null) {
            throw new \Exception("Task not exist!");
        }

        return $this->bookRepository->remove($id);
    }
}