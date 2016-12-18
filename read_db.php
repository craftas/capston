<?
	session_start();
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);
	$userid = $_SESSION['userid'];
	$usernick = $_SESSION['usernick'];
	$no = $_SESSION['no'];

	$sql = "insert into ripple values($no,'$userid','$usernick','$content',now())";

	mysql_query($sql);
	echo "
		<script>
		history.go(-1) 
		</script>
	";
	mysql_close($connect);
?>