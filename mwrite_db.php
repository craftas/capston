<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);

	$usernick = $_SESSION['usernick'];

	$sql = "insert into message values('','$usernick','$r','$subject','$content',now(),'n')";

	if(!$r || !$subject || !$content) {
		echo("
			<script>
			window.alert('��� �׸��� �ʼ� �Է»����Դϴ�!')
			history.go(-1)
			</script>
		");
		exit;
	}
	else {
		mysql_query($sql);
		echo("
			<script>
			window.alert('�޽����� ���������� ó���Ǿ����ϴ�')
			location.href='message.php';
			</script>
		");
		exit;
	}
?>