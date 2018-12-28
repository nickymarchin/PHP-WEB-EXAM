<?php

namespace App\Http;


use App\Service\BookServiceInterface;
use App\Service\UserServiceInterface;

class HomeHttpHandler extends UserHttpHandlerAbstract
{
    public function index(UserServiceInterface $userService)
    {
        if($userService->isLogged()){
            $this->render("home/index");
        }else{
            $this->render("home/index");
        }
    }

    public function profile(UserServiceInterface $userService){

        if(!isset($_SESSION['id'])){
            $this->redirect("login.php");
        }

        $fullName = $userService->currentUser()->getFullName();

        $this->render("users/profile", $fullName);

    }


}