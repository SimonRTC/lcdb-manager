    <main role="main">
        <div class="row justify-content-center">
            <div class="col-8 jumbotron">
                <h3 class="mb-2">Connexion à mon compte</h3><hr class="mb-5" />
                <div class="row justify-content-center">
                    <form class="col-10" method="POST">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label for="inputUsername">Adresse email (<small> ou nom d'utilisateur </small>)</label>
                                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Adresse email" required="required" autofocus="autofocus">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label for="inputPassword">Mot de passe</label>
                                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required="required">
                            </div>
                        </div>
                        <?php if (!empty($G['Pusher']->Notification)) { ?>
                            <div class="alert alert-danger mt-4">
                                <?= $G['Pusher']->Notification ?>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary btn-block mt-4 mb-4">Connexion à mon compte</button>
                    </form>
                </div>
            </div>
        </div>
    </main>