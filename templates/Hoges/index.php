<?php

/**
 * @var \App\View\AppView $this
 */
$this->Vite->script('Hoges/index', ['block' => true]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>

<body>
    <div id="app"></div>

    <?= $this->element('hoge') ?>

    <div class="p-4 bg-green-100"></div>
    <div class="p-4 bg-green-200"></div>
    <div class="p-4 bg-green-300"></div>
    <div class="p-4 bg-green-400"></div>
    <div class="p-4 bg-green-500"></div>
    <div class="p-4 bg-green-600"></div>
    <div class="p-4 bg-green-700"></div>
    <div class="p-4 bg-green-800"></div>
    <div class="p-4 bg-green-900"></div>



    <?= $this->fetch('script') ?>
</body>

</html>
