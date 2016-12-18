<?
	session_start();
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);

	$sql = "select * from regist where id='$id' and password='$password' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if(!$id || !$password) {
		echo "
			<script>
			window.alert('아이디와 비밀번호를 입력해주세요!')
			history.go(-1)
			</script>
		";
	}
	elseif($row[id]!=$id || $row[password]!=$password) {
		echo "
			<script>
			window.alert('아이디와 비밀번호를 확인해주세요!')
			history.go(-1)
			</script>
		";
	}
	else {
		$_SESSION['userid']=$row[id];
		$_SESSION['userpassword']=$row[password];
		$_SESSION['usernick']=$row[nick];
		$_SESSION['usertel']=$row[tel];

		echo "
			<script>
			window.alert('$row[nick]님 환영합니다')
			location.href='main.php'
			</script>
		";
	}
	mysql_close($connect);
?>