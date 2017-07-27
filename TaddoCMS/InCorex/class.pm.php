<?php
class Pm
{
	public static function WordFilter($str = '')
	{
		$wordfilterq = mysql_query("SELECT * FROM wordfilter");
		while($row = mysql_fetch_array($wordfilterq)){
		$str=preg_replace("/".$row['word']."/i",$row['replacement'],$str);
		}
    return $str;
	}
	
	public static function GetPm($id)
	{
		$pmq = mysql_query("SELECT * FROM cms_pm WHERE id = '".$id."' LIMIT 1");
		$pm = mysql_fetch_array($pmq);
	}
	
	public static function FriendList($id)
	{
		$friendsq = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$id."'");
		$friends = mysql_fetch_array($friendsq);
	}
	
	public static function NewPM($id)
	{
		$newpm = mysql_query("SELECT * FROM cms_pm WHERE toid=".$id." AND folder='inbox' AND `read`='0'");
		$num_rows = mysql_num_rows($newpm);
		return intval($num_rows);
	}
	
	public static function ReportedPM()
	{
		$reportedpm = mysql_query("SELECT * FROM cms_pm_report WHERE solved='0'");
		$num_rows = mysql_num_rows($reportedpm);
		return intval($num_rows);
	}
	
	
}
?>