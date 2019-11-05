<div class="container">
	<h1 class="h2">Etat des processus</h1><hr />
	<div class="row">
		<div class="col-4">
			<div class="col-md-4"></div>
			<div class="col-md-12 success" id="messagebox" >
				<div class="row">
					<div class="col-md-2" id="messagebox-icon">
						<span class="fa fa-2x fa-check text-success"></span>
					</div>
					<div class="col-md-10">
						<div class="row h5" id="messagebox-header">Interface <small class="mt-1 ml-2">(Manager)</small></div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-check-circle text-success"></span>
							</div>
							<div class="col-md-10">
								Accessibilité (HTTP)
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-check-circle text-success"></span>
							</div>
							<div class="col-md-10">
								Authentification sécurisée
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-check-circle text-success"></span>
							</div>
							<div class="col-md-10">
								Services d'administration
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="pull-right mt-3" id="messagebox-detail-link">
						<p><u>Note:</u> Aucune panne n'a été détectée.</p>
					</div>
				</div> 
			</div>
			<div class="col-md-4"></div>
		</div>
		
		<div class="col-4">
			<div class="col-md-4"></div>
			<div class="col-md-12 fail" id="messagebox" >
				<div class="row">
					<div class="col-md-2" id="messagebox-icon">
						<span class="fa fa-2x fa-times text-danger"></span>
					</div>
					<div class="col-md-10">
						<div class="row h5" id="messagebox-header">Restauration</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-times-circle text-danger"></span>
							</div>
							<div class="col-md-10">
							Liaison série COM4
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-times-circle text-danger"></span>
							</div>
							<div class="col-md-10">
							Boitier de commande (Ethernet)
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-times-circle text-warning"></span>
							</div>
							<div class="col-md-10">
							Service de gestion interne
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="pull-right mt-3" id="messagebox-detail-link">
						<p><u>Note:</u> Incident majeur détecter provoquant la paralysie complète des services affiler.</p>
					</div>
				</div> 
			</div>
			<div class="col-md-4"></div>
		</div>
		
		<div class="col-4">
			<div class="col-md-4"></div>
			<div class="col-md-12 warning" id="messagebox" >
				<div class="row">
					<div class="col-md-2" id="messagebox-icon">
						<span class="fa fa-2x fa-exclamation-triangle text-warning"></span>
					</div>
					<div class="col-md-10">
						<div class="row h5" id="messagebox-header">
							Tâches planifiées
						</div>
						<div class="row">
							<div class="col-md-1">
								<span class="fa fa-check-circle text-success"></span>
							</div>
							<div class="col-md-10">
								Suppression des sessions<br >
								<small>Prochaine: <b>Aujourd'hui, à <?= ((new DateTime(date('H:i')))->add(new DateInterval('PT1M')))->format('H:i') ?></b></small>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-1">
								<span class="fa fa-exclamation-triangle text-warning"></span>
							</div>
							<div class="col-md-10">
								Détection d'incident<br >
								<small>Prochaine: <b>Aujourd'hui, à <?= ((date('H')+1) >= 24? '01': (date('H')+1)) ?>:00</b></small>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="pull-right mt-3" id="messagebox-detail-link">
						<p><u>Note:</u> Un ou plusieur incident perturbant actuellement le fonctionnement des services.</p>
					</div>
				</div> 
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</div>