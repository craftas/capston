<?
	session_start();
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);
	$userid = $_SESSION['userid'];
	$usernick = $_SESSION['usernick'];

	if(!$image) {
		$imageblob = null;
	}
	else {
		$size = GetImageSize($image);
		$width = $size[0];
		$height = $size[1];
		$imageblob = addslashes(fread(fopen($image, "r"), filesize($image)));
	}

	$sql = "insert into list values('','$userid','$usernick','$subject','$content','$category','$imageblob','$width','$height',now())";

	if(!$userid) {
		echo "
			<script>
			window.alert('�α��� �� �̿� �����մϴ�!')
			history.go(-1)
			</script>
		";
	}
	elseif(!$subject || !$content) {
		echo "
			<script>
			window.alert('����� ������ �ʼ� �Է»����Դϴ�!')
			history.go(-1)
			</script>
		";
	}
	elseif($category == "�����ϼ���") {
		echo "
			<script>
			window.alert('ī�װ��� �������ּ���!')
			history.go(-1)
			</script>
		";
	}
	else {
		mysql_query($sql);
		echo "
			<script>
			window.alert('�Խù��� ���������� �ۼ��Ǿ����ϴ�!')
			window.close()
			</script>
		";
	}
	mysql_close($connect);
?>