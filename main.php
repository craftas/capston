<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);
	$scale = 6;

	$userid = $_SESSION['userid'];
	$usernick = $_SESSION['usernick'];

	if ($mode=="search") {
		if(!$search) {
 			echo("
			<script>
			window.alert('검색할 단어를 입력해 주세요!');
			history.go(-1);
			</script>
			");
			exit;
		}
		$sql = "select * from list where subject like '%$search%' or content like '%$search%' order by no desc";
	}
	else {
		if($category)
			$sql = "select * from list where category='$category' order by no desc";
		else
			$sql = "select * from list order by no desc";
	}

	//받은 메시지 개수
	$msgsql = "select * from message where r='$usernick' and confirm='n' ";
	$msgresult = mysql_query($msgsql);
	$msgrecord = mysql_num_rows($msgresult);

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)
		$page = 1;
 
	// 표시할 페이지에 따라 $start 계산
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ANSI">
    <title>LIPA</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet" >
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>
<body>
<a href="main.php">
<img src=".\img\logo.png" width="400"/>
</a>
<div class="container">
    <form id="searchbox" method="post" action="main.php?mode=search">
        <input  id="search" name="search" value="<?=$search?>" type="text" placeholder="검색할 단어를 입력해 주세요.">
        <input id="submit" type="submit" value="Search">
    </form>

    <div class="col-md-3">
        <div class="sidebar">
            <div class="mini-submenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="list-group">
        <span href="#" class="list-group-item active">
            <?= $usernick ?>님의 관심사
            <span class="pull-right" id="slide-submenu">
                <i class="glyphicon glyphicon-th-list"></i>
            </span>
        </span>
                <a onclick="window.open(this.href,'_blank','width=800px,height=500px,toolbars=no,scrollbars=no');return false;" href="message.php" class="list-group-item">
                    <i class="glyphicon glyphicon-envelope"></i> 메시지
<?
	if ($msgrecord != 0) {
?>
	<span class="badge"><?= $msgrecord ?></span>
<?
	}
?>
                </a>
<?
	$info = mysql_fetch_array(mysql_query("select * from regist where id='$userid'"));

	$hobby = explode('/',$info[category]);
	$count = count($hobby);

	for($i=0;$i<=$count;$i++) {
		if($hobby[$i]=="운동") {
?>
                <a href="main.php?category=운동" class="list-group-item">
                    <i class="glyphicon glyphicon-tower"></i> 운동
                </a>
<?
		}
		elseif($hobby[$i]=="패션") {
?>
                <a href="main.php?category=패션" class="list-group-item">
                    <i class="glyphicon glyphicon-sunglasses"></i> 패션
                </a>
<?
		}
		elseif($hobby[$i]=="영화") {
?>
                <a href="main.php?category=영화" class="list-group-item">
                    <i class="glyphicon glyphicon-film"></i> 영화
                </a>
<?
		}
		elseif($hobby[$i]=="음악") {
?>
                <a href="main.php?category=음악" class="list-group-item">
                    <i class="glyphicon glyphicon-music"></i> 음악
                </a>
<?
		}
		elseif($hobby[$i]=="요리") {
?>
                <a href="main.php?category=요리" class="list-group-item">
                    <i class="glyphicon glyphicon-cutlery"></i> 요리
                </a>
<?
		}
		elseif($hobby[$i]=="기계") {
?>
                <a href="main.php?category=기계" class="list-group-item">
                    <i class="glyphicon glyphicon-wrench"></i> 기계
                </a>
<?
		}
	}
?>
                <a onclick="window.open(this.href,'_blank','width=800px,height=650px,toolbars=no,scrollbars=no');return false;" href="write.php" class="list-group-item">
                    <i class="glyphicon glyphicon-pencil"></i> 글쓰기
                </a>
                <a href="logout.php" class="list-group-item">
                    <i class="glyphicon glyphicon-off"></i> 로그아웃
                </a>
            </div>
        </div>
    </div>


      <div class="products-grid col-md-9">
        <div class="row">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
	mysql_data_seek($result, $i);     // 포인터 이동        
	$row = mysql_fetch_array($result);
?>

          <div class="well product-item col-xs-6 col-sm-4">
            <a href="#"><img src="holder.js/300x200/auto" alt="sample product" /></a>
            <h2><?=$row[subject]?></h2>
            <p>[<?=$row[category]?>] <?=$row[nick]?></p>
            <a class="btn btn-default btn-xs pull-right" href="read.php?no=<?=$row[no]?>">내용보기 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
<?
			$number--;
	}
?>

        </div>
        <div calss="row pagination-wrap">
            <ul class="pagination">
<?
	if($page != 1) {
?>
	<li><a href="main.php?page=<?=$page - 1?>"><span class="fa fa-chevron-left"></span>이전</a></li>

<?
	}
	// 게시판 목록 하단에 페이지 링크 번호 출력
	$first = 1 + 10 * floor($page / 11);

	if(($total_page-$first) >= 10)
		$last = 10;
	else
		$last = $total_page;
	for ($i=$first; $i<=$last; $i++)
	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><a href='#'><font color='red'>$i</font></a></li>";
		}
		else
		{
			echo "<li><a href='main.php?page=$i'>$i</a></li>";
		}
	}
	if($page < $total_page) {
?>
              <li><a href="main.php?page=<?=$page + 1?>">다음 <span class="fa fa-chevron-right"></span></a></li>
<?
	}
?>
            </ul>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/holder.js"></script>
</body>
</html>