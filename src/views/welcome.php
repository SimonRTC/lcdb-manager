
        <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
            <div class="col-md-8 px-0">
               <?= $data['GetChangelogs'] ?>
            </div>
        </div>
        <main role="main" class="container">
            <div class="row">
                <div class="col-md-8 blog-main">
                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        The better manager of the world... But wait? No!
                    </h3>

                    <div class="blog-post">
                        <h2 class="blog-post-title">GitHub - <code>Issues</code></h2>
                        <p class="blog-post-meta">le 25 Août 2019 à 21h09 par <a href="https://github.com/SimonRTC/">Simon_</a></p>
                        <p>Si vous rencontrez des difficultés, n'hésitez pas à me contacter ou directement à ouvir un ticket sur GitHub. Plus d'information sur les <a href="https://help.github.com/en/articles/about-issues">Issues</a> de GitHub.</p>
                    </div>

                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary" href="https://github.com/SimonRTC/lcdb-manager/issues/new">Créer une Issues</a>
                        <a class="btn btn-outline-secondary" href="mailto:simon.malpel@orange.fr">Prendre contact par mail</a>
                    </nav>

                    <hr class="mt-4 mb-4" />
                    <div class="blog-post">
                        <h2 class="blog-post-title">Licence d'exploitation</h2>
                        <p class="blog-post-meta">le 25 Août 2019 à 21h09 par <a href="https://github.com/SimonRTC/">Simon_</a></p>
                        <p class="mt-3">
                            <?= nl2br($data['licence']) ?>
                        </p>
                    </div>
                </div>
                <aside class="col-md-4 blog-sidebar">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="font-italic">Lycee bretagne Ogep</h4>
                        <p class="mb-0">15 Rue du Landreau, 44300 Nantes</p>
                    </div>
                    <div class="p-4">
                        <h4 class="font-italic">Leeeeeeeeeeeeeroy Jenkins</h4>
                        <ol class="list-unstyled">
                        <li><a href="https://github.com/SimonRTC/">> GitHub</a></li>
                        <li><a href="https://git.virtual-roleplay.fr/simon">> Gitea</a></li>
                        <li><a href="https://twitter.com/simonmalpel">> Twitter</a></li>
                        </ol>
                    </div>
                </aside>
            </div>
        </main>
        <hr class="mt-5 mb-5" />