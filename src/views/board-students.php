
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
                            <div class="row mt-5 mb-5 ml-5 mr-5">
                                <?php foreach ($students as $student) { ?>
                                    <?= (isset($BreakLine) && $BreakLine? '</div><div class="row">': null) ?>
                                    <div class="col-5 mt-5 ml-4 mr-4">
                                        <img width="95" class="img-thumbnail mt-2 mb-2" src="<?= $student['picture'] ?>" />
                                        <p><?= $student['profile']['firstname'] ?> <?= $student['profile']['lastname'] ?><br /><?= $data['diets']($student['profile']['diet'])[0]['name'] ?></p>
                                        <hr />
                                        <p>
                                            <?php foreach ($data['option'] as $option) { if (!empty($student['profile']['options'])) { foreach ($student['profile']['options'] as $my) { if ($option['id'] == $my['id'] && $my['active']) { ?>
                                                - <?= $option['name'] ?><br />
                                            <?php  } } } else { echo '<span class="badge badge-secondary">Aucune options</span>'; break; } } ?>    
                                        </p>           
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
        var Trombinoscope     = window.open('', 'new div', 'height=400,width=600');
        var div_content       = document.getElementById('ready-for-print');
        div_content           = div_content.innerHTML
        Trombinoscope.document.write('<html><head><title>Trombinoscope - <?= $classroom['name'] ?></title>');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/vendor/datatables/dataTables.bootstrap4.css" type="text/css" />');
        Trombinoscope.document.write('<link rel="stylesheet" href="/assets/css/sb-admin.css" type="text/css" />');
        Trombinoscope.document.write('</head><body>');
        Trombinoscope.document.write('<style>.row { display: flex; }.row > div { flex: 0.20; background: #E5E5E5; border: 1px solid #CCCCCC; } </style>');
        Trombinoscope.document.write('</head><body>');
        Trombinoscope.document.write(div_content);
        Trombinoscope.document.write('</div></div></body></html>');
        Trombinoscope.document.close();
        Trombinoscope.focus();
        setTimeout(function(){ Trombinoscope.print(); },1000);
        // Trombinoscope.close();
        return true;
    }

</script>