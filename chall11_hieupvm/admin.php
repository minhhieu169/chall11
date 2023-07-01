<?php 
    include_once(__DIR__.'\db\sqlFunction.php');
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    $username_session = $_SESSION['username'];
    $sql = 'SELECT * FROM users where username = "'.$username_session.'";';
    $userList_session = executeSelect($sql);
    $user_session = $userList_session[0];
    $avatar_session = $user_session['avatar'];
    
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
        <div class="md-3" style="float: right; margin-top:27px;">
            <img src="<?php echo $avatar_session;?>" alt="avatar" width="40px" height="40px">
            <a href="profile.php"><button class="btn btn-success">Profile</button></a>
            <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Home</h1>
                </br>
            </div>
            <div class="panel-body">
                
                
                <div class="md-3">
                    <li class="list-group-item"><a href="listUser.php" style="text-decoration: none; color: black;" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='black'">User list</a></li>
                </div>
                <div class="md-3">
                    <li class="list-group-item"><a href="classroom.php" style="text-decoration: none; color: black;" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='black'">Assignment</a></li>
                </div>
                <div class="md-3">
                    <li class="list-group-item"><a href="challenger.php" style="text-decoration: none; color: black;" onMouseOver="this.style.color='green'" onMouseOut="this.style.color='black'">Challenge</a></li>
                </div>
            </div>
        </div>
</div>
</body>
</html>