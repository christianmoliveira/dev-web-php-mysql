<?php

$repositorioTarefas->remover($_GET['id']);

header('Location: index.php?rota=tarefas');
