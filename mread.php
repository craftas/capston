<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server에 연결할 수 없습니다."); 

	mysql_select_db("lipa_db",$connect);
	$usernick = $_SESSION['usernick'];

	$info = mysql_fetch_array(mysql_query("select * from message where no=$no"));

	mysql_query("update message set confirm='y' where no=$no and r='$usernick'");
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

<div class="panel panel-primary col-md-8">
    <div class="panel-heading">
        <h3 class="panel-title"><?=$info[subject]?></h3>
        <ul>
            <span class="glyphicon glyphicon-user"><?=$info[s]?>→<?=$info[r]?>&nbsp;</span>
            <span class="glyphicon glyphicon-time"><?=$info[date]?></span>
        </ul>
    </div>

    <div class="panel-body">
        <div class="col-md-1">
        </div>
        <div class="col-md-10 text-left">
            <?=$info[content]?>
        </div>
        <div class="col-md-1">
        </div>
    </div>

    <div class="panel-footer">
<?
	if($info[r] == $usernick) {
        	echo "<a href='mwrite.php?nick=$info[s]' class='btn btn-primary'>답장</a>";
	}
	if($info[s] == $usernick)
		$mode='s';
	else
		$mode='r';
?>
        <a href="message.php?mode=<?=$mode?>&page=1" class="btn btn-default">목록</a>
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