<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('songs');
sendVarToJS('eqType', $plugin->getId());
?>

<div class="row row-overflow">
	<div class="col-xs-12 songThumbnailDisplay">
		<legend><i class="fas fa-cog"></i> {{Gestion}}</legend>
		<div class="eqLogicThumbnailContainer">
			<div class="cursor songAction logoPrimary" data-action="add">
				<i class="fas fa-plus-circle"></i>
				<br>
				<span>{{Ajouter}}</span>
			</div>
			<div class="cursor songAction logoSecondary" data-action="gotoPluginConf">
				<i class="fas fa-wrench"></i>
				<br>
				<span>{{Configuration}}</span>
			</div>
			<?php
			$jeedomVersion  = jeedom::version() ?? '0';
			$displayInfo = version_compare($jeedomVersion, '4.4.0', '>=');
			if ($displayInfo) {
				echo '<div class="cursor eqLogicAction info" data-action="createCommunityPost">';
				echo '<i class="fas fa-ambulance"></i><br>';
				echo '<span>{{Community}}</span>';
				echo '</div>';
			}
			?>
		</div>
		<legend><i class='fas fa-music'></i> {{Mes sons}}</legend>
		<div class="input-group" style="margin-bottom:5px;">
			<input class="form-control roundedLeft" placeholder="{{Rechercher}}" id="in_searchEqlogic" />
			<div class="input-group-btn">
				<a id="bt_resetObjectSearch" class="btn" style="width:30px"><i class="fas fa-times"></i>
				</a><a class="btn roundedRight hidden" id="bt_pluginDisplayAsTable" data-coreSupport="1" data-state="0"><i class="fas fa-grip-lines"></i></a>
			</div>
		</div>
		<div class="eqLogicThumbnailContainer">
			<?php
			foreach (songs_song::all() as $song) {
				echo '<div class="songDisplayCard cursor" data-song_id="' . $song->getId() . '">';
				echo '<img src="' . $plugin->getPathImgIcon() . '"/>';
				echo '<br>';
				echo '<span class="name">' . $song->getName() . '</span>';
				echo '</div>';
			}
			?>
		</div>
	</div>

	<div class="col-xs-12 song" style="display: none;">
		<div class="input-group pull-right" style="display:inline-flex">
			<span class="input-group-btn">
				<a class="btn btn-sm btn-success songAction roundedLeft" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}
				</a><a class="btn btn-danger btn-sm songAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}</a>
			</span>
		</div>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation"><a href="#" class="songAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fas fa-arrow-circle-left"></i></a></li>
			<li role="presentation" class="active"><a href="#songtab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-music"></i> {{Son}}</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="songtab">
				<form class="form-horizontal">
					<fieldset>
						<div class="col-lg-6">
							<legend><i class="fas fa-wrench"></i> {{Général}}</legend>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Nom du son}}</label>
								<div class="col-xs-11 col-sm-7">
									<input type="text" class="songAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="songAttr form-control" data-l1key="name" placeholder="{{Nom du son}}" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{ID}}</label>
								<div class="col-xs-11 col-sm-7">
									<input type="text" class="songAttr form-control" data-l1key="logicalId" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Sons}}</label>
								<div class="col-sm-7 col-xs-11">
									<span class="btn btn-default btn-file">
										<i class="fas fa-cloud-upload-alt"></i> {{Envoyer}}<input id="bt_uploadSong" type="file" name="file" style="display: inline-block;">
									</span>
								</div>
							</div>

						</div>

					</fieldset>

				</form>
			</div>
		</div>
	</div>
</div>

<?php include_file('core', 'songs', 'js', 'songs'); ?>
<?php include_file('core', 'plugin.template', 'js'); ?>
<?php include_file('core', 'songs', 'class.js', 'songs'); ?>
<?php include_file('desktop', 'songs', 'js', 'songs'); ?>