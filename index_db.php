<?
	session_start();
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);

	$sql = "select * from regist where id='$id' and password='$password' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	if(!$id || !$password) {
		echo "
			<script>
			window.alert('���̵�� ��й�ȣ�� �Է����ּ���!')
			history.go(-1)
			</script>
		";
	}
	elseif($row[id]!=$id || $row[password]!=$password) {
		echo "
			<script>
			window.alert('���̵�� ��й�ȣ�� Ȯ�����ּ���!')
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
			window.alert('$row[nick]�� ȯ���մϴ�')
			location.href='main.php'
			</script>
		";
	}
	mysql_close($connect);
?>