<?php

// Incluir as configurações, ajudantes e models
require "config.php";
require "helpers/banco.php";
require "helpers/helpers.php";
require "models/Tarefa.php";
require "models/Anexo.php";
require "models/RepositorioTarefas.php";

// Criar um objeto da classe RepositorioTarefas
$repositorioTarefas = new RepositorioTarefas($pdo);

// Verificar qual arquivo (rota) deve ser usado para tratar a requisição
$rota = "tarefas"; // Rota padrão

if (array_key_exists("rota", $_GET)) {
    $rota = (string) $_GET['rota'];
}

// Incluir o arquivo que vai tratar a requisição
if (is_file("controllers" . DIRECTORY_SEPARATOR . "{$rota}.php")) {
    require "controllers" . DIRECTORY_SEPARATOR . "{$rota}.php";
} else {
    require "controllers/404.php";
}