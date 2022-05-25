<form method="POST">
    <input type="hidden" name="id" value="<?= $tarefa->getId(); ?>">
    <fieldset>
        <legend>Nova tarefa</legend>
        <label>Tarefa:
            <?php if ($temErros && array_key_exists('nome', $errosValidacao)) : ?>
                <span class="erro">
                    <?= $errosValidacao['nome'] ?>
                </span>
            <?php endif; ?>
        </label>
        <input type="text" name="nome" value="<?= htmlentities($tarefa->getNome()); ?>">

        <label>Descrição (Opcional):</label>
        <textarea name="descricao" cols="30" rows="10"><?= htmlentities($tarefa->getDescricao()); ?></textarea>

        <label>Prazo:
            <?php if ($temErros && array_key_exists('prazo', $errosValidacao)) : ?>
                <span class="erro">
                    <?= $errosValidacao['prazo'] ?>
                </span>
            <?php endif; ?>
        </label>
        <input type="text" name="prazo" value="<?= traduzDataParaExibir($tarefa->getPrazo()); ?>">

        <fieldset>
            <legend>Prioridade:</legend>
            <label>
                <input type="radio" name="prioridade" value="1"
                    <?= ($tarefa->getPrioridade() == 1)
                        ? 'checked'
                        : '';
                    ?>
                >Baixa
                <input type="radio" name="prioridade" value="2"
                    <?= ($tarefa->getPrioridade() == 2)
                        ? 'checked'
                        : '';
                    ?>
                >Média
                <input type="radio" name="prioridade" value="3"
                    <?= ($tarefa->getPrioridade() == 3)
                        ? 'checked'
                        : '';
                    ?>
                >Alta
            </label>
        </fieldset>

        <label>Tarefa concluída:</label>
        <input type="checkbox" name="concluida" value="1"
            <?= ($tarefa->getConcluida() == 1)
                ? 'checked'
                : '';
            ?>
        >

        <input type="submit" value="<?= ($tarefa->getId() > 0) ? 'Atualizar' : 'Cadastrar' ?>">
    </fieldset>
</form>