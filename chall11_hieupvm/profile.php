<?php 
    include_once(__DIR__.'\db\sqlFunction.php');
    session_start();
    $id = $fullname = $username = $password = $email = $phonenumber = $role = $avatar = '';
    $username = $_SESSION['username'];
    if(!isset($username)){
        header("Location: login.php");
    }
    $sql = 'SELECT * FROM users where username = "'.$username.'";';
    $userList = executeSelect($sql);
    $user = $userList[0];
    $id = $user['user_id'];
    $fullname = $user['full_name'];  
    $email = $user['email']; 
    $phonenumber = $user['phone_number']; 
    $role = $user['role_id'];
    $avatar = $user['avatar'];
    if(!empty($_POST)){
        $email = $_POST['email'];
        $phone_number = $_POST['phone-number'];
        $avatar = $_POST['avatar'];
        $sql = 'UPDATE users SET email = "'.$email.'", phone_number = "'.$phone_number.'", avatar = "'.$avatar.'" WHERE user_id = '.$id.';';
        execute($sql);
        header("Location: profile.php");
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
                <img src="<?php echo $avatar; ?>" alt="avatar" width="40px" height="40px">
                <a href="profile.php"><button class="btn btn-success">Profile</button></a>
                <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Profile</h1>
                </br>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <img src="<?php echo $avatar; ?>" alt="avatar" width="200px" height="200px" style="border-radius:50%; margin: auto; display: block;">
                    </div>  
                    <div class="mb-3">
                        <label for="usr" class="form-label">User name: </label>
                        <input type="text" class="form-control" name="urs" value="<?php echo $username;?>" disabled>
                    </div>
                    <div class="mb-3">
                        <!-- <input type="password" class="form-control" name="pwd" value="<?php echo $password;?>"> -->
                        <a href="changePwd.php" class="link-success">Change Password</a>
                    </div>
                    <div class="mb-3">
                        <label for="full-name" class="form-label">Full name: </label>
                        <input type="text" class="form-control" name="full-name" value="<?php echo $fullname;?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address: </label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone-number" class="form-label">Phone number: </label>
                        <input type="tel" class="form-control" name="phone-number" value="<?php echo $phonenumber;?>">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">ROLE: </label>
                        <input type="selection" class="form-control" name="role" disabled value="<?php if($role == 1 ){echo "Student";} else{ echo "Teacher";} ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image-path" class="form-label">Image path: </label>
                        <input type="text" name="avatar" class="form-control" id="image-path" value="<?php echo $avatar; ?>">
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