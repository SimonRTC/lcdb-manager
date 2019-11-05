
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
                                                <td><a class="btn btn-sm btn-primary" href="/trombinoscope/<?= $classroom['identifier'] ?>/">Générer un trombinoscope</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } else { $classroom = $data['classrooms']; if (!empty($classroom[0])) {$classroom =  $classroom[0]; $students = $data['students']($classroom['identifier']);  ?>
                    <?php if (!empty($students)) { ?>
                        <button onclick="PrintTrombinoscope()" class="btn btn-success btn-sm mb-4">Lancer l'impression</button>
                        <div id="ready-for-print">

                            <div class="row">

                                <?php foreach ($students as $i=>$student) { $students[$i]['name'] = $student['profile']['firstname'] . ' ' . $student['profile']['lastname']; } usort($students, function ($item1, $item2) { return $item1['name'] <=> $item2['name']; }); ?>
                                <?php foreach ($students as $student) { ?>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-2">
                                        <div class="board-card tile">
                                            <div class="wrapper">
                                                <div class="board-card header"><?= $student['name'] ?><br /><small><?= $data['diets']($student['profile']['diet'])[0]['name'] ?></small></div>

                                                <div class="board-card banner-img mb-3">
                                                    <img src="<?= (!empty($student['picture'])? $student['picture']: '/assets/img/profile-pic.svg') ?>" alt="Image 1">
                                                </div>

                                                <div class="board-card options row">
                                                    <?php foreach ($data['option'] as $option) { if ($option['display']) { if (!empty($student['profile']['options'])) { foreach ($student['profile']['options'] as $my) { if ($option['id'] == $my['id'] && $my['active']) { ?>
                                                        <div class="col-10"><strong><?= $option['name'] ?></strong></div>
                                                        <div class="col-2"><i class="far fa-check-square"></i></div><hr />
                                                    <?php } } } else { echo '<div class="col-10"><span class="badge badge-warning">Aucune option</span></div>'; break; } } } ?>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger">Aucun élève n'est présent actuellement dans cette classe.</div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="alert alert-danger">Aucune classe ne correspond à l’identifiant demander.</div>
                <?php } } ?>
            </div>


<script>

    function PrintTrombinoscope() {
        var Trombinoscope     = window.open('', 'new div', 'height=1654,width=2339');
        var div_content       = document.getElementById('ready-for-print');
        div_content           = div_content.innerHTML
        Trombinoscope.document.write('<html><head><title>Trombinoscope - <?= $classroom['name'] ?></title>');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css" type="text/css" />');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/vendor/datatables/dataTables.bootstrap4.css" type="text/css" />');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/css/sb-admin.css" type="text/css" />');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/css/board.css" type="text/css" />');
        Trombinoscope.document.write('<style media="print">@page { size: auto; margin: 0; }</style>');
        Trombinoscope.document.write('</head><body><div id="content-wrapper"><div class="container-fluid">');
        Trombinoscope.document.write(div_content);
        Trombinoscope.document.write('</div></div></body></html>');
        Trombinoscope.document.close();
        Trombinoscope.focus();
        setTimeout(function(){ Trombinoscope.print(); }, 500);
        Trombinoscope.onafterprint = function () { setTimeout(function () { Trombinoscope.close(); }, 500); }
        return true;
    }

</script>