<?php

namespace Pessoa;

abstract class Pessoa
{
    private string $nome;
    private string $cpf;
    private string $nascimento;

    public function __construct(string $nome, string $cpf, string $nascimento)
    {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setNascimento($nascimento);
    }

    public function setNome(string $nome) : void
    {
        $this->nome = $nome;
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function setCpf(string $cpf) : void
    {
        $this->cpf = $cpf;
    }

    public function getCpf() : string
    {
        return $this->cpf;
    }

    public function setNascimento(string $nascimento) : void
    {
        $this->nascimento = $nascimento;
    }

    public function getNascimento() : string
    {
        $dt_nascimento = new \DateTime($this->nascimento);
        return $dt_nascimento->format('d/m/Y');
    }

    public function getPerfil() : string
    {
        return "<b>Nome:</b> {$this->getNome()}<br> <b>CPF:</b> {$this->getCpf()}<br> <b>Nascimento:</b> {$this->getNascimento()}<br>";
    }
}