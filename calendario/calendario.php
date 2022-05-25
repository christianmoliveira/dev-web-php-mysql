<?php

function linha($semana)
{
    $linha = '<tr>';
    for ($i = 0; $i <= 6; $i++) {
        if (array_key_exists($i, $semana)) {
            $linha .= "<td>" . checkDay($semana[$i]) . "</td>";
        } else {
            $linha .= "<td></td>";
        }
    }
    $linha .= '</tr>';

    return $linha;
}

function checkDay($day)
{
    if ($day == date('d'))
        return "<strong>{$day}</strong>";

    return $day;
}

function calendario()
{
    $calendario = '';
    $dia = 1;
    $semana = [];

    while($dia <= 31)
    {
        $semana[] = $dia;

        if (count($semana) == 7) {
            $calendario .= linha($semana);
            $semana = [];
        }

        $dia++;
    }
    $calendario .= linha($semana);

    return $calendario;
}

?>

<table border="1">
    <tr>
        <td>Dom</td>
        <td>Seg</td>
        <td>Ter</td>
        <td>Qua</td>
        <td>Qui</td>
        <td>Sex</td>
        <td>Sáb</td>
    </tr>
    <?= calendario(); ?>
</table>

