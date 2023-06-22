<?php

/** @var \League\Plates\Template\Template $this */
/** @var list<array{title: string, description: string, tabs: list<array{name: string, path: string}>}> $features */

use function Stringy\create;

$this->layout('layouts::main');

/**
 * @param list<array{name: string, path: string}> $tabs
 * @return string
 */
$tabs = function(string $featureSlug, bool $isAltRow, array $tabs) : string {
    $items = '';
    $tabsContent = '';
    foreach ($tabs as $index => $tab) {
        if ($index === 0) {
            $items .= '<li class="is-active"><a data-group="' . $featureSlug . '" data-target="' . $featureSlug . $index . '" class="tab-button" href="#">' . $tab['name'] . '</a></li>';
        } else {
            $items .= '<li><a data-group="' . $featureSlug . '" data-target="' . $featureSlug . $index . '" class="tab-button" href="#">' . $tab['name'] . '</a></li>';
        }

        if ($index !== 0) {
            $tabClass = 'is-hidden';
        } else {
            $tabClass = '';
        }
        $tabsContent .= <<<HTML
<div id="$featureSlug$index" data-group="$featureSlug" class="tab-content $tabClass">
    <figure class="image">
        <img src="{$tab['path']}" />
    </figure>
</div>
HTML;
    }

    return <<<HTML
<div class="tabs is-small is-centered is-toggle is-toggle-rounded">
    <ul>
        $items
    </ul>
</div>

<div class="tabs-content">
    $tabsContent
</div>
HTML;
};

?>

<section class="hero is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container has-text-centered">
            <p class="title">Thanks for trying out Labrador!</p>
            <p class="subtitle">Async HTTP and CLI framework powered by <a href="https://amphp.org">Amphp</a> and <a href="https://github.com/cspray/annotated-container">Annotated Container</a>.</p>
            <div class="content has-text-left">
                <p>
                    This project skeleton serves as a starting point for apps built with Labrador! Your next steps could include&hellip;
                </p>
                <ul style="list-style-type:square">
                    <li>Review out-of-the-box <a href="#features-marker">features listed below</a></li>
                    <li>Update this page by changing <code>/resources/templates/pages/home.php</code></li>
                    <li>Add new controllers. Be sure to reload the server by running <code>just reload</code> in your terminal</li>
                    <li>Review other available commands by running <code>just</code> in your terminal</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="hero-foot">
        <div class="has-text-centered">
            <a href="#features-marker" class="has-text-black">
                <ion-icon size="large" name="chevron-down-sharp"></ion-icon>
            </a>
        </div>
    </div>
</section>

<span id="features-marker"></span>
<?php
foreach ($features as $index => $feature):
    $isAltRow = $index % 2 === 0;
    $heroClass = $isAltRow ? 'has-background-white-ter' : '';
?>
    <section class="feature-hero <?= $heroClass ?> py-6">
        <div class="container">
            <h2 class="title"><?= $this->e($feature['title']) ?></h2>
            <div class="columns">
                <div class="column is-half">
                    <?php if ($isAltRow): ?>
                        <p><?= $feature['description'] ?></p>
                    <?php else: ?>
                        <?= $tabs(create($feature['title'])->slugify(), $isAltRow, $feature['tabs']) ?>
                    <?php endif ?>
                </div>
                <div class="column is-half">
                    <?php if ($isAltRow): ?>
                        <?= $tabs(create($feature['title'])->slugify(), $isAltRow, $feature['tabs']) ?>
                    <?php else: ?>
                        <p><?= $feature['description'] ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php endforeach ?>

<?php $this->push('scripts') ?>
<script type="application/javascript" src="/assets/js/example-tabs.js"></script>
<?php $this->stop() ?>
