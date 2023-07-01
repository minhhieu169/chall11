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


    $id = $fullname = $username = $password = $email = $phonenumber = $role = $avatar =  '';
    $id = '';
    $done = 0;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = 'SELECT * FROM users where user_id = '.$id;
        $userList = executeSelect($sql);
        $user = $userList[0];
        $full_name = $user['full_name']; 
        $user_name = $user['username']; 
        $email = $user['email']; 
        $avatar = $user['avatar'];
        $phone_number = $user['phone_number']; 
        $role_id = $user['role_id']; 
        if(!empty($_POST)){
            $email = $_POST['email'];
            $phone_number = $_POST['phone-number'];
            $sql = 'UPDATE users SET email = "'.$email.'", phone_number = "'.$phone_number.'" WHERE user_id = '.$id.';';
            execute($sql);
            header("Location: listUser.php");
        }
    }else{
        $id = '';
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
            <div style="float: right; margin-top: 27px;">
                <img src="<?php echo $avatar_session;?>" alt="avatar" width="40px" height="40px">
                <a href="profile.php"><button class="btn btn-success">Profile</button></a>
                <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Edit information</h1>
                </br>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <img src="<?php echo $avatar;?>" alt="avatar" width="200px" height="200px" style="border-radius:50%; margin: auto; display: block;">
                    </div>  
                    <div class="mb-3">
                        <label for="usr" class="form-label">User name: </label>
                        <input type="text" class="form-control" name="urs" require="true" value="<?=$user_name?>" disabled="disabled">
                    </div>
                    <div class="mb-3">
                        <label for="full-name" class="form-label">Full name: </label>
                        <input type="text" class="form-control" name="full-name" require="true" value="<?=$full_name?>" disabled="disabled">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address: </label>
                        <input type="email" class="form-control" name="email" require="true" value="<?=$email?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone-number" class="form-label">Phone number: </label>
                        <input type="tel" class="form-control" name="phone-number" require="true" value="<?=$phone_number?>">
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-success" type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
</div>
</body>
</html>