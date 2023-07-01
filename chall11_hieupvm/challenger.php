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
    $role_session = $user_session['role_id'];
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
                <?php 
                if($role_session == 2) {
                    echo '<td><a href="addChallenger.php"><button class="btn btn-success">Add challenger</button></a></td>';  
                }
                ?>
            </div>
            <div style="float: right; margin-top: 27px;">
                <img src="<?php echo $avatar_session; ?>" alt="avatar" width="40px" height="40px">
                <a href="profile.php"><button class="btn btn-success">Profile</button></a>
                <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                </br>
                <h1 style="color:green;text-align:center;">Challenger</h1>
                </br>
            </div>
            <div class="panel-body">
            <?php  
            if($role_session == 2){
                $sql = "SELECT * FROM challenger";
                    $chalList = executeSelect($sql);
                    foreach($chalList as $chal){
                        $down = "uploads/challenger/".$chal['path'];
                        echo '<div class="mb-3" style="border-radius: 5px;">
                        <h5 class="">'.$chal['title'].'
                        </h5>
                        <label for="des" class="form-label">HINT: </label>
                        <br/>
                        <textarea rows="5" cols="75" id="des" disabled>'.$chal['hint'].'</textarea>
                        <br/>
                        <hr/>
                        </div>';
                }
            }
            else if($role_session == 1){
                $sql = "SELECT * FROM challenger";
                    $chalList = executeSelect($sql);
                    foreach($chalList as $chal){
                        echo '<div class="mb-3" style="border-radius: 5px;">
                        <h5 class="">'.$chal['title'].'
                        </h5>
                        <label for="des" class="form-label">HINT: </label>
                        <br/>
                        <textarea rows="5" cols="75" id="des" disabled>'.$chal['hint'].'</textarea>
                        <br/>
                        <a href="answer.php?id='.$chal['challenger_id'].'"><button class="btn btn-success">Answer</button></a>
                        <hr/>
                        </div>';
                }
            }
            ?>

        </div>
    </div>
</body>
</html>