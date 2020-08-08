<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['whatsapp_template_update']) && !empty($_POST['whatsapp_template_update'])) {
    
    $is_validation_success  =   template_validation();
    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: message_whatsapp_templates_create.php");
        exit();
    } else {
        $edit_id                        =   $_POST['edit_id'];
        $clientId                       =   $_SESSION['logged']['user_id'];
        $insdata['name']                =   validate_text_input($_POST['name']);
        $insdata['header']              =   validate_text_input($_POST['header']);
        $insdata['footer']              =   validate_text_input($_POST['footer']);
        $insdata['body']                =   validate_text_input($_POST['body']);
        $insdata['client_id']           =   $clientId;
        $insdata['template_type']       =   'whatsapp';
        $insdata['updated_at']          =   date('Y-m-d H:i:s');
        $insdata['updated_by']          =   $clientId;
        $where['id']                    =   $edit_id;
        
        $templateId     = updateData('template_details', $insdata, $where);
        $multimediares  =   is_any_multimedia_file($edit_id); 
        $isAnyMultimedia            =   false;
        $multimediaError            =   false;
        $multimediaErrorMessage     =   [];
        
        if(isset($multimediares['image_upload']['status'])){
            if($multimediares['image_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $iupdataTemp['image_file']         =   $multimediares['image_upload']['fileName'];
                $iupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $iupdataTemp['updated_by']         =   $clientId;
                $iwhereTemp['id']                  =   $edit_id;
                updateData('template_details', $iupdataTemp, $iwhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['image_upload']['errorData']));
            }
        }
        
        if(isset($multimediares['audio_upload']['status'])){            
            if($multimediares['audio_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $aupdataTemp['audio_file']         =   $multimediares['audio_upload']['fileName'];
                $aupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $aupdataTemp['updated_by']         =   $clientId;
                $awhereTemp['id']                  =   $edit_id;
                updateData('template_details', $aupdataTemp, $awhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['audio_upload']['errorData']));
            }
            
        }
        
        if(isset($multimediares['video_upload']['status'])){
            if($multimediares['video_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $vupdataTemp['video_file']         =   $multimediares['video_upload']['fileName'];
                $vupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $vupdataTemp['updated_by']         =   $clientId;
                $vwhereTemp['id']                  =   $edit_id;
                updateData('template_details', $vupdataTemp, $vwhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['video_upload']['errorData']));
            }
            
        }
        
        if($isAnyMultimedia){
            if($multimediaError){
                $message            =   implode(',', $multimediaErrorMessage);
                $_SESSION['error']  =   $message.".Failed to saved contact";
            }else{
                $_SESSION['success']=   'Data have been successfully Updated';
            }
        }else{
            $_SESSION['success']=   'Data have been successfully Updated';
        }
    }
    header("location: message_whatsapp_templates_list.php");
    exit();
}

if (isset($_POST['whatsapp_template_save']) && !empty($_POST['whatsapp_template_save'])) {
    
    $is_validation_success  =   template_validation();
    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: message_whatsapp_templates_create.php");
        exit();
    } else {
        $clientId                       =   $_SESSION['logged']['user_id'];
        $insdata['name']                =   validate_text_input($_POST['name']);
        $insdata['header']              =   validate_text_input($_POST['header']);
        $insdata['footer']              =   validate_text_input($_POST['footer']);
        $insdata['body']                =   validate_text_input($_POST['body']);
        $insdata['client_id']           =   $clientId;
        $insdata['template_type']       =   'whatsapp';
        $insdata['created_at']          =   date('Y-m-d H:i:s');
        $insdata['created_by']          =   $clientId;
        
        $templateId     =   saveData('template_details', $insdata);
        $multimediares  =   is_any_multimedia_file($templateId['last_id']); 
        $isAnyMultimedia            =   false;
        $multimediaError            =   false;
        $multimediaErrorMessage     =   [];
        
        if(isset($multimediares['image_upload']['status'])){
            if($multimediares['image_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $iupdataTemp['image_file']         =   $multimediares['image_upload']['fileName'];
                $iupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $iupdataTemp['updated_by']         =   $clientId;
                $iwhereTemp['id']                  =   $templateId['last_id'];
                updateData('template_details', $iupdataTemp, $iwhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['image_upload']['errorData']));
            }
        }
        
        if(isset($multimediares['audio_upload']['status'])){            
            if($multimediares['audio_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $aupdataTemp['audio_file']         =   $multimediares['audio_upload']['fileName'];
                $aupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $aupdataTemp['updated_by']         =   $clientId;
                $awhereTemp['id']                  =   $templateId['last_id'];
                updateData('template_details', $aupdataTemp, $awhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['audio_upload']['errorData']));
            }
            
        }
        
        if(isset($multimediares['video_upload']['status'])){
            if($multimediares['video_upload']['status']  == 1){
                $isAnyMultimedia            =   true;
                $vupdataTemp['video_file']         =   $multimediares['video_upload']['fileName'];
                $vupdataTemp['updated_at']         =   date('Y-m-d H:i:s');
                $vupdataTemp['updated_by']         =   $clientId;
                $vwhereTemp['id']                  =   $templateId['last_id'];
                updateData('template_details', $vupdataTemp, $vwhereTemp);
            }else{
                $multimediaError    =   true;
                array_push($multimediaErrorMessage, implode(',',$multimediares['video_upload']['errorData']));
            }
            
        }
        
        if($isAnyMultimedia){
            if($multimediaError){
                $message            =   implode(',', $multimediaErrorMessage);
                $_SESSION['error']  =   $message.".Failed to saved contact";
            }else{
                $_SESSION['success']=   'Data have been successfully saved';
            }
        }else{
            $_SESSION['success']=   'Data have been successfully saved';
        }
    }
    header("location: message_whatsapp_templates_list.php");
    exit();
}

