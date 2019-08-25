
       
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- 
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                -->
                <li class="breadcrumb-item active">Overview</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="mr-5"><?= $data['students']() ?> Étudiants</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/etudiants/">
                            <span class="float-left">Afficher la liste des étudiants</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="far fa-folder"></i>
                                </div>
                                <div class="mr-5"><?= $data['classrooms']() ?> Classes</div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/classes/">
                                <span class="float-left">Afficher la liste des classes</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="mr-5">0 Passages en restauration</div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/restauration/">
                                <span class="float-left">Afficher la liste des passages en restauration</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                            <i class="fas fa-fw fa-life-ring"></i>
                            </div>
                            <div class="mr-5">~ GitHub Issues ~</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="https://github.com/SimonOriginal/lcdb-manager/issues/" target="_BLANK">
                            <span class="float-left">Créer un nouveau ticket</span>
                            <span class="float-right">
                            <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                        </div>
                    </div>
                </div>

            </div>