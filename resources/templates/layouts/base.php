<?php /** @var \League\Plates\Template\Template $this */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Labrador Getting Started</title>
        <link rel="icon" href="/assets/img/labrador-kennel-logo.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <?= $this->section('content') ?>
        <script type="application/javascript" src="/assets/js/menu.js"></script>
        <?= $this->section('scripts') ?>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
