<?php /** @var \League\Plates\Template\Template $this */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Labrador Getting Started</title>
        <link rel="icon" href="/assets/img/labrador-kennel-logo.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <?= $this->section('content') ?>
        <script type="application/javascript" src="/assets/js/menu.js"></script>
        <?= $this->section('scripts') ?>
    </body>
</html>
