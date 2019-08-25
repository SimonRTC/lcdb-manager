    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Connexion à mon compte</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Adresse email" required="required" autofocus="autofocus">
                                <label for="inputUsername">Adresse email (<small> ou nom d'utilisateur </small>)</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required="required">
                            <label for="inputPassword">Mot de passe</label>
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
    </div>