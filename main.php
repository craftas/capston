<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);
	$scale = 6;

	$userid = $_SESSION['userid'];
	$usernick = $_SESSION['usernick'];

	if ($mode=="search") {
		if(!$search) {
 			echo("
			<script>
			window.alert('�˻��� �ܾ �Է��� �ּ���!');
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

	//���� �޽��� ����
	$msgsql = "select * from message where r='$usernick' and confirm='n' ";
	$msgresult = mysql_query($msgsql);
	$msgrecord = mysql_num_rows($msgresult);

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);

	// ��ü ������ ��($total_page) ��� 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)
		$page = 1;
 
	// ǥ���� �������� ���� $start ���
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
        <input  id="search" name="search" value="<?=$search?>" type="text" placeholder="�˻��� �ܾ �Է��� �ּ���.">
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
            <?= $usernick ?>���� ���ɻ�
            <span class="pull-right" id="slide-submenu">
                <i class="glyphicon glyphicon-th-list"></i>
            </span>
        </span>
                <a onclick="window.open(this.href,'_blank','width=800px,height=500px,toolbars=no,scrollbars=no');return false;" href="message.php" class="list-group-item">
                    <i class="glyphicon glyphicon-envelope"></i> �޽���
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
		if($hobby[$i]=="�") {
?>
                <a href="main.php?category=�" class="list-group-item">
                    <i class="glyphicon glyphicon-tower"></i> �
                </a>
<?
		}
		elseif($hobby[$i]=="�м�") {
?>
                <a href="main.php?category=�м�" class="list-group-item">
                    <i class="glyphicon glyphicon-sunglasses"></i> �м�
                </a>
<?
		}
		elseif($hobby[$i]=="��ȭ") {
?>
                <a href="main.php?category=��ȭ" class="list-group-item">
                    <i class="glyphicon glyphicon-film"></i> ��ȭ
                </a>
<?
		}
		elseif($hobby[$i]=="����") {
?>
                <a href="main.php?category=����" class="list-group-item">
                    <i class="glyphicon glyphicon-music"></i> ����
                </a>
<?
		}
		elseif($hobby[$i]=="�丮") {
?>
                <a href="main.php?category=�丮" class="list-group-item">
                    <i class="glyphicon glyphicon-cutlery"></i> �丮
                </a>
<?
		}
		elseif($hobby[$i]=="���") {
?>
                <a href="main.php?category=���" class="list-group-item">
                    <i class="glyphicon glyphicon-wrench"></i> ���
                </a>
<?
		}
	}
?>
                <a onclick="window.open(this.href,'_blank','width=800px,height=650px,toolbars=no,scrollbars=no');return false;" href="write.php" class="list-group-item">
                    <i class="glyphicon glyphicon-pencil"></i> �۾���
                </a>
                <a href="logout.php" class="list-group-item">
                    <i class="glyphicon glyphicon-off"></i> �α׾ƿ�
                </a>
            </div>
        </div>
    </div>


      <div class="products-grid col-md-9">
        <div class="row">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
	mysql_data_seek($result, $i);     // ������ �̵�        
	$row = mysql_fetch_array($result);
?>

          <div class="well product-item col-xs-6 col-sm-4">
            <a href="#"><img src="holder.js/300x200/auto" alt="sample product" /></a>
            <h2><?=$row[subject]?></h2>
            <p>[<?=$row[category]?>] <?=$row[nick]?></p>
            <a class="btn btn-default btn-xs pull-right" href="read.php?no=<?=$row[no]?>">���뺸�� <i class="fa fa-arrow-circle-right"></i></a>
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
	<li><a href="main.php?page=<?=$page - 1?>"><span class="fa fa-chevron-left"></span>����</a></li>

<?
	}
	// �Խ��� ��� �ϴܿ� ������ ��ũ ��ȣ ���
	$first = 1 + 10 * floor($page / 11);

	if(($total_page-$first) >= 10)
		$last = 10;
	else
		$last = $total_page;
	for ($i=$first; $i<=$last; $i++)
	{
		if ($page == $i)     // ���� ������ ��ȣ ��ũ ����
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
              <li><a href="main.php?page=<?=$page + 1?>">���� <span class="fa fa-chevron-right"></span></a></li>
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