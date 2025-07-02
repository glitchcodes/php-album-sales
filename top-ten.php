<?php

// MYSQL Credentials
global $host, $database, $user, $password;
include 'config.inc.php';

$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

$pdo = null;

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
};

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albums</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
<div class="container py-3">
    <h2 class="mb-3">
        Top 10 Albums
    </h2>

    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php">Total Album Sales per Artists</a></li>
            <li><a class="dropdown-item" href="combined.php">Combined Album Sales per Artists</a></li>
            <li><a class="dropdown-item" href="top-one.php">Top 1 Artist</a></li>
            <li><a class="dropdown-item" href="top-ten.php">Top 10 Albums</a></li>
            <li><a class="dropdown-item" href="search.php">Search Albums by Artist</a></li>
        </ul>
    </div>

    <table class="table">
        <tr>
            <th>Album</th>
            <th>Total Sales</th>
        </tr>
        <?php
        // Display top 10 artist who sold most combined album sales
        $stmt = $pdo->query(
            "SELECT `Album`, SUM(`2022 Sales`) as `Total Sales` FROM `albums` 
            GROUP BY `Album` 
            ORDER BY `Total Sales` DESC 
            LIMIT 10
        ");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['Album']; ?></td>
                <td><?php echo number_format($row['Total Sales']); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>