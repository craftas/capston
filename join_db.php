<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);

	$category = join('/',$_POST['hobby']);

	$query_id = "select id from regist";
	$result_id = mysql_query($query_id);
	$sql = "insert into regist values('$id','$password','$nick','$tel','$category',now())";

	if(!$id || !$password || !$nick || !$tel) {
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
			window.alert('$nick���� ������ ���ϵ帳�ϴ�! �����Ͻ� ������ �ٽ� �α��� ���ּ���')
			location.href='index.html';
			</script>
		");
		exit;
	}
?>