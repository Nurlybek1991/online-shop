<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];
if ($requestMethod === 'POST') {
    function validate(array $data) {
        $errors = [];

        if (isset($data['login'])) {
            $login = $data['login'];
            if (empty($login)) {
                $errors['login'] = 'Логин должен содержать более 4 символов';
            }
        }  else {
            $errors['login'] = 'Введите логин';
        }

        if (isset($data['password'])) {
            $password = $data['password'];
            if(empty($password)) {
                $errors['password'] = 'Поле пустое';
            }
        } else {
            $errors['password'] = 'Введите пароль';
        }

        return $errors;
    }

    $errors = validate($_POST);

    if(empty($errors)) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $pdo = new PDO("pgsql:host=db;dbname=postgres", "dbuser", "dbpwd");

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email' => $login]);

        $data = $stmt->fetch();
        if (empty($data)) {
            $errors['login'] = 'Неправильный логин или пароль';
        } else {
            if ($password === $data['password']) {
                session_start();
                $_SESSION['user_id'] = $data['id'];
                header('location: /main');
            } else {
                $errors['login'] = 'Неправильный логин или пароль';
            }
        }
    }
}

require_once './html/login.phtml';



