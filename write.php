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
            <tr> <!--카테고리-->
                <th>
                    <span class="glyphicon glyphicon-th-list">카테고리</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">카테고리</label>
                    </p>
                    <select class="form-control" name="category">
                        <option>선택하세요</option>
                        <option>운동</option>
                        <option>패션</option>
                        <option>영화</option>
                        <option>음악</option>
                        <option>요리</option>
                        <option>기계</option>
                    </select>
                </td>
            </tr>

            <tr> <!--제목-->
                <th>
                    <span class="glyphicon glyphicon-blackboard">제목</span>
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
                        <textarea class="form-control" rows="10" name="content"></textarea>
                    </div>
                </td>
            </tr>

            <tr> <!--사진첨부-->
                <th>
                    <span class="glyphicon glyphicon-camera">사진</span>
                </th>
                <td>
                    <p>
                        <label class="sr-only">사진</label>
                    </p>
                    <input type="file" name="image">
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="btn_confirm panel-footer text-center">
        <input type="submit" value="작성완료" class="btn_submit btn btn-success">
        <a href="#" onclick="javascript:self.close();" class="btn_cancel btn btn-danger">취소</a>
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