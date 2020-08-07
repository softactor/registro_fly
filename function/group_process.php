<?php

if (isset($_POST['group_save']) && !empty($_POST['group_save'])) {
    $error_status = false;
    $error_string = [];
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = validate_text_input($_POST['name']);
    } else {
        $error_status = true;
        $error_string['name_empty'] = 'Name is required.';
    }

    if ($error_status) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: group_add.php");
        exit();
    } else {
        $userId     =   $_SESSION['logged']['user_id'];
        $emailsql   =   "SELECT * FROM groups where name='$name' AND client_id=$userId";
        $result     =   $conn->query($emailsql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Found Duplicate Data";
            header("location: group_add.php");
            exit();
        } else {
            $regData['name']                = $name;
            $regData['client_id']           = $userId;
            saveData('groups', $regData);
            $_SESSION['success']        = "Data have been successfuly saved";
            header("location: group_list.php");
            exit();
        }
    }
}
if (isset($_POST['group_update']) && !empty($_POST['group_update'])) {
    $error_status   = false;
    $error_string   = [];
    $client_id      =   $_SESSION['logged']['user_id'];
    $id             =   $_POST['edit_id'];
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = validate_text_input($_POST['name']);
    } else {
        $error_status = true;
        $error_string['name_empty'] = 'Name is required.';
    }

    if ($error_status) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: group_add.php");
        exit();
    } else {
        $emailsql = "SELECT * FROM groups where name='$name' AND id!=$id AND client_id=$client_id";
        $result = $conn->query($emailsql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Found Duplicate Data";
            header("location: group_edit.php?edit_id=".$id);
            exit();
        } else {
            $regData['name']            = $name;
            $where['id']     = $id;
            $res     =   updateData('groups', $regData, $where);
            $_SESSION['success']        = "Data have been successfuly updated";
            header("location: group_list.php");
            exit();
        }
    }
}
if(isset($_GET['process_type']) && $_GET['process_type'] == 'deleteGroup'){
    session_start();
    date_default_timezone_set('Asia/Singapore');
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $id             =   $_POST['id'];
    $table          =   "groups WHERE id=$id";
    deleteRecordByWhere($table);
    $feedback   =   [
        'status'        =>  'success',
        'message'       =>  "Data have been successfully deleted."
    ];
    
    echo json_encode($feedback);
}