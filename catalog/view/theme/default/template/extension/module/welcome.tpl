<div class="welcome">	<?php echo $heading_title; ?></div>

<div style="display:none;">
		<div id="div-welcome" >
			<?php echo $message; ?>
		</div>
		</div>
		<?php 
		 if((isset($_GET['route']) && !isset($_SESSION[$_GET['route']])) 
		 	|| (!isset($_SESSION['home']) && !isset($_GET['route']) )){
		?>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#div-welcome").dialog({
					  width: 'auto',
					  height: 'auto',
					  modal: true,
					  resizable: false,
					  draggable :false
				});
			});

		</script>
		<?php } ?>

		<?php
			if(isset($_GET['route'])) {
				$_SESSION[$_GET['route']] = 1;	
			}else{
				$_SESSION['home'] = 1;
				$_SESSION['common/home'] = 1;	
			}
		 
		?>