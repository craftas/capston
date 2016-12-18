<?
	session_start();
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

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
			window.alert('로그인 후 이용 가능합니다!')
			history.go(-1)
			</script>
		";
	}
	elseif(!$subject || !$content) {
		echo "
			<script>
			window.alert('제목과 내용은 필수 입력사항입니다!')
			history.go(-1)
			</script>
		";
	}
	elseif($category == "선택하세요") {
		echo "
			<script>
			window.alert('카테고리를 선택해주세요!')
			history.go(-1)
			</script>
		";
	}
	else {
		mysql_query($sql);
		echo "
			<script>
			window.alert('게시물이 정상적으로 작성되었습니다!')
			window.close()
			</script>
		";
	}
	mysql_close($connect);
?>