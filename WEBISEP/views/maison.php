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
						<div id="parameters">
							<span title="Modifier la pièce">
								<a href="index.php?action=editRoom&idh=<?= $idh ?>&idr=<?= $idr ?>"><i class="material-icons setting_btn">settings</i></a>
							</span>
						</div>
						<div id="captor"><span title="Signaler un capteur défectueux ou autre problème"><a href="index.php?action=billet" id="report_problem"><i class="material-icons report_problem">report_problem</i></a></span></div>
					</div>
				</div>
				<div id="bot">
						

						
								<?php
							if($room['RoomTempState'] == 1) { 
								$roomTempReq = $room['RoomTempReq'];
								echo '<div id="thermos">
								<form method="post" action="index.php?action=newtemp&idh='.$idh.'">
									<div class="range-slider">
	        							<div class="thermometer"></div>
					            			<input class="vertical" name="tempReq" id="tempReq" type="range" step="1" value="'.$roomTempReq.'" min="10" max="40">
					           			 <div class="bulb"></div>
					            		<p class="print"><span id="print"></span>°C</p>
					        		</div>

					        		<div id="cercle">
                        					<span title="Modifier la température">
                        						<button type="submit" id="submit" value=""><i class="material-icons">refresh</i></button>
                        					</span>
                    				</div>
                    				<input type="hidden" name="roomTempUp" id="roomTempUp" value="'.$idr.'">
					        	</form>
					        	</div>
					    	'; } ?>
				        

				    	<div id="bigliste">

					    	<div id="actionneurs">
								<?php $lamps = lamps($idr);
								foreach($lamps as $lamp) {
									$idl = $lamp['LampID'];
									$statel = $lamp['LampCondition'];
								?>

								<div id="lum">
									<p><?php echo $lamp['LampName']; ?></p>
									<div id="click">
										<label class="switch">
											<a href="index.php?action=actionLamp&idh=<?= $idh ?>&idl=<?= $idl ?>">
												<input type="checkbox" name="switch" value="1"
													<?php if($statel == true) {echo 'checked';}?> >
												  <span class="slider lamp"></span>
											</a>
			  							</label>
			  						</div>
		  						</div>

		  						<?php }
								$windows = windows($idr);
								foreach ($windows as $window) { 
									$idw = $window['WindowID'];
									$statew = $window['WindowCondition'];
								?>

		  						<div id="win">
									<p><?php echo $window['WindowName']; ?></p>
									<div id="click">
										<label class="switch">
											<a href="index.php?action=actionWindow&idh=<?= $idh ?>&idw=<?= $idw ?>">
												<input type="checkbox" name="switch" value="1"
													<?php if($statew == true) {echo 'checked';}?> >
												<span class="slider window"></span>
											</a>
			  							</label>
		  							</div>
		  						</div>
		  					<?php } ?>
		  					</div>

		  					<div id="ligne"></div>


	  						<div id="listedecapteurs">
		  						<?php $captors = captors($idr); ?>
		  						<div>
		  							<?php 
								foreach ($captors as $captor) { 
									$idc = $captor['CaptorID'];
								?>
			  						<div>
										<p><?php echo $captor['CaptorName']; ?> / <?php echo $captor['CaptorType']; ?></p>

									</div>
								<?php } ?>
								</div>
							</div>

						</div>
				</div>	

			</div>


			<?php } ?>
			<span title="Ajouter une pièce">
				<div id="addRoom">
  					<a href="index.php?action=addRoom&idh=<?= $idh ?>" id="add"><i class="material-icons plus_btn">add</i></a>
  				</div>
  			</span>
		</div>
	<?php } 
}
	else {
		header('Location:index.php?action=connexion');
		
	}?>
	</body>
</html>
<script>
var slider = document.getElementById("tempReq");
var output = document.getElementById("print");
output.innerHTML = slider.value;

slider.oninput = function() {
	output.innerHTML = this.value; 
}  


</script>