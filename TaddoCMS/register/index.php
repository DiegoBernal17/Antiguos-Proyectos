<?php
define('USERNAME_REQUIRED', FALSE);
define('ACCOUNT_REQUIRED', FALSE);
include("../global.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
	<title><?php echo $sitename;?> - registrate es gratis</title>
	<link type="text/css" rel="stylesheet" href="../Public/Styles/CSS/login.css" />
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js"></script> 
</head> 

<script type="text/javascript">

function checkBd() {
	incomingd = $('#bdday').val();
	incomingm = $('#bdmonth').val();
	incomingy = $('#bdyear').val();
	birthdayIsValid = 1;
	if( incomingd >= 1 && incomingd <= 31 ) {	
	} else {
		birthdayIsValid = 0;
	}
	if( incomingm >= 1 && incomingm <= 12 ) {
	} else {
		birthdayIsValid = 0;
	}
	if( incomingy >= 1970 && incomingy <= 2011 ) {
	} else {
		birthdayIsValid = 0;
	}
}

function doCheckMail() {
	MailisFree = 1;
	name = $("#formemail").val();
	$.get("mailcheck.php", {ajaxAct: "check_habbo_name", mail: name}, function(data) {
		if( $.trim(data) == "0" ) {
			$("#habbo_name_message_box").html("<h3>Este email está siendo usado por otro usuario.</h3> No puedes usar el mismo email que otro usuario.");
			$("#habbo_name_message_box").removeClass().addClass("errormsg");
			MailisFree = 0;
		}
	});
}

$().ready(function() {
	$('#formemail').keypress(function(e){
		if(e.which == 13){
			doCheckMail();
		}
	});

	$('#formemail').blur(function(e){
		doCheckMail();
	});

	$("#register_step_one").validate({
		submitHandler: function(form) {
			checkBd();
			if( birthdayIsValid === 1 ) {
				doCheckMail();
				if (MailisFree === 1) {
					form.submit();
				}
			} else {
				errorForm();
			}
		},
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			},
			cpassword: {
				required: true,
				minlength: 5,
				equalTo: "#formpassword"
			}
		},
		messages: {
			email: "Debes ingresar un email válido.",
			password: "Este espacio es requerido",
			cpassword: "Este espacio es requerido"
		}
	});	
});

emailIsValid = 0;
usernameIsValid = 0;
passwordIsValid = 0;
passwordIsConfirmed = 0;
birthdayIsValid = 0;
MailisFree = 0;

function errorForm() {
	$('#bd_err').removeClass("display_none");
}

</script>

<body> 
<div class="loginBox">
	<div class="top"> 
		<a href="../index.php"><img src="../Public/Styles/Images/logo.png" /></a>
		<?php echo $core->UsersOnline(); ?> Usarios Online
	</div> 
	
	<div class="mid"> 
		<div class="registerBox" id="right"> 

			<div class="box_header">Registrar una nueva cuenta</div>

			<form id="register_step_one" method="post" action="step2.php">
				<label for="email">Email:</label><br />
				<input type="text" name="email" id="formemail" />
				<div class="errormsg display_none" id="habbo_name_message_box"> 
					<h3>Error message</h3> 
					Error text goes here oh no.
				</div>
				<br /><br />
				<label for="password">Contraseña:</label><br /> 
				<input type="password" name="password" id="formpassword" />
				<br />
				<label for="cpassword">Pon denuevo la contraseña:</label><br /> 
				<input type="password" name="cpassword" id="formcpassword" />
				<br /><br />
				Cumpleaños:<br />
				<select name="bdday" id="bdday" class="dateselector"><option value="">Dia</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> <select name="bdmonth" id="bdmonth" class="dateselector"><option value="">Mes</option><option value="1">Enero</option><option value="2">Febrero</option><option value="3">Marzo</option><option value="4">Abril</option><option value="5">Mayo</option><option value="6">Junio</option><option value="7">Julio</option><option value="8">Agosto</option><option value="9">Septiembre</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option></select> <select name="bdyear" id="bdyear" class="dateselector"><option value="">Año</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>
				<br />
				<div class="errormsg display_none" id="bd_err"><strong>Tú fecha de nacimiento es inválida.</strong></div>

				<input type="submit" id="reg_submit_button" value="Registrarse" onmousedown="this.style.backgroundColor='#ddd';" onmouseup="this.style.backgroundColor='#eee';" onmouseover="this.style.backgroundColor='#eee';" onmouseout="this.style.backgroundColor='#fff';" />
			</form> 
		</div> 

		<div class="loginForm" style="display:none"> 
			<div class="box_header">Connect using a Social Network</div>
			<div id="auth-providers" class="auth-providers"> 
				<ul> 
					<li class="otaku"> 
						<a class="provider" href="#">..</a> 
					</li> 
					
					<li class="facebook"> 
						<a class="provider" href="#">..</a> 
					</li> 
					
					<li class="twitter"> 
						<a class="provider" href="#">..</a> 
					</li> 
					
					<li class="windowslive"> 
						<a class="provider" href="#">..</a> 
					</li> 
					
					<li class="google"> 
						<a class="provider" href="#">..</a> 
					</li> 
				</ul> 
			</div> 
		</div>
	</div> 

	<?php include("../site/footer.php"); ?>
</div> 
 
</body> 
</html>