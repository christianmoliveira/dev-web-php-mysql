<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="bloco-principal">
        <h1>Tarefa: <?= htmlentities($tarefa->getNome()); ?></h1>
        <p>
            <a href="index.php?rota=tarefas">
                Voltar para a lista de tarefas
            </a>
        </p>

        <p>
            <strong>Concluída:</strong>
            <?= traduzConcluida($tarefa->getConcluida()); ?>
        </p>
        <p>
            <strong>Descrição:</strong>
            <?= nl2br(htmlentities($tarefa->getDescricao())); ?>
        </p>
        <p>
            <strong>Prazo:</strong>
            <?= traduzDataParaExibir($tarefa->getPrazo()); ?>
        </p>
        <p>
            <strong>Prioridade:</strong>
            <?= traduzPrioridade($tarefa->getPrioridade()); ?>
        </p>

        <h2>Anexos</h2>

        <?php if (count($tarefa->getAnexos()) > 0) : ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>

                <?php foreach($tarefa->getAnexos() as $anexo) : ?>
                    <tr>
                        <td><?= htmlentities($anexo->getNome()) ?></td>
                        <td>
                            <a href="anexos/<?= $anexo->getArquivo(); ?>" download>Download</a>
                            <a href="index.php?rota=removerAnexo&id=<?= $anexo->getId(); ?>">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Não há anexos para esta tarefa.</p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo Anexo</legend>

                <input type="hidden" name="tarefaId" value="<?= $tarefa->getId() ?>">

                <label>
                    <?php if ($temErros && array_key_exists('anexo', $errosValidacao)) : ?>
                        <span class="erro">
                            <?= $errosValidacao['anexo'] ?>
                        </span>
                    <?php endif; ?>
                    <input type="file" name="anexo">
                </label>

                <input type="submit" value="Cadastrar">
            </fieldset>
        </form>
    </div>
</body>
</html>