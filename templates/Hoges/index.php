<?php

/**
 * @var \App\View\AppView $this
 */


$this->disableAutoLayout();
$this->Vite->script('Hoges/hoge', ['block' => true]);
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

    <!-- <div class="p-4 bg-blue-100"></div>
    <div class="p-4 bg-blue-200"></div>
    <div class="p-4 bg-blue-300"></div>
    <div class="p-4 bg-blue-400"></div>
    <div class="p-4 bg-blue-500"></div>
    <div class="p-4 bg-blue-600"></div>
    <div class="p-4 bg-blue-700"></div>
    <div class="p-4 bg-blue-800"></div>
    <div class="p-4 bg-blue-900"></div> -->

    <!-- <div class="p-4 bg-orange-100"></div>
    <div class="p-4 bg-orange-200"></div>
    <div class="p-4 bg-orange-300"></div>
    <div class="p-4 bg-orange-400"></div>
    <div class="p-4 bg-orange-500"></div>
    <div class="p-4 bg-orange-600"></div>
    <div class="p-4 bg-orange-700"></div>
    <div class="p-4 bg-orange-800"></div>
    <div class="p-4 bg-orange-900"></div> -->

    <?= $this->fetch('script') ?>
</body>

</html>
