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
                    echo '<td><a href="addAssignment.php"><button class="btn btn-success">Add</button></a></td>';  
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
                <h1 style="color:green;text-align:center;">Assignment Management</h1>
                </br>
            </div>
            <div class="panel-body">
            <?php  
            $sql = "SELECT * FROM assignment";
            $assignList = executeSelect($sql);
            foreach($assignList as $ass){
                if($ass['path'] == ''){
                    echo "<p>Not found file</p>";
                }
                $down = "uploads/teacher/".$ass['path'];
                echo '<div class="mb-3" style="border-radius: 5px;">
                    <h5 class="">'.$ass['title'].'
                    <small class="text-muted">'.$ass['created_at'].'</small>
                    </h5>
                    <label for="des" class="form-label">Description: </label>
                    <br/>
                    <textarea rows="5" cols="75" id="des" disabled>'.$ass['description'].'</textarea>
                    <br/>
                    <td><a href="'.$down.'"><button class="btn btn-warning">Download</button></a></td>';
                    if($role_session == 1){
                        echo '<td><a href="submissionAsStudent.php?id='.$ass['assign_id'].'"><button class="btn btn-primary">Submission</button></a></td>';
                    }else{
                        echo '<td><a href="submissionAsTeacher.php?id='.$ass['assign_id'].'"><button class="btn btn-primary">Submission</button></a></td>';
                    }
                    echo '<hr/>
                    </div>';
                
            }
            ?>
        </div>
    </div>
</body>
</html>