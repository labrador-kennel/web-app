<?php declare(strict_types=1);

/** @var \League\Plates\Template\Template $this */

$this->layout('layouts::base');

?>
<header>
    <?= $this->insert('components::navbar') ?>
</header>
<main>
    <?= $this->section('content') ?>
</main>
<footer class="footer">
    <div class="container has-text-centered">
        Copyright 2023 Charles Sprayberry
    </div>
</footer>
