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

    if(isset($_GET['id'])){
        $assign_id = $_GET['id'];
        $sql = 'SELECT * FROM assignment where assign_id = "'.$assign_id.'";';
        $assignList = executeSelect($sql);
        $assign = $assignList[0];
        $assign_title = $assign['title'];
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
                <a href="classroom.php"><button class="btn btn-success">Back</button></a>
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
                <h1 style="color:green;text-align:center;">Submitted of <strong><?php echo $assign_title;?></strong> (Teacher page)</h1>
                </br>
            </div>
            <div class="panel-body">
            <div class="mb-3">
                    <?php  
                        $sql = 'SELECT * FROM submission WHERE assign_id = '.$assign_id.';';
                        $submisList = executeSelect($sql);
                        foreach($submisList as $sub){
                            $cur_student = $sub['student_id'];
                            $sql = 'SELECT * FROM users WHERE user_id = '.$cur_student.';';
                            $studentList = executeSelect($sql);
                            $astudent = $studentList[0];
                            $cur_fullname = $astudent['full_name'];
                            $down = "uploads/student/".$sub['path'];
                            echo '<div class="mb-3" style="border-radius: 5px;">
                                <h9>From <strong>'.$cur_fullname.'</strong></h9>
                                <h5 class="">'.$sub['title'].'
                                <small class="text-muted">'.$sub['created_at'].'</small>
                                </h5>
                                
                                <label for="des" class="form-label">Description: </label>
                                <br/>
                                <textarea rows="5" cols="75" id="des" disabled>'.$sub['description'].'</textarea>
                                <br/>
                                <td><a href="'.$down.'"><button class="btn btn-warning">Download</button></a></td>';
                                echo '<hr/>
                                </div>';
                        }
                    ?>
                </div>
        </div>
    </div>
</body>
</html>