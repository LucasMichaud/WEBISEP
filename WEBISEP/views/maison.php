<?php 
include("views/General.php");
$idh = $_GET['idh'];
if (!empty($_SESSION['id'])) {
		$rooms = rooms();
		
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maison</title>
		<link rel="stylesheet" href="design/maison.css">
		<link rel="stylesheet" href="design/vertical.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>


		
		<div id="content">
			<div id="title">
				<?php $idm = intval($_SESSION['id']);
				$houseActive = house_active($idh,$idm);
				foreach($houseActive as $row) {
					$houseName = $row["HouseName"];
					echo $houseName;
				}
				?>
			</div>
			<?php foreach($rooms as $room) { 
				$idr= $room['RoomID']; ?>
			<div id="box">
				
				<input type="checkbox" id="<?php echo $idr; ?>">
				<div id="top">
					<div id="pièce"><?php echo $room['RoomName']; ?></div>
					<div id="info">
						<div id="temp"><?php if(isset(($room['RoomTemp']))) { echo $room['RoomTemp'].'°C'; } ?></div>
						<div id="light"></div>
						<div id="captor"><span title="Signaler un capteur défectueux ou autre problème"><a href="index.php?action=billet" id="report_problem"><i class="material-icons report_problem">report_problem</i></a></span></div>
					</div>
				</div>
				<div id="bot">
					<div id="control">

						<?php $lamps = lamps($idr);
						foreach($lamps as $lamp) {
							$idl = $lamp['LampID'];
							$statel = $lamp['LampCondition'];
						?>

						<div>
							<p><?php echo $lamp['LampName']; ?></p>
							<label class="switch">
								<a href="index.php?action=actionLamp&idh=<?= $idh ?>&idl=<?= $idl ?>">
									<input type="checkbox" name="switch" value="1"
										<?php if($statel == true) {echo 'checked';}?> >
									  <span class="slider lamp"></span>
								</a>
  							</label>
  						</div>

  						<?php }
						$windows = windows($idr);
						foreach ($windows as $window) { 
							$idw = $window['WindowID'];
							$statew = $window['WindowCondition'];
						?>

  						<div>
							<p><?php echo $window['WindowName']; ?></p>
							<label class="switch">
								<a href="index.php?action=actionWindow&idh=<?= $idh ?>&idw=<?= $idw ?>">
									<input type="checkbox" name="switch" value="1"
										<?php if($statew == true) {echo 'checked';}?> >
									<span class="slider window"></span>
								</a>
  							</label>
  						</div>

  						<?php } ?>
					</div>
					<div id="options">
						<div id="parameters">
							<span title="Modifier la pièce">
								<a href="index.php?action=editRoom&idh=<?= $idh ?>&idr=<?= $idr ?>"><i class="material-icons setting_btn">settings</i></a>
							</span>
						</div>
						<div class="listecap" id="li<?= $room["RoomID"] ?>">
							<span title="Afficher la liste des capteurs de la pièce">
								<button class="butliste"><i class="material-icons list">list</i></button>
							</span>		
						</div>
						<?php
						if(isset(($room['RoomTempState']))) { 
							$roomTempReq = $room['RoomTempReq'];
							echo "
						<div class='range-slider'>
        					<div class='thermometer'></div>
				            <input class='vertical' data-id='".$room["RoomID"]."' type='range' step='0.5' value='".$roomTempReq."' min='10' max='30'>
				            <div class='bulb'></div>
				            <p class='print'><span id='print".$room["RoomID"]."'></span>°C</p>
				        </div>
				    	"; } ?>
					</div>
					<div id="roomli<?= $room["RoomID"] ?>">
					</div>
				</div>	
			</div>
			<?php } ?>
			<span title="Ajouter une pièce"><div id="addRoom">
  				<a href="index.php?action=addRoom&idh=<?= $idh ?>" id="add"><i class="material-icons plus_btn">add</i></a>
  			</div></span>
  			<p id="test"></p>
		</div>
	<?php }
	else{
		header('Location:index.php?action=connexion');
		
	}?>
	</body>
</html>
<script>
	/*$(document).on('load', '.vertical', function(){  
	    var id = $(this).data("id");  
	    var slider = $(this).value;
	    var output = document.getElementById("test");
		output.innerHTML = slider.value;
	});*/
$(document).ready(function(){ 

	$(document).on('click', '.butliste', function(){

		alert("click");
	});
});
</script>