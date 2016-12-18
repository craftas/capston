<?=session_start();?>
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
<body onresize="parent.resizeTo(800,650)" onload="parent.resizeTo(800,650)">

<form role="form" method="post" action="write_db.php">
<div class="panel panel-default col-md-8">
    <div class="panel-body">
    <table class="table">
        <tbody>
            <tr> <!--ī�װ�-->
                <th>
                    <span class="glyphicon glyphicon-th-list">ī�װ�</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">ī�װ�</label>
                    </p>
                    <select class="form-control" name="category">
                        <option>�����ϼ���</option>
                        <option>�</option>
                        <option>�м�</option>
                        <option>��ȭ</option>
                        <option>����</option>
                        <option>�丮</option>
                        <option>���</option>
                    </select>
                </td>
            </tr>

            <tr> <!--����-->
                <th>
                    <span class="glyphicon glyphicon-blackboard">����</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">����</label>
                    </p>
                    <div>
                        <input type="text" name="subject" class="col-md-12">
                    </div>
                </td>
            </tr>

            <tr> <!--����-->
                <th>
                    <span class="glyphicon glyphicon-pencil">����</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">����</label>
                    </p>
                    <div>
                        <textarea class="form-control" rows="10" name="content"></textarea>
                    </div>
                </td>
            </tr>

            <tr> <!--����÷��-->
                <th>
                    <span class="glyphicon glyphicon-camera">����</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">����</label>
                    </p>
                    <input type="file" name="image">
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="btn_confirm panel-footer text-center">
        <input type="submit" value="�ۼ��Ϸ�" class="btn_submit btn btn-success">
        <a href="#" onclick="javascript:self.close();" class="btn_cancel btn btn-danger">���</a>
    </div>
</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/holder.js"></script>
</body>
</html>