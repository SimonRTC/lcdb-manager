
        <div id="content-wrapper">

            <div class="container-fluid">

                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-plus"></i> Ajouter une option</div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="classroom">Nom de l'option</label>
                                        <input type="text" class="form-control" id="option" name="option" required="required"/>
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
                                        <button type="submit" class="btn btn-success btn-sm btn-block">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-toolbox"></i> Gestion des options</div>
                        <div class="card-body">
                            <ul>
                                <?php foreach ($data['options']() as $option) { if ($option['display']) { ?>
                                    <li class="mt-3"><?= $option['name'] ?> - (<small>Ajouter le <b><?= (new \DateTime($option['creation_date']))->format('d/m/Y') ?></b> à <b><?= (new \DateTime($option['creation_date']))->format('H:i') ?></b></small>) - <a href="/ajouter-option/<?= $option['id'] ?>/" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>