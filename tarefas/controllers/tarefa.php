<?php

$temErros = false;
$errosValidacao = [];

if (temPost()) {
    // upload dos anexos
    $tarefaId = $_POST['tarefaId'];

    if (!array_key_exists('anexo', $_FILES)) {
        $temErros = true;
        $errosValidacao['anexo'] = 'Você deve selecionar um aquivo para anexar';
    } else {
        $dadosAnexo = $_FILES['anexo'];

        if (tratarAnexo($dadosAnexo)) {
            $anexo = new Anexo();
            $anexo->setTarefaId($tarefaId);
            $anexo->setNome($dadosAnexo['name']);
            $anexo->setArquivo($dadosAnexo['name']);
        } else {
            $temErros = true;
            $errosValidacao['anexo'] = 'Envie anexo nos formatos zip, pdf, png ou jpg';
        }
    }

    if (!$temErros) {
        $repositorioTarefas->salvarAnexo($anexo);
    }
}

$tarefa = $repositorioTarefas->buscar($_GET['id']);

include __DIR__ . "/../views/templateTarefa.php";