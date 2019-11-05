
<style>
    .form-control.inline {
        display: inline-block;
        width: 14.25rem;
    }
    .hidden {
        visibility: hidden;
    }
</style>
        <div id="content-wrapper">

            <div class="container-fluid">
                <?php if (!$data['single']) { ?>
                    <?php if ($data['students_number']('noclassroom') > 0) { ?>
                        <div class="card mb-3">
                            <div class="card-header"><i class="fas fa-table"></i> Liste des étudiants <b>en attente d'affectation</b></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nom et Prénom</th>
                                                <th>Créer par</th>
                                                <th>Date de création</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['students'] as $i=>$student) { if ($student['classroom'] == 'noclassroom') { ?>
                                                <tr>
                                                    <td><?= $student['profile']['firstname'] ?> <?= $student['profile']['lastname'] ?></td>
                                                    <td>ID: <b>#<?= $student['own'] ?></b></td>
                                                    <td>le <?= ((new \DateTime($student['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($student['creation_date']))->format('H:i')) ?></td>
                                                    <td><a class="btn btn-sm btn-warning text-white" href="#" data-toggle="modal" data-target="#modal-<?= $student['identifier'] ?>">Attribuer une classe</a><a class="btn btn-sm btn-primary ml-3" href="/etudiants/<?= $student['identifier'] ?>/">Afficher le profil</a></td>
                                                </tr>
                                                <div class="modal fade" id="modal-<?= $student['identifier'] ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $student['identifier'] ?>Label" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="<?= $student['identifier'] ?>Label">Modifier la classe de <b><?= $student['profile']['firstname'] ?> <?= $student['profile']['lastname'] ?></b></h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <label for="identifier">Identifiant de l'étudiant:</label>
                                                                                <input type="text" class="form-control" id="identifier" name="identifier" value="<?= $student['identifier'] ?>" readonly="readonly" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-4">
                                                                            <div class="col-8">
                                                                                <label for="classroom">Sélectionner une classe:</label>
                                                                                <select class="form-control" id="classroom" name="classroom">
                                                                                    <?php foreach ($data['classroom']() as $classroom) { ?>
                                                                                        <option value="<?= $classroom['identifier'] ?>"><?= $classroom['name'] ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                                                    <button class="btn btn-primary" type="submit">Appliquer les modifications</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card mb-3">
                        <div class="card-header"><i class="fas fa-table"></i> Liste des étudiants</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom et Prénom</th>
                                            <th>En classe de</th>
                                            <th>Créer par</th>
                                            <th>Date de création</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['students'] as $i=>$student) { if ($student['classroom'] != 'noclassroom') { ?>
                                            <tr>
                                                <td><?= $student['profile']['firstname'] ?> <?= $student['profile']['lastname'] ?></td>
                                                <td><?= $data['classroom']($student['classroom'])[0]['name'] ?></td>
                                                <td>ID: <b>#<?= $student['own'] ?></b></td>
                                                <td>le <?= ((new \DateTime($student['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($student['creation_date']))->format('H:i')) ?></td>
                                                <td><a class="btn btn-sm btn-primary" href="/etudiants/<?= $student['identifier'] ?>/">Afficher le profil</a></td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } else { $student = $data['students']; if (!empty($student)) { ?>
                    <!-- <form id="global" method="POST"> Soon = only one form for user... -->
                        <div class="container-fluid">
                            <div class="card mb-3">
                                <div class="card-header"><i class="fas fa-table"></i> <b><?= ($student['profile']['firstname'] != null? $student['profile']['firstname']: 'Sans noms') ?> <?= $student['profile']['lastname'] ?></b> - Date de création: le <?= ((new \DateTime($student['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($student['creation_date']))->format('H:i')) ?></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <form method="post" enctype="multipart/form-data">
                                                    <img width="150" class="img-thumbnail" src="<?= (!empty($student['picture'])? $student['picture']: 'https://www.grafikart.fr/uploads/avatars/default.png') ?>">
                                                    <?= ($data['editmode']? '<input type="file" class="btn btn-sm btn-default mt-3" name="picture" id="profile-picture">': null) ?>
                                                    <?= ($data['editmode']? '<button type="submit" class="btn btn-primary btn-sm btn-block col-8 mt-3 mb-2">Modifier la photo</button>': null) ?>
                                                    <br /><p class="mt-3"><small>Identifiant: <b><?= $student['identifier'] ?></b><br />Ajouter par: <b>#<?= $student['own'] ?></b></small></p>
                                                    <?= (!$data['editmode'] ? '<a class="btn btn-sm btn-warning text-white" href="/etudiants/' . $student['identifier'] . '/editer/">Modifier le profil</a>': null) ?>
                                                    <?= ($data['editmode']? '<input type="text" id="identifier" class="hidden" name="identifier" value="' . $student['identifier'] . '" />': null) ?>
                                                </form>
                                                <form id="global" method="POST">
                                                <?= ($data['editmode']? '<input type="text" id="identifier" class="hidden" name="identifier" value="' . $student['identifier'] . '" />': null) ?>
                                            </div>
                                            <div class="col-4">
                                                <h3><b><span id="profil-infos"><?= ($student['profile']['firstname'] != null? $student['profile']['firstname']: 'Sans noms') ?> <?= $student['profile']['lastname'] ?></span></b> <?= ($data['editmode']? '<small><a id="edit-profil-infos" href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a></small> ': null) ?></h3>
                                                <p>Date de création: le <?= ((new \DateTime($student['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($student['creation_date']))->format('H:i')) ?></p>
                                                <?= ($data['editmode']? '<input type="text" id="editnames" class="hidden" name="editnames" value="" />': null) ?>
                                                <hr />
                                                <?php if (!$data['editmode']) { ?>
                                                <?= (!empty($student['profile']['options'])? '<p>Options:</p>': '<p>Aucune information complémentaire n\'a été saisie pour le moment</p>') ?>
                                                <?php if (!empty($student['profile']['options'])) { foreach ($student['profile']['options'] as $client_option) { ?>
                                                    <?php foreach ($data['options'] as $option) { if ($option['id'] == $client_option['id']) { ?>
                                                        <div class="col-8">
                                                            <ul>
                                                                <li><?= $option['name'] ?></li>
                                                                <li>Participe: <small><?= ($client_option['active']? '<i class="far fa-check-square"></i>': '<i class="far fa-window-close"></i>') ?></small> <b><?= ($client_option['active']? 'Oui': 'Non') ?></b></li>
                                                            </ul>
                                                            <hr />
                                                        </div>
                                                    <?php } ?>
                                                <?php } } } ?>
                                                <?php } else { ?>
                                                    <?php foreach ($data['options'] as $option) { if ($option['display']) { ?>
                                                        <div class="col-8">
                                                            <ul>
                                                                <li><?= $option['name'] ?></li>
                                                                <li>Participe: <input type="checkbox" id="<?= $option['id'] ?>" name="<?= $option['id'] ?>" value="true" <?php foreach ($student['profile']['options'] as $client_option) { if ($client_option['id'] == $option['id']) { echo 'checked="checked"'; break; } } ?>/></li>
                                                            </ul>
                                                            <hr />
                                                        </div>
                                                    <?php } } ?>
                                                <?php } ?>
                                            </div>
                                            <div class="col-6">
                                                <h3>Service de restauration</h3>
                                                <?php if (!empty($student['profile']['diet'])) { foreach ($data['diets'] as $diet) { if ($diet['id'] == $student['profile']['diet']) { $porfile_diet = $diet['name']; break; } else { $porfile_diet = null; } } } ?>
                                                <p>Régime alimentaire: <?= (!$data['editmode']? '<b>'. (!empty($porfile_diet)? $porfile_diet: '<span class="badge badge-danger">Indéterminé</span>'). '</b>': null) ?></p>
                                                <?php if ($data['editmode']) { ?>
                                                    <select class="form-control col-6" name="diet">
                                                        <?php foreach ($data['diets'] as $diet) { ?>
                                                            <option value="<?= $diet['id'] ?>" <?php if ($student['profile']['diet'] == $diet['id']) { echo 'selected="selected"'; } ?>><?= $diet['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>
                                                <hr />
                                                <div class="alert alert-warning mt-4">Service indisponible</div>
                                            </div>
                                        </div>
                                        <?php if ($data['editmode']) { ?>
                                            <div class="container mt-5">
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
                                                        <button type="submit" class="btn btn-success btn-sm btn-block">Enregistrer les modifications</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="alert alert-danger">Aucun étudiant ne correspond à l’identifiant demander.</div>
                <?php } } ?>

            </div>


<script type="text/javascript">

    edit_btn = document.getElementById("edit-profil-infos");
    edit_btn.addEventListener("click", function(){ addElement() });
    realinput = document.getElementById("editnames");

    realinput.value = document.getElementById("profil-infos").innerHTML;

    function addElement() {
        div = document.getElementById("profil-infos");
        if (typeof IsOnEditionMode == 'undefined' || !IsOnEditionMode) {
            var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("id", "input-profil-infos-edit");
            x.setAttribute("class", "form-control inline");
            x.setAttribute("value", div.innerHTML);
            div.innerHTML       = null;
            div.appendChild(x);
            edit_btn.innerHTML  = '<i class="fas fa-times"></i>';
            IsOnEditionMode     = true
        } else {
            x = document.getElementById("input-profil-infos-edit");
            div.innerHTML       = null;
            div.innerHTML       = x.value;
            realinput.value     = x.value;
            x.remove();
            edit_btn.innerHTML  = '<i class="fas fa-pencil-alt"></i>';
            IsOnEditionMode     = false;
        }
    }

</script>