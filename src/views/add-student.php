
        <div id="content-wrapper">

            <div class="container-fluid">

                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-user-plus"></i> Ajouter un étudiants</div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="firstname">Prénom</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" required="required"/>
                                    </div>
                                    <div class="col-2">
                                        <label for="lastname">Nom</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" required="required"/>
                                    </div>
                                    <div class="col-4">
                                        <label for="firstname">Photo de profil</label><br />
                                        <input type="file" class="btn btn-sm btn-primary mt-3" name="picture" id="profile-picture">
                                    </div>
                                </div>
                                <hr class="mt-4 mb-3" />
                                <div class="row">
                                    <div class="col-3">
                                        <label for="classroom">Sélectionner une classe:</label>
                                        <select class="form-control" id="classroom" name="classroom">
                                        <option value="noclassroom">Ne pas définir de classe pour le moment</option>
                                        <option disabled="disabled">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</option>
                                            <?php foreach ($data['classroom']() as $classroom) { ?>
                                                <option value="<?= $classroom['identifier'] ?>"><?= $classroom['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-3" />
                                <div class="row">
                                    <div class="col-4">
                                        <label for="diet">Régime alimentaire:</label>
                                        <select class="form-control col-6" id="diet" name="diet">
                                            <?php foreach ($data['diets'] as $diet) { ?>
                                                <option value="<?= $diet['id'] ?>"><?= $diet['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-3" />
                                <div class="row">
                                    <div class="col-4">
                                        <label for="options">Options:</label>
                                        <?php foreach ($data['options'] as $option) { if ($option['display']) { ?>
                                            <div class="col-8">
                                                <ul>
                                                    <li><b><?= $option['name'] ?></b> - Participe: <input type="checkbox" id="<?= $option['id'] ?>" name="<?= $option['id'] ?>" value="true"/></li>
                                                </ul>
                                            </div>
                                        <?php } } ?>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-3" />
                                <?php if (!empty($G['Pusher']->Notification)) { ?>
                                    <div clas="row align-items-cente mt-4 mb-4">
                                        <div class="col-12">
                                            <div class="alert alert-<?= $G['Pusher']->Type ?> mt-4">
                                                <?= $G['Pusher']->Notification ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row justify-content-md-center">
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-success btn-sm btn-block">Enregistrer le profil de cette étudiant</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>