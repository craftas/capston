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

<form role="form" method="post" action="mwrite_db.php">
<div class="panel panel-default col-md-8">
    <div class="panel-body">
    <table class="table">
        <tbody>
            <tr><!--받는사람-->
                <th>
                    <span class="glyphicon glyphicon-user">받는사람</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">받는사람</label>
                    </p>
                    <div>
                        <input type="text" name="r" class="col-md-12" value="<?=$nick?>">
                    </div>
                </td>
            </tr>
            <tr><!--제목-->
                <th>
                    <span class="glyphicon glyphicon-user">제목</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">제목</label>
                    </p>
                    <div>
                        <input type="text" name="subject" class="col-md-12">
                    </div>
                </td>
            </tr>
            <tr> <!--내용-->
                <th>
                    <span class="glyphicon glyphicon-pencil">내용</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">내용</label>
                    </p>
                    <div>
                        <textarea class="form-control" name="content" rows="7"></textarea>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
    </div>
    <div class="btn_confirm panel-footer text-center">
        <input type="submit" value="보내기" class="btn_submit btn btn-success">
        <a href="message.php" class="btn btn-danger">작성취소</a>
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