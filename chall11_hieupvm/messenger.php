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
    $id_session = $user_session['user_id'];

    $fromid = $toid = '';

    if(isset($_GET['fromid']) && isset($_GET['toid'])){
        $fromid = $_GET['fromid'];
        $toid = $_GET['toid'];

    } 
    if(isset($_POST['submit'])){
        $content = $_POST['content_message'];
        $sql = 'INSERT INTO messenger (from_id, to_id, content) VALUES ('.$fromid.', '.$toid.', "'.$content.'");';
        execute($sql);
        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        die;
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
<div>
    <div style="margin-left:200px;margin-right:200px;">
        <div style="float: left; margin-top: 27px;">
            <a href="listUser.php"><button class="btn btn-success">Back</button></a>
        </div>
        <div style="float: right; margin-top: 27px;">
            <img src="<?php echo $avatar_session;?>" alt="avatar" width="40px" height="40px">
            <a href="profile.php"><button class="btn btn-success">Profile</button></a>
            <a href="logout.php"><button class="btn btn-warning">Log out</button></a>
        </div>
        <div>
            </br>
            <h1 style="color:green;text-align:center;">Box Chat</h1>
            </br>
        </div>
    </div>


    <div class="container py-5 px-4">
        <div class="row rounded-lg overflow-hidden shadow">
            <div class="col-12 px-0">
                <div class="px-4 py-5 chat-box bg-white">
                    <?php 
                    $sql = 'SELECT * FROM messenger WHERE (from_id = '.$fromid.' AND to_id = '.$toid.') OR (from_id = '.$toid.' AND to_id = '.$fromid.');';
                    $messList = executeSelect($sql);
                    foreach($messList as $mess){
                        $sql = 'SELECT full_name FROM users where user_id = '.$mess['from_id'].';';
                        $fromFullName = executeSelect($sql)[0]['full_name'];
                        if($id_session == $mess['to_id']){
                            echo '<div class="media w-50 mb-3">
                                    <div class="media-body ml-3">
                                        <label class="small text-muted">From '.$fromFullName.':</label>
                                        <div class="bg-light rounded py-2 px-3 mb-2">    
                                            <p class="text-small mb-0 text-muted">'.$mess['content'].'</p>
                                        </div>
                                        <p class="small text-muted">'.$mess['created_at'].'</p>
                                    </div>
                                </div>';
                        }else if($id_session == $mess['from_id']){
                            echo '<div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white">'.$mess['content'].'</p>
                                        </div>
                                        <p class="small text-muted">'.$mess['created_at'].'</p>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                </div>
                <form action="" class="bg-light" method="POST">
                    <div class="input-group">
                    <input type="text" placeholder="Type a message" required name="content_message" class="form-control rounded-0 border-0 py-3 bg-light">
                    <button class="btn btn-primary" type="submit" name="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>