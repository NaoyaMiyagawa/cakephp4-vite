<?php

/**
 * @var \App\View\AppView $this
 */

$this->disableAutoLayout();
// $this->Vite->script('Hoges/hoge', ['block' => true]);
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
    <div class="p-4 bg-green-100">hoge</div>
    <div class="p-4 bg-green-200">hoge</div>
    <div class="p-4 bg-green-300">hoge</div>
    <div class="p-4 bg-green-400">hoge</div>
    <div class="p-4 bg-green-500">hoge</div>
    <div class="p-4 bg-green-600">hoge</div>
    <div class="p-4 bg-green-700">hoge</div>
    <div class="p-4 bg-green-800">hoge</div>
    <div class="p-4 bg-green-900">hoge</div>

    <div class="p-4 bg-blue-100">hoge</div>
    <div class="p-4 bg-blue-200">hoge</div>
    <div class="p-4 bg-blue-300">hoge</div>
    <div class="p-4 bg-blue-400">hoge</div>
    <div class="p-4 bg-blue-500">hoge</div>
    <div class="p-4 bg-blue-600">hoge</div>
    <div class="p-4 bg-blue-700">hoge</div>
    <div class="p-4 bg-blue-800">hoge</div>
    <div class="p-4 bg-blue-900">hoge</div>

    <div class="p-4 bg-orange-100">hoge</div>
    <div class="p-4 bg-orange-200">hoge</div>
    <div class="p-4 bg-orange-300">hoge</div>
    <div class="p-4 bg-orange-400">hoge</div>
    <div class="p-4 bg-orange-500">hoge</div>
    <div class="p-4 bg-orange-600">hoge</div>
    <div class="p-4 bg-orange-700">hoge</div>
    <div class="p-4 bg-orange-800">hoge</div>
    <div class="p-4 bg-orange-900">hoge</div>

    <?= $this->fetch('script') ?>
    <?= $this->Html->script('http://localhost:3000/@vite/client', ['type' => 'module']) ?>
    <?= $this->Vite->script('Hoges/hoge'); ?>
</body>

</html>
