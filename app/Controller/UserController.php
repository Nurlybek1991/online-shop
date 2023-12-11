<?php

namespace Controller;

use Request\LoginRequest;
use Request\RegistrateRequest;
use Model\User;
use Request\Request;


class UserController
{
    public function getRegistrate(): void
    {
        require_once '../View/registrate.phtml';
    }

    public function postRegistrate(RegistrateRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $requestData = $request->getBody();
            $name = $requestData['name'];
            $email = $requestData['email'];
            $password = $requestData['psw'];

            User::create($name, $email, $password);

            header('location: /login');;
        }
        require_once '../View/registrate.phtml';
    }

    public function getLogin(): void
    {
        require_once '../View/login.phtml';
    }


    public function postLogin(LoginRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $requestData = $request->getBody();
            $login = $requestData['login'];
            $password = $requestData['password'];

            $data = User::getOneByEmail($login);


            if (empty($data)) {
                $errors['login'] = 'Неправильный логин или пароль';
            } else {
                if ($password === $data->getPassword()) {
                    session_start();
                    $_SESSION['user_id'] = $data->getId();
                    header('location: /main');
                } else {
                    $errors['password'] = 'Неправильный логин или пароль';
                }
            }

        }
        require_once '../View/login.phtml';
    }
}