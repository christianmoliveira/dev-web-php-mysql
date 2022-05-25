<?php

declare(strict_types=1);

include "namespace/Funcionario.class.php";

$funcionario = new Funcionario("Jose da Silva", "123.456.789-10", "1974-03-16", "369852147");
echo $funcionario->getPerfil();