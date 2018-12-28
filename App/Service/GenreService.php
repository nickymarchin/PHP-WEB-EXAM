<?php

namespace App\Service;


use App\Data\GenreDTO;
use App\Repository\GenreRepositoryInterface;

class GenreService implements GenreServiceInterface
{

    /**
     * @var GenreRepositoryInterface
     *
     */
    private $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Generator|GenreDTO[]
     */
    public function getAll(): \Generator
    {
       return $this->genreRepository->findAll();
    }

    /**
     * @param int $id
     * @return GenreDTO
     * @throws \Exception
     */
    public function getOne(int $id): GenreDTO
    {
        $category = $this->genreRepository->findOne($id);

        if($category === null){
            throw new \Exception("Category not found!");
        }

        return $this->genreRepository->findOne($id);
    }
}