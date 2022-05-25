<?php

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch(PDOException $e) {
    echo "Falha na conexão com o banco de dados: {$e->getMessage()}";
    die();
}
