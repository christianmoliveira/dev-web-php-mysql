<table>
    <tr>
        <th>Tarefas</th>
        <th>Descricao</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluida</th>
        <th>Opções</th>
    </tr>

    <?php foreach($listaTarefas as $tarefa) : ?>
        <tr>
            <td>
                <a href="index.php?rota=tarefa&id=<?= $tarefa->getId(); ?>">
                    <?= htmlentities($tarefa->getNome()); ?>
                </a>
            </td>
            <td><?= htmlentities($tarefa->getDescricao()); ?></td>
            <td><?= traduzDataParaExibir($tarefa->getPrazo()) ?></td>
            <td><?= traduzPrioridade($tarefa->getPrioridade()) ?></td>
            <td><?= traduzConcluida($tarefa->getConcluida()) ?></td>
            <td>
                <a href="index.php?rota=editar&id=<?= $tarefa->getId() ?>">Editar</a>
                <a href="index.php?rota=remover&id=<?= $tarefa->getId() ?>">Remover</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
