<?php
    session_start();
    ob_start();
    
    include "../user/connectdb.php";
    include "../user/user.php";
    if((isset($_POST['dangnhap']))&&($_POST['dangnhap'])){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $role=checkuser($user,$pass);
        $_SESSION['role']=$role;
        if($role==1) header('location: ../admin/productlist.php');
        else {
            $txt_erro="username or password ko ton tai!";
        }
        //header('location: ../admin/class/brand_class.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-admin</title>
</head>
<body>
    <div class="main">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" php method="post">
            <input type="text" name= "user" id="">
            <input type="text" name= "pass" id="">
            <input type="submit" name= "dangnhap" value="Đăng nhập">
            <?php
            if(isset($txt_erro)&&($txt_erro!=""))
            {
                echo $txt_erro;
            }
            ?>
        </form>
    </div>
</body>
</html>