<?
	extract(array_merge($HTTP_GET_VARS, $HTTP_POST_VARS));
	session_start();
	$connect=mysql_connect( "localhost", "root", "apmsetup") or  
	die( "SQL server�� ������ �� �����ϴ�."); 

	mysql_select_db("lipa_db",$connect);
	$scale = 5;
	$usernick = $_SESSION['usernick'];

	if(!$mode)
		$mode = 'r';

	if($mode == 'r')
		$sql = "select * from message where r='$usernick' order by date desc";
	else
		$sql = "select * from message where s='$usernick' order by date desc";

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);

	// ��ü ������ ��($total_page) ��� 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 

	if (!$page)
		$page = 1;
 
	// ǥ���� ������($page)�� ���� $start ���  
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
<body onresize="parent.resizeTo(800,500)" onload="parent.resizeTo(800,500)">



<div class="panel panel-default col-md-8">
<ul class="nav nav-tabs">
<?
	if($mode == 'r') {
?>
		<li class="active"><a href="#">�����޼���</a></li>
		<li><a href="message.php?mode=s&page=1">�����޼���</a></li>
<?
	}
	else {
?>
		<li><a href="message.php?mode=r&page=1">�����޼���</a></li>
		<li class="active"><a href="#">�����޼���</a></li>
<?
	}
?>
</ul>
    
    <div class="pannel-body">
    <table class="table table-hover">
        <colgroup>
        <col class="col-md-2">
        <col class="col-md-7">
        <col class="col-md-3">
<?
	if($mode == 's') {
?>
        <col class="col-md-2">
<?
	}
?>
        </colgroup>

        <thead>
            <tr class="active">
                <th>�г���</th>
                <th>����</th>
                <th>��¥</th>
<?
	if($mode == 's') {
?>
                <th>Ȯ��</th>
<?
	}
?>
            </tr>
        </thead>

        <tbody>
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
	mysql_data_seek($result, $i);     // ������ �̵�        
	$row = mysql_fetch_array($result); // �ϳ��� ���ڵ� ��������

	$date = date("Y�� n�� j�� G:i:s", strtotime($row[date].""));

?>
            <tr>
<?
	if($mode == 'r')
		echo "<td>$row[s]</td>";
	else
		echo "<td>$row[r]</td>";
?>
                <td><a href="mread.php?no=<?=$row[no]?>"><?=$row[subject]?>
<?
	if($row[confirm]=='n' && $mode=='r')
		echo "&nbsp;<span class='badge'>N</span>";
?>
</a></td>
                <td><?=$date?></td>
<?
	if($mode == 's') {
?>
                <td><?=$row[confirm]?></td>
<?
	}
?>
            </tr>
<?
	$number--;
   }

?>
        </tbody>
    </table>
    <div calss="row pagination-wrap">
            <ul class="pagination">
<?
	if($page != 1) {
?>
	<li><a href="message.php?mode=$mode&page=<?=$page - 1?>"><span class="fa fa-chevron-left"></span>����</a></li>

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
			echo "<li><a href='message.php?mode=$mode&page=$i'>$i</a></li>";
		}
	}
	if($page < $total_page) {
?>
              <li><a href="message.php?mode=$mode&page=<?=$page + 1?>">���� <span class="fa fa-chevron-right"></span></a></li>
<?
	}
?>
            </ul>
        </div>
    </div>
    <div class="btn_confirm panel-footer text-center">
        <a href="mwrite.php" class="btn btn-primary">�޼����ۼ�</a>
        <input type="button" value="�ݱ�" onclick="self.close()" class="btn_cancel btn btn-danger">
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