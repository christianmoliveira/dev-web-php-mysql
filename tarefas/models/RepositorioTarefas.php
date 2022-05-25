<?php

class RepositorioTarefas
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvar(Tarefa $tarefa)
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sqlGravar = "
            INSERT INTO tarefas
            (nome, descricao, prioridade, prazo, concluida)
            VALUES
            (:nome, :descricao, :prioridade, :prazo, :concluida)
        ";

        $query = $this->pdo->prepare($sqlGravar);

        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(),
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
        ]);
    }

    public function atualizar(Tarefa $tarefa)
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sqlEditar = "
            UPDATE tarefas SET
                nome = :nome,
                descricao = :descricao,
                prioridade = :prioridade,
                prazo = :prazo,
                concluida = :concluida,
            WHERE id = :id
        ";

        $query = $this->pdo->prepare($sqlEditar);

        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(),
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
            'id' => $tarefa->getId(),
        ]);
    }

    public function buscar($tarefaId = 0)
    {
        if ($tarefaId > 0) {
            return $this->buscarTarefa($tarefaId);
        }

        return $this->buscarTarefas();
    }

    private function buscarTarefas()
    {
        $sqlBusca = 'SELECT * FROM tarefas';
        $resultado = $this->pdo->query($sqlBusca, PDO::FETCH_CLASS, 'Tarefa');

        $tarefas = [];

        foreach ($resultado as $tarefa) {
            $tarefa->setAnexos($this->buscarAnexos($tarefa->getId()));
            $tarefas[] = $tarefa;
        }

        return $tarefas;
    }

    private function buscarTarefa($tarefaId)
    {
        $sqlBusca = "SELECT * FROM tarefas WHERE id = :id";
        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
            'id' => $tarefaId,
        ]);

        $tarefa = $query->fetchObject('Tarefa');
        $tarefa->setAnexos($this->buscarAnexos($tarefa->getId()));

        return $tarefa;
    }

    public function remover($tarefaId)
    {
        $sqlRemover = "DELETE FROM tarefas WHERE id = :id";

        $query = $this->pdo->prepare($sqlRemover);
        $query->execute([
            'id' => $tarefaId,
        ]);
    }

    public function buscarAnexos($tarefaId)
    {
        $sqlBusca = 'SELECT * FROM anexos WHERE tarefaId = :tarefaId';
        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
           "tarefaId" => $tarefaId,
        ]);

        $anexos = [];

        while ($anexo = $query->fetchObject('Anexo')) {
            $anexos[] = $anexo;
        }

        return $anexos;
    }

    function buscarAnexo($anexoId)
    {
        $sqlBusca = 'SELECT * FROM anexos WHERE id = :id';

        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
            'id' => $anexoId,
        ]);

        return $query->fetchObject('Anexo');
    }

    function salvarAnexo(Anexo $anexo)
    {
        $sqlGravar = "
            INSERT INTO anexos
            (tarefaId, nome, arquivo)
            VALUES
            (:tarefaId, :nome, :arquivo)
        ";
        $query = $this->pdo->prepare($sqlGravar);
        $query->execute([
            'tarefaId' => $anexo->getTarefaId(),
            'nome' => strip_tags($anexo->getNome()),
            'arquivo' => strip_tags($anexo->getArquivo()),
        ]);
    }

    public function removerAnexo($anexoId)
    {
        $sqlRemover = 'DELETE FROM anexos WHERE id = :id';
        $query = $this->pdo->prepare($sqlRemover);
        $query->execute([
            'id' => $anexoId,
        ]);
    }
}