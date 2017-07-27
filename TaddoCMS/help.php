<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include('global.php');
define("THIS_SCRIPT", 'help');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title><?php echo $sitename; ?> - Ayudanos</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="Public/JS/jquery.history.js"></script>
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main.css" />
    <link type="text/css" rel="stylesheet" href="Public/Styles/CSS/main2.css" />
	
<script type="text/javascript"> 

		var javascript_countdown = function () {
			var time_left = 10; //number of seconds for countdown
			var output_element_id = 'jstimer';
			var keep_counting = 1;
		 
			function countdown() {
				if(time_left < 2) {
					keep_counting = 0;
				}
				time_left = time_left - 1;
			}

			function add_leading_zero(n) {
				if(n.toString().length < 2) {
					return '0' + n;
				} else {
					return n;
				}
			}

			function format_output() {
				var seconds;
				seconds = time_left % 60;
				seconds = add_leading_zero( seconds );		 
				return seconds;
			}

			function show_time_left() {
				document.getElementById(output_element_id).innerHTML = format_output();//time_left;
			}

			function no_time_left() {
				location.href='client';
				//document.getElementById(output_element_id).innerHTML = no_time_left_message;
			}

			return {

				count: function () {
					countdown();
					show_time_left();

				},

				timer: function () {
					javascript_countdown.count();

					if(keep_counting) {
						setTimeout("javascript_countdown.timer();", 1000);
					} else {
						no_time_left();

					}

				},
				init: function (t, element_id) {
					time_left = t;
					output_element_id = element_id;
					javascript_countdown.timer();
				}
			};
		}();

	function CastVote() {
		javascript_countdown.init(5, 'jstimer');
		$('.Votar').fadeOut('slow');
		$('.CuentaAtras').fadeIn('slow');
		//location.href='me';
	}

</script> 
</head> 
 
<body> 

	<?php include("site/header.php"); ?>
	
	<div class="mid">
	<div id="column1">
		    <section class="menu"><section class="menu2">
			<center><b>¡Por favor, haz clic en el cuadro de la derecha!</b></center></section>
Queremos mantener el hotel las 24 Hrs y comprar un hosting con domino es por eso que nesesitamos tu ayuda dando clic en la publicidad.<br><br>
Nos puedes ayudar tan solo <b>haciendo un clic en el cuadro publicitario, o haciendo clic <a href="" onclick="CastVote();">aquí</a>.</b><br><br>
Tan solo por dar clic a la publicidad recibirás una <b>placa y 1000 créditos.</b><br><br>
Para entrar al Hotel tendrás que votarnos, sentimos los inconvenientes ocasionados, sin embargo, como recompensa recibirás una placa y 1000 créditos.<br><br>
<center><b>¡Muchas gracias por tu ayuda!</b></center>

			</section>	
	</div>
	        <div id="column2">
					    <section class="menu"><section class="menu2">
			<center><b>Clic aqui para entrar al Hotel</b></center></section>
<a href="help2.php" target="_blank" onclick="CastVote();"><h4>Haz clic aqui y seras redirijido automaticamente</h4></a><br>
<a href="http://kekotop.com/in.php?wid=3486" target="_blank" onclick="CastVote();">aqu&iacute;</a>
			</section>
			
    	<?php include("site/sideads.php"); ?>
	</div>
	
	<?php include("site/footer.php"); ?>
</div>

</body>
</html>