<?php
class Core
{
	public static function EscapeString($string = '')
	{
		return mysql_real_escape_string(stripslashes(trim(htmlspecialchars($string))));
	}
	
	public static function EscapeStringHK($string = '')
	{
		return mysql_real_escape_string(stripslashes(trim($string)));
	}
	
	public static function UsersOnline()
	{
		$online = mysql_fetch_array(mysql_query("SELECT * FROM server_status"));
		return intval($online['users_online']);
	}
	
	public static function CmsSetting($row = '')
	{
		$res = mysql_fetch_array(mysql_query("SELECT * FROM cms_settings WHERE variable = '".$row."' LIMIT 1"));
		return $res['value'];
	}
	
	public static function ServerSetting($row = '')
	{
		$res = mysql_fetch_array(mysql_query("SELECT * FROM server_settings LIMIT 1"));
		return $res[$row];
	}
	
	public static function CheckColumns($table = '', $column = '')
	{
		if(mysql_num_rows(mysql_query("SHOW COLUMNS FROM ".$table." LIKE '".$column."'")) == 1)
		return TRUE;
		else
		return FALSE;
	}
	
	public function MUS($command, $data = '')
	{
		$MUSdata = $command . chr(1) . $data;
		$socket = @socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
		@socket_connect($socket, $this->CmsSetting('client_ip'), $this->CmsSetting('client_mus'));
		@socket_send($socket, $MUSdata, strlen($MUSdata), MSG_DONTROUTE);	
		@socket_close($socket);
	}
	
	public function AddBan($type, $value, $reason, $expiretime, $mod)
	{
		$query = mysql_query("INSERT INTO bans (id,bantype,value,reason,expire,added_by,added_date,appeal_state) VALUES (NULL,'" . $type . "','" . $value . "','" . $reason . "','" . $expiretime . "','" . $mod . "','" . date('d/m/Y H:i') . "','0')");
	}
	
	public function Maintenance()
	{
		return($this->CmsSetting('maintenance') == 'true' ? true : false);
	}
}
?>