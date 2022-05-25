<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dia <?= date('d/m/Y'); ?></title>
</head>
<body>
    <h1>
        Estamos em <?= date('Y'); ?> e hoje é dia
        <?= date('d/m'); ?>
    </h1>
    <p>
        Esta página foi gerada às <?= date('H'); ?> horas e
        <?= date('i') ?> minutos
    </p>
</body>
</html>
