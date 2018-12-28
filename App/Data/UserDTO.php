<?php

namespace App\Data;


class UserDTO
{
    private $id;
    private $username;
    private $password;
    private $fullName;
    private $bornOn;

    public static function create($username,
                                  $password,
                                  $fullName,
                                  $bornOn,
                                  $id = null)
    {

        return (new UserDTO())
            ->setUsername($username)
            ->setPassword($password)
            ->setFullName($fullName)
            ->setBornOn($bornOn)
            ->setId($id);
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username): UserDTO
    {
        $this->username = $username;
        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password): UserDTO
    {
        $this->password = $password;
        return $this;
    }


    public function getFullName()
    {
        return $this->fullName;
    }


    public function setFullName($fullName): UserDTO
    {
        $this->fullName = $fullName;
        return $this;
    }


    public function getBornOn()
    {
        return $this->bornOn;
    }


    public function setBornOn($bornOn): UserDTO
    {
        $this->bornOn = $bornOn;
        return $this;
    }

}