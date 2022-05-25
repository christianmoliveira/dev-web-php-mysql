<?php

$tarefa = $repositorioTarefas->buscar($_GET['id']);

$exibirTabela = false;

$temErros = false;
$errosValidacao = [];

if (temPost()) {
    if (array_key_exists('nome', $_POST) && strlen($_POST['nome']) > 0) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $temErros = true;
        $errosValidacao['nome'] = 'O nome da tarefa é obrigatório!';
    }

    if (array_key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
        $tarefa->setDescricao($_POST['descricao']);
    } else {
        $tarefa->setDescricao('');
    }

    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0) {
        if (validarData($_POST['prazo'])) {
            $tarefa->setPrazo(traduzDataBrParaObjetos($_POST['prazo']));
        } else {
            $temErros = true;
            $errosValidacao['prazo'] = "O prazo não é uma data válida!";
        }
    }

    $tarefa->setPrioridade($_POST['prioridade']);

    if (array_key_exists('concluida', $_POST)) {
        $tarefa->setConcluida(true);
    } else {
        $tarefa->setConcluida(false);
    }

    if (! $temErros) {
        $repositorioTarefas->atualizar($tarefa);
        header('Location: index.php?rota=tarefas');
        die();
    }
}

require __DIR__ . "/../views/template.php";