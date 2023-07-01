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

    //////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['add'])&&isset($_FILES['filename'])){
        $path="uploads/challenger/";
        $file = $_FILES['filename'];
        $error = [];

        $filename = $file['name'];
        $splitFileName = explode('.', $filename);
        $ext = end($splitFileName);
        // $new_file = md5(uniqid()).'.'.$ext;

        $allow_ext = ['txt'];
        if(in_array($ext, $allow_ext)){
            $upload = move_uploaded_file($file['tmp_name'], $path.$filename);
            $title = $_POST['title'];
            $hint = $_POST['hint'];
            $sql = 'INSERT INTO challenger (title, hint, path) VALUES ("'.$title.'", "'.$hint.'", "'.$filename.'");';
            execute($sql);
            header("Location: challenger.php");
            if(!$upload){
                $error[] = 'upload_error';
            }
        }else{
            $error[] = 'ext_error';
        }

        if(!empty($error)){
            $mess = '';
            if(in_array('ext_error', $error)){
                $mess = "Invalid file";
            }
            else{
                $mess = "Something is wrong";
            }
            if(!empty($mess)){
                ?>
                <script>alert("<?php echo $mess; ?>");</script>
                <?php
            }
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
                <a href="challenger.php"><button class="btn btn-success">Back</button></a>
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
                <h1 style="color:green;text-align:center;">Create challenger</h1>
                </br>
            </div>
            <div class="panel-body">
                <div class="mb-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="hint">Hint</label>
                            <textarea name="hint" id="hint" cols="30" rows="10" class="form-control" placeholder="Ex: Bai tho noi tieng nhat cua To Hoai la bai tho nao?"></textarea>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label for="filename">File</label>
                            <input type="file" class="form-control-file" name="filename">
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-primary" name="add">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>