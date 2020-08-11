<?php

if (isset($_POST['client_create']) && !empty($_POST['client_create'])) {
    
    $is_validation_success  =   client_validation();

    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: client_create.php");
        exit();
    } else {
        $email      =   $_POST['email'];
        $emailsql   =   "SELECT * FROM client_information where email='$email' and is_status=1";
        $result     =   $conn->query($emailsql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Found Duplicate Data";
            header("location: client_create.php");
            exit();
        } else {
            $userRes    =   create_client_users();
            if($userRes['status']   ==  'success'){
                $clientRes    =   create_client($userRes['last_id']);
                if($clientRes['status']   ==  'success'){
                   $_SESSION['success']                =   "Client have been successfully created";
                }
            }
            header("location: client_list.php");
            exit();
        }
    }
}
if (isset($_POST['client_profile_update']) && !empty($_POST['client_profile_update'])) {
    
    // redirect location:
    if(is_super_admin($_SESSION['logged']['user_id'])){
        $redireclLocation       =   "client_edit.php?client_id=".$_POST['edit_id'];
    }else{
        $redireclLocation       =   "client_profile.php";
    }
    
    $is_validation_success  =   client_validation();

    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: $redireclLocation");
        exit();
    } else {
        $email          =   $_POST['email'];
        $edit_id        =   $_POST['edit_id'];
        $user_id        =   $_POST['user_id'];
        $emailsql       = "SELECT * FROM users WHERE email='$email' AND status=1 AND id!=$user_id";
        $result         = $conn->query($emailsql);
        if ($result->num_rows > 0) {
            $_SESSION['error']      =    "Found Duplicate Data";
            header("location: $redireclLocation");
            exit();
        } else {
            $userRes    =   update_client_users();
            if($userRes['status']   ==  'success'){
                if($userRes['status']   ==  'success'){
                   $_SESSION['success']                =   "Client information have been successfully Updated";
                }
            }
            header("location: $redireclLocation");
            exit();
        }
    }
}
function update_client_users(){
    $cUpdate['first_name']     =   validate_text_input($_POST['first_name']);
    $cUpdate['last_name']      =   validate_text_input($_POST['last_name']);
    $cUpdate['sms_rate']       =   validate_text_input($_POST['sms_rate']);
    $cUpdate['whatsapp_rate']  =   validate_text_input($_POST['whatsapp_rate']);
    
    $oldBalance                =   get_whatsapp_balance($_POST['user_id']);
    $topUpBalance              =   (isset($_POST['top_up_balance']) && !empty($_POST['top_up_balance']) ? $_POST['top_up_balance'] : 0);
    $cUpdate['balance']        =   $oldBalance+$topUpBalance;
    
    $cUpdate['company_name']        =   validate_text_input($_POST['company_name']);
    $cUpdate['company_nature']      =   validate_text_input($_POST['company_nature']);
    $cUpdate['company_description'] =   validate_text_input($_POST['company_description']);
    
    $cUpdate['company_email']       =   validate_text_input($_POST['company_email']);
    $cUpdate['company_weblink']     =   validate_text_input($_POST['company_weblink']);
    $cUpdate['company_address']     =   validate_text_input($_POST['company_address']);
    
    $cWhere['id']                   =   $_POST['edit_id'];
    $res    =    updateData('client_information', $cUpdate, $cWhere);
    
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $user['password']       =   md5($_POST['password']);
        
    }
    $user['user_type']      =   'client';
    $user['first_name']     =   validate_text_input($_POST['first_name']);
    $user['last_name']      =   validate_text_input($_POST['last_name']);
    $user['email']          =   validate_text_input($_POST['email']);
    $user['status']         =   1;
    $user['updated_by']     =   $_SESSION['logged']['user_id'];
    $user['updated_at']     =   date("Y-m-d H:i:s");
    
    $uWhere['id']           =   $_POST['user_id'];
    $_SESSION['logged']['user_name']    =   $_POST['first_name'].' '.$_POST['last_name'];
    $res    =   updateData('users', $user, $uWhere);
    return $res;
}
function create_client_users(){
    $user['user_type']      =   'client';
    $user['first_name']     =   validate_text_input($_POST['first_name']);
    $user['last_name']      =   validate_text_input($_POST['last_name']);
    $user['email']          =   validate_text_input($_POST['email']);
    $user['password']       =   md5($_POST['password']);
    $user['status']         =   1;
    $user['created_by']     =   $_SESSION['logged']['user_id'];
    $user['created_at']     =   date("Y-m-d H:i:s");
    
    $res    = saveData('users', $user);
    return $res;
}
function create_client($userId){
    $is_whatsapp_service=   0;
    $is_sms_service     =   0;
    foreach($_POST['service_type'] as $service){
        if($service == 'sms'){
            $is_sms_service     =   1;
        }
        if($service == 'whatsapp'){
            $is_whatsapp_service     =   1;
        }
    }
    $user['user_id']            =   $userId;
    $user['first_name']         =   validate_text_input($_POST['first_name']);
    $user['last_name']          =   validate_text_input($_POST['last_name']);
    $user['is_sms_service']     =   $is_sms_service;
    $user['is_whatsapp_service']=   $is_whatsapp_service;
    $user['sms_rate']           =   (float)validate_text_input($_POST['sms_rate']);
    $user['whatsapp_rate']      =   (float)validate_text_input($_POST['whatsapp_rate']);
    $user['balance']            =   (float)validate_text_input($_POST['balance']);
    $user['is_status']          =   1;
    $user['created_by']         =   $_SESSION['logged']['user_id'];
    $user['created_at']         =   date("Y-m-d H:i:s");
    
    $res    = saveData('client_information', $user);
    return $res;
}
function client_validation(){
    $isError            =   false;
    $errorMessage[]     =   [];
    if(empty($_POST['first_name'])){
        $isError            =   false;
        $errorMessage['first_name']     =   'First name required.';
    }else{
        $errorMessage['first_name']     =   '';
    }
    
    $feedback   =   [
        'status'    =>   true
    ];
    return $feedback;
}

