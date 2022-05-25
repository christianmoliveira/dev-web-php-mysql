<?php

$anexo = $repositorioTarefas->buscarAnexo($_GET['id']);
$repositorioTarefas->removerAnexo($anexo->getId());

unlink(__DIR__ . '/../anexos/' . $anexo->getArquivo());

header('Location: /index.php?rota=tarefa&id=' . $anexo->getTarefaId());