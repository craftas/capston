<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);

	$_SESSION['userid']=NULL;
	$_SESSION['userpassword']=NULL;
	$_SESSION['usernick']=NULL;
	$_SESSION['usertel']=NULL;

	echo "
		<script>
		window.alert('정상적으로 로그아웃 되었습니다')
		location.href='index.html'
		</script>
	";
?>