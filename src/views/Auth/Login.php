    <main role="main" class="login-form">

        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Connexion à mon compte</div>
                        <div class="card-body">

                            <form method="POST">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Adresse email<br /><small>(Ou nom d'utilisateur)</small></label>
                                    <div class="col-md-6">
                                        <input type="text" id="username" class="form-control" name="username" placeholder="example@gmail.com" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="* * * * * *" required>
                                    </div>
                                </div>

                                <?php if (!empty($G['Pusher']->Notification)) { ?>
                                    <div class="col-md-8 justify-content-center offset-md-2 alert alert-danger mt-4">
                                        <?= $G['Pusher']->Notification ?>
                                    </div>
                                <?php } ?>

                                <div class="col-md-6 justify-content-center offset-md-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Connexion
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>