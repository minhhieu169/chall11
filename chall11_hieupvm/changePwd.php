<?php 
    include_once(__DIR__.'\db\sqlFunction.php');
    session_start();
    $cur_pwd = $old_pwd = $re_pwd = $new_pwd = $username = ''; 

    if(!empty($_POST)){
        $username = $_SESSION['username'];
        $sql = 'SELECT * FROM users where username = "'.$username.'";';
        $userList = executeSelect($sql);
        $user = $userList[0];
        $cur_pwd = $user['password'];
        $old_pwd = md5($_POST['oldpwd']);
        $new_pwd = md5($_POST['newpwd']);
        $re_pwd = md5($_POST['repwd']);
        if($cur_pwd != $old_pwd){
            ?>
            <script>alert("Wrong password");</script>
            <?php
        }
        else if($new_pwd != $re_pwd){
            ?>
            <script>alert("Retype password does not match");</script>
            <?php
        }
        else{
            $sql = 'UPDATE users SET password = "'.$new_pwd.'" WHERE username = "'.$username.'";';
            execute($sql);
            header("Location: profile.php");
        }
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
                <a href="admin.php"><button class="btn btn-success">Home</button></a>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Change password</h1>
                </br>
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Current password: </label>
                        <input type="password" class="form-control" name="oldpwd" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New password: </label>
                        <input type="password" class="form-control" name="newpwd" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Retype new password: </label>
                        <input type="password" class="form-control" name="repwd" required>
                    </div>
                    <button type="submit" class="btn btn-success">Change</button>
                </form>
            </div>
        </div>
</div>

</body>
</html>