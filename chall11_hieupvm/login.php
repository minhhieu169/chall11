<?php 
    
    include_once(__DIR__.'\db\sqlFunction.php');

    session_start();
    if(isset($_SESSION['username'])){
        header("Location: admin.php");
    }
    
    $password = $username = '';
    if(!empty($_POST)){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($password != '' && $username != '') {
            $pwd = md5($password);
            $sql  = "select * from users where username = '$username' and password = '$pwd'";
            $data = executeSelect($sql);
            if ($data != null) {
                $_SESSION['username'] = $username;
                header('Location: admin.php');
            }else{
                ?>
                <script>alert("Wrong username or password")</script>
                <?php 
            }
        }
    }

    // Nếu vẫn còn lưu cookie trên trình duyệt thì sẽ chuyển đến trang home của user đó
    // if (isset($_COOKIE['login']) && $_COOKIE['login'] == 'true') {
    //     header('Location: home.php');
    //     die();
    // }
        // $token = md5(time().$data[0]['username']);
        //                 setcookie('token', $token, time()+24*60*60, '/');
    // Tạo cookie và log in 
    // else{
    //     $password = $username = '';
    //     if(!empty($_POST)){
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    //         if ($password != '' && $username != '') {
    //             $pwd = md5($password);
    //             $sql  = "select * from users where username = '$username' and password = '$pwd'";
    //             $data = executeSelect($sql);
    //             if ($data != null) {
    //                 $token = md5(time().$data[0]['username']);
    //                 setcookie('token', $token, time()+24*60*60, '/');

    //                 $sql = "update users set token = '$token' where user_id = " .$data[0]['user_id'];
    //                 execute($sql);
    //                 header('Location: home.php');
    //                 die();
    //             }
    //         }
    //     }
    // }

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Login Page</h1>
                </br>
            </div>
            <div class="panel-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="usr" class="form-label">User name: </label>
                        <input type="text" class="form-control" id="urs" required name="username" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password: </label>
                        <input type="password" class="form-control" id="pwd" required name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-success" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>