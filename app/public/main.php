<?php

session_start();
if (isset($_SESSION['users_id'])) {

    $pdo = new PDO("pgsql:host=db;dbname=postgres", "dbuser", "dbpwd");

    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();

} else {
    header('location: /login.php');
}

?>

<h3>Catalog</h3>
    <div class="container">
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <div class="card-header">
                    Hit!
                    <a href="#">
                        <img class="card-img-top" src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ&s=043d89cbf03cbdbbe8ed9f9e5e44ce6f" alt="Card image">
                        <div class="card-body">
                            <p class="card-text text-muted"><?php echo $product['name']; ?> </p>
                            <a><h5 class="card-title">Very long item name</h5></a>
                            <div class="card-footer">
                                <?php echo $product['price']; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }

</style>