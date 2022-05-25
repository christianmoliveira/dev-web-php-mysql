<?php

function traduzPrioridade($codigo)
{
    $prioridade = '';

    switch($codigo) {
        case 1:
            $prioridade = 'Baixa';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
    }

    return $prioridade;
}

function traduzDataParaBanco($data)
{
    if ($data == "")
        return "";

    $partes = explode("/", $data);

    if (count($partes) != 3) {
        return $data;
    }

    $dados = explode("/", $data);

    $dataBanco = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

    return $dataBanco;
}

function traduzDataParaExibir($data)
{
    if (is_object($data) && get_class($data) == "DateTime") {
        return $data->format("d/m/Y");
    }

    if ($data == "" || $data == "0000-00-00") {
        return "";
    }

    $dados = explode("-", $data);

    if (count($dados) != 3) {
        return $data;
    }

    $dataExibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $dataExibir;
}

function traduzConcluida($concluida)
{
    if ($concluida == 1) {
        return "Sim";
    }

    return "Não";
}

function temPost()
{
    if (count($_POST) > 0) {
        return true;
    }

    return false;
}

function validarData($data)
{
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado = preg_match($padrao, $data);

    if ($resultado == 0) {
        return false;
    }

    $dados = explode("/", $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];

    $resultado = checkdate($mes, $dia, $ano);

    return ($resultado == 1);
}

function tratarAnexo($anexo)
{
    $padrao = '/^.+(\.pdf|\.zip|\.png|\.jpg)$/';
    $resultado = preg_match($padrao, $anexo['name']);

    if (! $resultado) {
        return false;
    }

    move_uploaded_file(
        $anexo['tmp_name'],
        __DIR__ . "/../anexos/" . $anexo['name']
    );

    return true;
}

function traduzDataBrParaObjetos($data)
{
    if ($data == "") {
        return "";
    }

    $dados = explode("/", $data);

    if (count($dados) != 3) {
        return $data;
    }

    return DateTime::createFromFormat('d/m/Y', $data);
}
