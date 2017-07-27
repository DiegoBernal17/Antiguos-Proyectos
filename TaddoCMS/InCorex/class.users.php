<?php
class Users
{
	public function ValidName($u_name = '')
	{
		if(preg_match('/^[a-zA-Z0-9._:,-]+$/i', $u_name) && !preg_match('/mod-/i', $u_name))
		return true;
		else
		return false;
	}
	
	public function NameTaken($u_name = '')
	{
		return (mysql_num_rows(mysql_query("SELECT * FROM users WHERE username = '".$u_name."'")) > 0  ? true : false);
	}
	
	public function ValidMail($mail = '')
	{
		return preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $mail);
	}
	
	public function MailTaken($mail = '')
	{
		return (mysql_num_rows(mysql_query("SELECT * FROM users WHERE mail = '".$mail."' LIMIT 1")) > 0  ? true : false);
	}
	
	public function UserID($u_name = '')
	{
		$query = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '".$u_name."' LIMIT 1"));
		return $query['id'];
	}
	
	public function UserName($id = '')
	{
		$query = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".$id."' LIMIT 1"));
		return $query['username'];
	}
	
	public function UserRank($u_name = '')
	{
		$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '".$u_name."' LIMIT 1"));
		return $user['rank'];
	}
	
	public function RankName($id = '')
	{
		$rank = mysql_fetch_array(mysql_query("SELECT * FROM ranks WHERE id = '".$id."' LIMIT 1"));
		return $rank['name'];
	}

	public function RankBadge($id = '')
	{
		$rank = mysql_fetch_array(mysql_query("SELECT * FROM ranks WHERE id = '".$id."' LIMIT 1"));
		return $rank['badgeid'];
	}
	
	public function UserInfo($u_name = '', $row = '')
	{
		$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '".$u_name."' LIMIT 1"));
		return $user[$row];
	}
	
	public function UserInfoByID($id = '', $row = '')
	{
		$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '".$id."' LIMIT 1"));
		return $user[$row];
	}
	
	public function UserInfoSum($row = '', $mail = '')
	{
		$info = mysql_fetch_row(mysql_query("SELECT SUM(".$row.") FROM users WHERE mail = '".$mail."'"));
		return $info[0];
	}
	
	public function UserInfoMax($row = '', $mail = '')
	{
		$info = mysql_fetch_row(mysql_query("SELECT MAX(".$row.") FROM users WHERE mail = '".$mail."'"));
		return $info[0];
	}
	
	public function AddUser($username = '', $password = '', $mail = '', $figure = '', $motto = '')
	{
		mysql_query("INSERT INTO users (username, password, mail, look, motto, account_created, last_online, ip_last, ip_reg, auth_ticket) VALUES ('".$username."', '".$password."', '".$mail."', '".$figure."', '".$motto."', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_ADDR']."', '')");
		$user_id = mysql_insert_id();
		mysql_query("INSERT INTO user_stats (id, RoomVisits, OnlineTime, Respect, RespectGiven, GiftsGiven, GiftsReceived, DailyRespectPoints, DailyPetRespectPoints) VALUES ('".$user_id."', 0, 0, 0, 0, 0, 0, 3, 3)");
		mysql_query("INSERT INTO user_info (user_id, bans, cautions, reg_timestamp, login_timestamp, cfhs, cfhs_abusive) VALUES ('".$user_id."', '0', '0', UNIX_TIMESTAMP(), '0', '0', '0')");
	}
	
	public function UserPermission($permission = '', $u_name = '')
	{
		if($this->NameTaken($u_name))
		{
			$permission_rank = mysql_fetch_array(mysql_query("SELECT * FROM permissions_ranks WHERE rank = '".$this->UserRank($u_name)."' LIMIT 1"));
			$permission_users = mysql_fetch_array(mysql_query("SELECT * FROM permissions_users WHERE userid = '".$this->UserID($u_name)."' LIMIT 1"));
			if($permission_rank[$permission] == "1" || $permission_users[$permission] == "1")
			return true;
			else
			return false;
		}
		else
		return false;
	}
	
	public static function CheckBan($u_name = '')
	{
		$check_ban = mysql_query("SELECT * FROM bans WHERE (value = '".$_SERVER['REMOTE_ADDR']."' OR value ='".$u_name."') AND expire > UNIX_TIMESTAMP() LIMIT 1");
		if(mysql_num_rows($check_ban) > 0)
		{
			return true;
		}
	}
	
	public static function BanInfo($u_name = '')
	{
		$check_ban = mysql_query("SELECT * FROM bans WHERE (value = '".$_SERVER['REMOTE_ADDR']."' OR value ='".$u_name."') AND expire > UNIX_TIMESTAMP() LIMIT 1");
		if(mysql_num_rows($check_ban) > 0)
		{
		$ban = mysql_fetch_array($check_ban);
		session_destroy();
		if($ban['bantype'] == 'ip')
		{
			return "Location: index.php?error=ban&ip=".$ban['value'];
		}
		elseif($ban['bantype'] == 'user')
		{
			return "Location: index.php?error=ban&user=".$u_name;
		}
		}
	}
}
?>