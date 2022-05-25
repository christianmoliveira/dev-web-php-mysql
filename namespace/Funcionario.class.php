<?php

include "namespace\pessoa.class.php";

use Pessoa\Pessoa;

class Funcionario extends Pessoa
{
    private string $matricula;

    public function __construct(string $nome, string $cpf, string $nascimento, string $matricula)
    {
        parent::__construct($nome, $cpf, $nascimento);
        $this->matricula = $matricula;
    }

    public function getMatricula() : string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula) : void
    {
        $this->matricula = $matricula;
    }

    public function getPerfil() : string
    {
        return "<b>Nome:</b> {$this->getNome()}<br> <b>CPF:</b> {$this->getCpf()}<br> <b>Nascimento:</b> {$this->getNascimento()} <br> <b>Matrícula:</b> {$this->getMatricula()}";
    }

}