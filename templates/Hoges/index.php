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
    <div class="py-10 bg-blue-500">hoge</div>
    <p class="p-4 text-red-500 bg-yellow-700 ">aaaaaaaaaa</p>

    <?= $this->fetch('script') ?>
</body>

</html>
