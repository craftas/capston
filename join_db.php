<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);

	$category = join('/',$_POST['hobby']);

	$query_id = "select id from regist";
	$result_id = mysql_query($query_id);
	$sql = "insert into regist values('$id','$password','$nick','$tel','$category',now())";

	if(!$id || !$password || !$nick || !$tel) {
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
			window.alert('$nick님의 가입을 축하드립니다! 가입하신 정보로 다시 로그인 해주세요')
			location.href='index.html';
			</script>
		");
		exit;
	}
?>