<?php
$error = "";

### Placa a Vender ###
$placa = "HH1";

### Precio en Píxeles ###
$precio = "2000";

if(isset($_POST['buy-bad']))
{
	$user_info = @mysql_query("SELECT * FROM users WHERE username='".$_POST["habbo"]."'");
	if($row = mysql_fetch_assoc($user_info))
	{
		$id = $row['id'];
		
		$check_bag = mysql_query("SELECT * FROM user_badges WHERE user_id='". $id ."' AND badge_id='". $placa ."'");
		$check_user = mysql_query("SELECT * FROM users WHERE id='". $id ."'");

		if(mysql_num_rows($check_bag) > 0)
		{
			$error.= '<br><font color="#FF0000">Ya tienes esta placa en tu inventario</font>';
		}
		else
		{
			if($mostrar = mysql_fetch_assoc($check_user))
			{
				$pixeles = $mostrar['activity_points'];
				if($pixeles >= $precio)
				{
					$pixeles_totales = $pixeles - $precio;
					mysql_query("UPDATE `users` SET `activity_points` = '". $pixeles_totales ."' WHERE `id` = '". $id ."';");
					mysql_query("INSERT INTO `user_badges` (`user_id`, `badge_id`, `badge_slot`) VALUES (". $id .", '". $placa ."', 0)");
					$pixeles_totales = number_format($pixeles_totales);
					$error.= "<br /><font color='#009900'>Felicidades Acabas de comprar la placa <strong>$placa</strong>. <br /> Te quedan: " . $pixeles_totales . " pixeles.</font>";
				}
				else
				{
					$error.= "<br><font color='#FF0000'>No tienes suficientes pixeles para realizar la compra</font>";
				}
			}
		}
	}
}
?>