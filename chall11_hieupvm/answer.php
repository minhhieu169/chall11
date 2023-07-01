<?php 
    include_once(__DIR__.'\db\sqlFunction.php');
    include_once('utility.php');
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    $username_session = $_SESSION['username'];
    $sql = 'SELECT * FROM users where username = "'.$username_session.'";';
    $userList_session = executeSelect($sql);
    $user_session = $userList_session[0];
    $avatar_session = $user_session['avatar'];

    $title = $hint = $path = '';

    $result = '';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM challenger where challenger_id = '.$id;
        $chalList = executeSelect($sql);
        $chal = $chalList[0];
        $title = $chal['title'];
        $hint = $chal['hint'];
        $path = $chal['path'];

        $testVar = explode(".", $path);
        $result = $testVar[0];
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
        <div class="mb-3">
            <div style="float: left; margin-top: 27px;">
                <a href="challenger.php"><button class="btn btn-success">Back</button></a>
            </div>
            <div style="float: right; margin-top: 27px;">
                <img src="<?php echo $avatar_session;?>" alt="avatar" width="40px" height="40px">
                <a href="profile.php"><button class="btn btn-success">Profile</button></a>
                <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Answer the question</h1>
                </br>
            </div>
            <div class="panel-body">
                <form method="post" action="">  
                    <div class="mb-3">
                        <h1><small>Title:  </small><strong><?=$title?></strong></h1>
                    </div>
                    <div class="mb-3">
                        <label for="hint" class="form-label">HINT: </label>
                        <br/>
                        <textarea rows="5" cols="90" disabled><?=$hint?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ans">Enter: </label>
                        <input type="text" class="form-control" name="ans">
                    </div>
                    <br/>
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" value="Answer" name="submit">
                    </div>
                </form>
            </div>
            <div style="text-alight: center;">
            <?php  
                if(isset($_POST['submit'])){
                    $ans = trim($_POST['ans'], ' ');
                    if($ans == $result) {
                        $filename = 'uploads/challenger/'.$path;
                        $fp = fopen($filename, "r");
             
                        $contents = fread($fp, filesize($filename));
             
                        echo "<pre>$contents</pre>";
                        fclose($fp);
                    }else{
                        ?>
                        <script>alert("Wrong answer!!!");</script>
                        <?php
                    }
                }
            ?>
            </div>
        </div>
</div>
</body>
</html>