function is_any_multimedia_file($templateId){
    $iFileName          =   "image_file";    
    $ires               =   "";    
    $ares               =   "";    
    $vres               =   "";    
    if(isset($_FILES[$iFileName]['name']) && !empty($_FILES[$iFileName]['name'])){
        $udata                              =   [];
        $udata['inputFileName']             =   $iFileName;
        $udata['templateId']                =   $templateId;
        $udata['uploadTypeDirectory']       =   'image';//audio video
        $ires     =   process_file_upload($udata);
    }
    $aFileName          =   "audio_file";        
    if(isset($_FILES[$aFileName]['name']) && !empty($_FILES[$aFileName]['name'])){
        $udata                              =   [];
        $udata['inputFileName']             =   $aFileName;
        $udata['templateId']                =   $templateId;
        $udata['uploadTypeDirectory']       =   'audio';//audio video
        $ares     =   process_file_upload($udata);
    }
    $vFileName          =   "video_file";        
    if(isset($_FILES[$vFileName]['name']) && !empty($_FILES[$vFileName]['name'])){
        $udata                              =   [];
        $udata['inputFileName']             =   $vFileName;
        $udata['templateId']                =   $templateId;
        $udata['uploadTypeDirectory']       =   'video';//audio 
        $vres     =   process_file_upload($udata);
    }
    $feedback       =   [
        'image_upload'  => $ires,
        'audio_upload'  => $ares,
        'video_upload'  => $vres,
    ];
    return $feedback;
}

function process_file_upload($uplodData){
    $inputFileName              =   $uplodData['inputFileName'];
    $templateId                 =   $uplodData['templateId'];
    $uploadTypeDirectory        =   $uplodData['uploadTypeDirectory'];
    
    $uploadOk           = 1;
    $uploadErrordata    = [];
    $target_dir         = "../resource/$uploadTypeDirectory/";
    $imageFileType      = strtolower(pathinfo($_FILES[$inputFileName]['name'], PATHINFO_EXTENSION));
    $productFileName    = "template" . $templateId . "." . $imageFileType;
    $target_file        = $target_dir . $productFileName;
    
    if($uploadTypeDirectory  == 'image'){
        // Check if image file is a actual image or fake image
        $check              = getimagesize($_FILES[$inputFileName]["tmp_name"]);
        if ($check == false) {
            $uploadOk = 0;
            array_push($uploadErrordata,'Please upload a valid file');
        }
    }
    // Check file size
    if ($_FILES[$inputFileName]["size"] > 5000000) {
        $uploadOk = 0;
        array_push($uploadErrordata,'Sorry, file is too large');
    }
    // Allow certain file formats
    if (1!==1) {
        $uploadOk = 0;
        array_push($uploadErrordata,'Sorry, only image audio and video files are allowed.');
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        array_push($uploadErrordata,'Sorry, Failed to upload image.');
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$inputFileName]["tmp_name"], $target_file)) {
            $uploadOk   =   1;
        } else {
            $uploadOk   =   0;
        }
    }
    $feedBack       =   [
        'status'        =>  $uploadOk,
        'errorData'     =>   $uploadErrordata,
        'fileName'      =>   $productFileName
    ];
    return $feedBack;
    
}

function template_validation(){
    $isError            =   true;
    $errorMessage[]     =   [];
    if(empty($_POST['name'])){
        $isError            =   false;
        $errorMessage['name']     =   'Name is required.';
    }else{
        $errorMessage['name']     =   '';
    }
    
    if(empty($_POST['footer'])){
        $isError            =   false;
        $errorMessage['footer']     =   'Footer is required.';
    }else{
        $errorMessage['footer']     =   '';
    }
    
    if(empty($_POST['header'])){
        $isError            =   false;
        $errorMessage['header']     =   'Header is required.';
    }else{
        $errorMessage['header']     =   '';
    }
    
    if(empty($_POST['body'])){
        $isError            =   false;
        $errorMessage['body']     =   'Body is required.';
    }else{
        $errorMessage['body']     =   '';
    }
    
    $feedback   =   [
        'status'    =>   $isError,
        'data'      =>   $errorMessage,
    ];
    return $feedback;
}

if(isset($_GET['process_type']) && $_GET['process_type'] == 'deleteUploadedFile'){
    session_start();
    date_default_timezone_set('Asia/Singapore');
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $id             =   $_POST['id'];
    $tableData      = getDataRowByTableAndId('template_details', $id);
    if($_POST['type']   == 'a'){
        $filetobedeleted        =   '../resource/audio/'.$tableData->audio_file;
        $update['audio_file'] = "";
    }elseif($_POST['type']   == 'i'){
        $filetobedeleted        =   '../resource/image/'.$tableData->image_file;
        $update['image_file']   = "";
    }elseif($_POST['type']   == 'v'){
        $filetobedeleted        =   '../resource/video/'.$tableData->video_file;
        $update['video_file']   = "";
    }
    $where['id']   = $id;
    updateData('template_details', $update, $where);
    unlink($filetobedeleted);
    $filetobedeleted        =   '';
    $feedback   =   [
        'status'        =>  'success',
        'message'       =>  "File have been successfully deleted."
    ];
    
    echo json_encode($feedback);
}