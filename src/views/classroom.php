
        <div id="content-wrapper">

            <div class="container-fluid">
                <?php if (!$data['single']) { ?>
                    <div class="card mb-3">
                        <div class="card-header"><i class="fas fa-table"></i> Liste des classes</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom de la classe</th>
                                            <th>Nombre d'élèves</th>
                                            <th>Créer par</th>
                                            <th>Date de création</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['classrooms'] as $i=>$classroom) { ?>
                                            <tr>
                                                <td><?= $classroom['name'] ?></td>
                                                <td><?= $data['students_number']($classroom['identifier']) ?></td>
                                                <td>ID: <b>#<?= $classroom['own'] ?></b></td>
                                                <td>le <?= ((new \DateTime($classroom['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($classroom['creation_date']))->format('H:i')) ?></td>
                                                <td><a class="btn btn-sm btn-primary" href="/classes/<?= $classroom['identifier'] ?>/">Ouvrir</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } else { $classroom = $data['classrooms']; if (!empty($classroom)) { ?>
                    <div class="container-fluid">
                        <div class="card mb-3">
                            <div class="card-header"><i class="fas fa-table"></i> Classe de <b><?= $classroom['name'] ?></b> - Date de création: le <?= ((new \DateTime($classroom['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($classroom['creation_date']))->format('H:i')) ?></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nom & Prénom</th>
                                                    <th>Créer par</th>
                                                    <th>Date de création</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($data['students'] as $i=>$student) { ?>
                                                    <tr>
                                                        <td><?= $student['profile']['firstname'] ?> <?= $student['profile']['lastname'] ?></td>
                                                        <td>ID: <b>#<?= $student['own'] ?></b></td>
                                                        <td>le <?= ((new \DateTime($student['creation_date']))->format('d/m/Y')) ?> à <?= ((new \DateTime($student['creation_date']))->format('H:i')) ?></td>
                                                        <td><a class="btn btn-sm btn-primary" href="/etudiants/<?= $student['identifier'] ?>/">Afficher le profil</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger">Aucune classe ne correspond à l’identifiant demander.</div>
                <?php } } ?>

            </div>