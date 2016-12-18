<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);
	$scale = 6;

	$userid = $_SESSION['userid'];
	$usernick = $_SESSION['usernick'];
	$_SESSION['no'] = $no;

	//받은 메시지 개수
	$msgsql = "select * from message where r='$usernick' and confirm='n' ";
	$msgresult = mysql_query($msgsql);
	$msgrecord = mysql_num_rows($msgresult);

	//선택한 글 보기
	$info = mysql_fetch_array(mysql_query("select * from list where no=$no"));

	$sql = "select * from ripple where no=$no order by date";
	$result = mysql_query($sql);
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
    <title>SNS</title>
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
    <form id="searchbox">
        <input  id="search" type="text" placeholder="검색할 단어를 입력해 주세요.">
        <input id="submit" type="submit" value="Search">
    </form>

    <div class="col-md-2">
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
                <a href="sports.html" class="list-group-item">
                    <i class="glyphicon glyphicon-tower"></i> 운동
                </a>
                <a href="fashion.html" class="list-group-item">
                    <i class="glyphicon glyphicon-sunglasses"></i> 패션
                </a>
                <a href="movie.html" class="list-group-item">
                    <i class="glyphicon glyphicon-film"></i> 영화
                </a>
                <a href="music.html" class="list-group-item">
                    <i class="glyphicon glyphicon-music"></i> 음악
                </a>
                <a href="machine.html" class="list-group-item">
                    <i class="glyphicon glyphicon-cutlery"></i> 요리
                </a>
                <a href="machine.html" class="list-group-item">
                    <i class="glyphicon glyphicon-wrench"></i> 기계
                </a>
                <a onclick="window.open(this.href,'_blank','width=800px,height=560px,toolbars=no,scrollbars=no');return false;" href="write.php" class="list-group-item">
                    <i class="glyphicon glyphicon-pencil"></i> 글쓰기
                </a>
                <a href="logout.php" class="list-group-item">
                    <i class="glyphicon glyphicon-off"></i> 로그아웃
                </a>
            </div>
        </div>
    </div>



    <div class="panel panel-primary col-md-10">
        <div class="panel-heading">
            <h3 class="panel-title"><?=$info[subject]?></h3>
            <ul>
                <span class="glyphicon glyphicon-user"><?=$info[nick]?>&nbsp;</span>
                <span class="glyphicon glyphicon-time"><?=$info[date]?>&nbsp;</span>
                <span class="glyphicon glyphicon-tag">댓글 <?=$total_record?>개</span>
            </ul>
        </div>

        <div class="panel-body">
            <div class="text-left">
                <?=$info[content]?>
            </div>

            <div class="row h1"><p class="hidden">한줄간격주기</p></div>

            <div class="col-xs-12 well">	
                <h2 class="sr-only">댓글목록</h2>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
<?
	if($total_record == 0) {
		echo "<p>등록된 댓글이 없습니다.</p>";
	}
	else {
		for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
			mysql_data_seek($result, $i);     // 포인터 이동        
			$row = mysql_fetch_array($result);
			echo "<p>$row[nick] | $row[content] | $row[date]</p>";
		}
	}
?>

                    </div>
                </div>

                <div class="col-xs-12">
                    <h2 class="sr-only">댓글쓰기</h2>
                        <form role="form" method="post" action="read_db.php">
                            <div class="panel panel-default">
		                    <div class="panel-body">
			                    <table class="table">
			                        <tbody>
								        <tr>
				                            <th scope="row" class="w120 hidden-xs">
                                                <label class="control-label">내용</label>
                                            </th>
                                            <td>
					                            <p class="hidden visible-xs">
                                                    <label class="control-label">내용</label>
                                                </p>
										        <textarea class="required form-control" title="내용" name="content"></textarea>
				                            </td>
			                            </tr>
			                        </tbody>
			                    </table>
		                    </div>
                            <div class="btn_confirm panel-footer text-center">
			                    <input type="submit" class="btn_submit btn btn-danger" value="댓글등록">
		                    </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="panel-footer">
            <a href="main.php" class="btn btn-default">목록</a>
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