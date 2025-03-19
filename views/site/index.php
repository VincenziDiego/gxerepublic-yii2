<?php
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $newsDataProvider */

// Aggiunta del meta viewport per la responsività
$this->registerMetaTag([
    'name' => 'viewport',
    'content' => 'width=device-width, initial-scale=1'
]);

$this->title = 'GXE Republic';
$this->registerCssFile('@web/css/index.css', [
    'depends' => [\app\assets\AppAsset::class],
    'position' => \yii\web\View::POS_HEAD,
]);

// Limita a 3 notizie
if (isset($newsDataProvider)) {
    $newsDataProvider->pagination->pageSize = 3;
}

// Impostazione della dipendenza per la cache
$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => 'SELECT MAX(updated_at) FROM news',
];
?>

<?php if ($this->beginCache('index-cache', ['duration' => 3600, 'dependency' => $dependency])): ?>
    <div class="site-index modern-index fade-in-page scroll-reveal">
        <!-- Sezione Hero -->
        <header class="hero-section scroll-reveal">
            <div class="hero-content">
                <h1 class="hero-title">Benvenuto in GXE Republic</h1>
                <p class="hero-subtitle">Un clan italiano di Destiny 2 pronto a sfidare ogni limite!</p>
                <a href="https://www.bungie.net/en/ClanV2?groupid=4942779" target="_blank" class="btn hero-btn">
                    Scopri il Clan su Bungie.net &raquo;
                </a>
            </div>
        </header>

        <!-- Contenuto Principale -->
        <main class="body-content container main-content">
            <!-- Sezione Info (Chi siamo, Cosa Facciamo, Unisciti a Noi) -->
            <section class="modern-info row">
                <!-- Chi Siamo -->
                <article class="col-md-4 d-flex">
                    <div class="info-box scroll-reveal">
                        <h2>Chi Siamo</h2>
                        <div class="info-content">
                            <p>
                                GXE Republic è un clan nato dalla passione per Destiny 2, dove ogni Guardiano è parte
                                integrante di una community unita. Con una visione futuristica e un animo da esploratori
                                spaziali, affrontiamo le sfide del cosmo con coraggio.
                            </p>
                        </div>
                        <div class="info-footer">
                            <a class="btn btn-outline-secondary" href="https://www.bungie.net/en/ClanV2?groupid=4942779"
                                target="_blank">
                                Scopri di più &raquo;
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Cosa Facciamo -->
                <article class="col-md-4 d-flex">
                    <div class="info-box scroll-reveal">
                        <h2>Cosa Facciamo</h2>
                        <div class="info-content">
                            <p>
                                Affrontiamo i contenuti endgame di Destiny 2 con raid epici, dungeon avventurosi e sessioni
                                di raid day one. Organizziamo speedrun e offriamo guide e supporto per ogni sfida, come veri
                                Guardiani dello spazio.
                            </p>
                        </div>
                        <div class="info-footer">
                            <a class="btn btn-outline-secondary" href="/news/public">
                                Leggi le News &raquo;
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Unisciti a Noi -->
                <article class="col-md-4 d-flex">
                    <div class="info-box scroll-reveal">
                        <h2>Unisciti a Noi</h2>
                        <div class="info-content">
                            <p>
                                Cerchiamo nuovi Guardiani pronti a condividere avventure cosmiche e a spingersi oltre i
                                limiti.
                                Che tu sia un veterano o un new light, in GXE Republic troverai sempre un gruppo pronto ad
                                accoglierti. Unisciti a noi e scopri un universo di possibilità.
                            </p>
                        </div>
                        <div class="info-footer">
                            <a class="btn btn-outline-secondary" href="https://discord.gg/your-invite" target="_blank">
                                Unisciti al Clan &raquo;
                            </a>
                        </div>
                    </div>
                </article>
            </section>

            <!-- Sezione Ultime Notizie -->
            <section class="latest-news row mt-5 scroll-reveal">
                <div class="col-12">
                    <header class="section-header text-center">
                        <h2>Ultime Notizie</h2>
                    </header>
                    <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $newsDataProvider,
                        'itemView' => '_news_item',
                        'layout' => "<div class='row news-row'>{items}</div>",
                        'itemOptions' => ['class' => 'news-card-container col-md-4 col-sm-6'],
                    ]); ?>
                </div>
            </section>

            <!-- Sezione "I Nostri Guardiani" -->
            <section class="guardians-section row mt-5 scroll-reveal">
                <div class="col-12">
                    <header class="section-header text-center">
                        <h2>I Nostri Guardiani</h2>
                    </header>
                    <div class="guardians-container d-flex flex-wrap justify-content-center gap-4">
                        <!-- Esempio di guardian card -->
                        <div class="guardian-card text-center">
                            <img src="<?= Yii::getAlias('@web') ?>/uploads/guardian1.jpg" alt="Guardian 1"
                                class="guardian-img">
                            <h3>Kirito</h3>
                            <p>Capoclan</p>
                        </div>
                        <div class="guardian-card text-center">
                            <img src="<?= Yii::getAlias('@web') ?>/uploads/guardian2.jpg" alt="Guardian 2"
                                class="guardian-img">
                            <h3>Biagio</h3>
                            <p>Reclutatore e amministratore</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sezione Call to Action per la Community -->
            <section class="cta-section row mt-5 scroll-reveal">
                <div class="col-12">
                    <div class="cta-content text-center p-4">
                        <h2>Unisciti alla nostra community</h2>
                        <p>Diventa parte dei nostri Guardiani e vivi l'esperienza Destiny 2 al massimo!</p>
                        <a href="https://discord.gg/your-invite" target="_blank" class="btn cta-btn">
                            Entra in Discord &raquo;
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php $this->endCache(); ?>
<?php endif; ?>

<?php
// Registra sempre il file JS al di fuori del blocco cache
$this->registerJsFile('@web/js/scroll-reveal.js', ['depends' => [\app\assets\AppAsset::class]]);
?>