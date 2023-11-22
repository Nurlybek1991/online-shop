<?php

$name = $_POST['name'];
if(strlen($name) < 2)
{
    echo 'Имя должно быть больше 2 символов' . "<br>";;
}
$email = $_POST['email'];
if(strlen($email) < 4)
{
    echo 'Почта должна быть больше 4 символов' . "<br>";;

}
if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false)
{
    //все ОК, email правильный
}
else
{
    echo 'Некорректная почта'. "<br>";
}

$password = $_POST['psw'];
$passwordRep = $_POST['psw-repeat'];
if($password !== $passwordRep) {
    echo 'Пароли не совпадают'. "<br>";
}

$pdo = new PDO("pgsql:host=db;dbname=postgres","dbuser","dbpwd");

$stmt = $pdo->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
$stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

//$stmt = $pdo->prepare("SELECT * FROM users");
//$stmt->execute();
//$data = $stmt->fetch();
//
//print_r($data);