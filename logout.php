<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);

	$_SESSION['userid']=NULL;
	$_SESSION['userpassword']=NULL;
	$_SESSION['usernick']=NULL;
	$_SESSION['usertel']=NULL;

	echo "
		<script>
		window.alert('���������� �α׾ƿ� �Ǿ����ϴ�')
		location.href='index.html'
		</script>
	";
?>