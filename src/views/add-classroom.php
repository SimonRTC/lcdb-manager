
        <div id="content-wrapper">

<div class="container-fluid">

    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-folder-plus"></i> Ajouter une classe</div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-2">
                            <label for="classroom">Nom de la classe</label>
                            <input type="text" class="form-control" id="classroom" name="classroom" required="required"/>
                        </div>
                    </div>
                    <div class="alert alert-warning mt-3 mb-3 col-6"><b>Note</b>: Une fois cette opération réalisée, il sera impossible de supprimer le contenu ajouter.</div>
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
    </div>