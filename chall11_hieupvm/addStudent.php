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

    $full_name = $username = $password = $email = $phonenumber = $role = '';
    if (!empty($_POST)) {
        $username = $_POST['username'];
        $full_name = $_POST['full_name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber']; 
        $role  = $_POST['role'];

        if ($full_name != '' && $password != '' && $email != '' && $username != '' && $phonenumber != '' && $role != '') {
            //save user into database
            $password = md5($password);
            $sql = "insert into users (full_name, username, password, email, phone_number, avatar, role_id) values ('$full_name','$username' , '$password', '$email', '$phonenumber', 'avatardefault.jpg','$role')";
            execute($sql);
            header('Location: listUser.php');
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
</br>
<div class="container">
        <div class="mb-3">
            <div style="float: left; margin-top: 27px;">
                <a href="listUser.php"><button class="btn btn-success">Back</button></a>
            </div>
            <div style="float: right; margin-top: 27px;">
                <img src="<?php echo $avatar_session; ?>" alt="avatar" width="40px" height="40px">
                <a href="profile.php"><button class="btn btn-success">Profile</button></a>
                <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
            </div>
        </div>
        <br/>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 style="color:green;text-align:center;">Add Student Page</h1>
        </div>
        <div class="panel-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="usr" class="form-label">User name: </label>
                    <input type="text" class="form-control" id="urs" required name="username">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password: </label>
                    <input type="password" class="form-control" id="pwd" required name="password">
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full name: </label>
                    <input type="text" class="form-control" id="fullname" required name="full_name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" class="form-control" id="email" required name="email">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone number: </label>
                    <input type="text" class="form-control" id="phone_number" required name="phonenumber">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="2">Teacher</option>
                        <option value="1">Student</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>