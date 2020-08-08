<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_GET['process_type']) && $_GET['process_type'] == 'deleteUser'){
    session_start();
    date_default_timezone_set('Asia/Singapore');
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $id             =   $_POST['id'];
    $table          =   "users WHERE id=$id";
    deleteRecordByWhere($table);
    $feedback   =   [
        'status'        =>  'success',
        'message'       =>  "Data have been successfully deleted."
    ];
    
    echo json_encode($feedback);
}