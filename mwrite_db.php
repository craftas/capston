<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);

	$usernick = $_SESSION['usernick'];

	$sql = "insert into message values('','$usernick','$r','$subject','$content',now(),'n')";

	if(!$r || !$subject || !$content) {
		echo("
			<script>
			window.alert('모든 항목은 필수 입력사항입니다!')
			history.go(-1)
			</script>
		");
		exit;
	}
	else {
		mysql_query($sql);
		echo("
			<script>
			window.alert('메시지가 정상적으로 처리되었습니다')
			location.href='message.php';
			</script>
		");
		exit;
	}
?>