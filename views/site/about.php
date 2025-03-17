<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'About GXE Republic';
$this->registerCssFile('@web/css/about.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);
?>
<div class="site-about">
    <!-- Sezione Hero -->
    <header class="about-hero scroll-reveal">
        <div class="about-hero-content">
            <h1 class="about-title"><?= Html::encode($this->title) ?></h1>
            <p class="about-subtitle">Scopri la nostra storia e la nostra missione</p>
        </div>
    </header>

    <!-- Contenuto Principale -->
    <main class="about-main container">
        <!-- Storia -->
        <section class="about-section about-history scroll-reveal">
            <h2>La Nostra Storia</h2>
            <p>
                GXE Republic nasce dalla passione per Destiny 2. Inizialmente un gruppo di giocatori si è unito per
                condividere strategie, raid e momenti epici. Con il tempo, abbiamo costruito una community forte e
                unita, pronta ad affrontare ogni sfida con determinazione e spirito di squadra.
            </p>
        </section>
        <!-- Missione e Visione -->
        <section class="about-section about-mission scroll-reveal">
            <h2>Missione e Visione</h2>
            <p>
                La nostra missione è creare un ambiente di gioco inclusivo e stimolante, dove ogni Guardiano possa
                crescere e contribuire alla nostra evoluzione. Puntiamo a diventare un punto di riferimento nel panorama
                italiano di Destiny 2, promuovendo la collaborazione e il gioco leale.
            </p>
        </section>
        <!-- Team -->
        <section class="about-section about-team scroll-reveal">
            <h2>Il Team</h2>
            <p>
                Il cuore di GXE Republic è costituito dai suoi membri: fondatori, amministratori e giocatori
                appassionati che guidano e supportano la community.
            </p>
            <ul class="team-list">
                <li><strong>Kirito</strong> - Capoclan</li>
                <li><strong>Biagio</strong> - Reclutatore e Amministratore</li>
                <li><strong>Altri membri</strong> - Scopri di più sul nostro canale Discord</li>
            </ul>
        </section>
        <!-- Contatti -->
        <section class="about-section about-contact scroll-reveal">
            <h2>Contattaci</h2>
            <p>
                Hai domande o vuoi unirti alla nostra community? Visita il nostro canale Discord per entrare in contatto
                con noi e partecipare agli eventi.
            </p>
            <a href="https://discord.gg/your-invite" target="_blank" class="btn about-btn">
                Unisciti al Clan
            </a>
        </section>
    </main>
</div>