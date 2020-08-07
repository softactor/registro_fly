<?php
if (isset($_POST['user_create']) && !empty($_POST['user_create'])) {
    print '<pre>';
    print_r($_POST);
    print '</pre>';
    exit;
    
} 
if (isset($_POST['login_submit']) && !empty($_POST['login_submit'])) { 
    $error_status   =   false;
    $error_string   =   [];
    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email      =   $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_status                   =   true;
            $error_string['email_valid']    =   'Invalid format and please re-enter valid email';
        }
        $_SESSION['email']      =   $email;
    }else{
        $error_status                   =   true;
        $error_string['email_empty']    =   'Email is required.';
    }
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password      =  mysqli_real_escape_string($conn, $_POST['password']);
        $password      =  md5($password);
    }else{
        $error_status                   =   true;
        $error_string['password_empty'] =   'Password is required.';
    }
    
    if($error_status){
        foreach($error_string as $errorKey=>$errorVal){
            $_SESSION['error_message'][$errorKey]   =   $errorVal;            
        }
        $_SESSION['error']    =   "Login credential was not correct.";
        header("location: index.php");
        exit();
    }else{
        $emailsql    = "SELECT * FROM users where email='$email'";
        $result = $conn->query($emailsql);
        if ($result->num_rows > 0) {            
            $passsql    = "SELECT * FROM users where email='$email' AND password='$password'";
            $presult = $conn->query($passsql);
            if ($presult->num_rows > 0) {
                
                $row        =   $presult->fetch_object();
                $fname      =   $row->first_name;
                $lname      =   $row->last_name;
                $user_id    =   $row->id;
                $user_type  =   $row->user_type;
                $status     =   $row->status;
                if($status){
                unset($_SESSION['email']);
                unset($_SESSION['error']);
                    $_SESSION['logged']['user_name']    =   $fname.' '.$lname;
                    $_SESSION['logged']['user_id']      =   $user_id;
                    $_SESSION['logged']['status']       =   true;
                    $_SESSION['logged']['user_type']    =   $user_type;
                    $_SESSION['success']                =   $fname.' '.$lname." have successfully loggedin!";
                }else{
                    $_SESSION['error']                  =   $fname.' '.$lname.",<br/>Currently your account is Inactive!";
                }
                header("location: dashboard.php");
                exit();
            }else{
                $error_status                       =   true;
                $_SESSION['error_message']['password_empty']     =   'Password did not matched.';
                $_SESSION['error']                               =   "Login credential was not correct.";
                header("location: index.php");
                exit();
            }
        }else{
            $error_status   =   true;
            $_SESSION['error_message']['email_valid']    =   'Invalid email';
            $_SESSION['error']                           =   "Login credential was not correct.";
            header("location: index.php");
            exit();
        }
    }
}