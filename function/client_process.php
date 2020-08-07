<?php

if (isset($_POST['client_create']) && !empty($_POST['client_create'])) {
    
    $is_validation_success  =   client_validation();

    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: group_add.php");
        exit();
    } else {
        $emailsql = "SELECT * FROM client_information where email='$email' and is_status=1";
        $result = $conn->query($emailsql);
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
    /*
     * -------------------------------------------------------------------------
     * Array
        (
            [first_name] => 
            [last_name] => 
            [service_type] => Array
                (
                    [0] => sms
                )

            [sms_rate] => 
            [whatsapp_rate] => 
            [balance] => 
            [email] => 
            [password] => 
            [client_create] => Create
        )
     */
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

