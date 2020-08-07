<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['whatsapp_template_save']) && !empty($_POST['whatsapp_template_save'])) {
    
    $is_validation_success  =   contact_validation();

    if (!$is_validation_success['status']) {
        foreach ($error_string as $errorKey => $errorVal) {
            $_SESSION['error_message'][$errorKey] = $errorVal;
        }
        $_SESSION['error'] = "Please fill up all required fields!";
        header("location: group_add.php");
        exit();
    } else {
        $errorStatus    =   false;
        $fName          =   "import_contact";
        if(isset($_FILES[$fName]['name']) && !empty($_FILES[$fName]['name'])){
            $csvDataRes                 =   get_csv_data($fName);
            if($csvDataRes['status'] == 'success'){
                $contactContainer       =   $csvDataRes['data'];
            }else{
                $errorStatus                =   true;
                $errorMessageContainer      =   $csvDataRes['data'];
            }
        }else{
            $contactContainer   =   [];
        }
        if(!empty($_POST['contact_no'])){
            $newContact[0]  =   1;
            $newContact[1]  =   $_POST['contact_no'];
            array_push($contactContainer, $newContact);
        }
        if(empty($contactContainer)){
            $errorStatus    =   true;
            array_push($errorMessageContainer, "Please enter Contact Number");
        }
        
        if(!$errorStatus){
            $successCount           =   0;
            $errorCount             =   0;
            $duplicateErrorData     =   [];
            $clientId               =   $_SESSION['logged']['user_id'];
            $createdAt              =   date('Y-m-d H:i:s');
            $groupId                =   (isset($_POST['group_id']) && !empty($_POST['group_id']) ? $_POST['group_id'] : '');
            foreach($contactContainer as $contact){
                $contactNo     =   $contact[1];
                $emailsql = "SELECT * FROM contact_details where contact_no='$contactNo' AND client_id=$clientId";
                $result = $conn->query($emailsql);
                if ($result->num_rows > 0) {
                    $errorCount++;
                    array_push($duplicateErrorData, $contactNo);
                } else {
                    $contactDetails     =   [
                        'client_id'     =>  $clientId,
                        'group_id'      =>  $groupId,
                        'contact_no'    =>  $contactNo,
                        'created_by'    =>  $_SESSION['logged']['user_id'],
                        'created_at'    =>  $createdAt,
                    ];
                    saveData('contact_details', $contactDetails);
                    $successCount++;
                }
            }// end of foreach;
            
            if($successCount > 0){
                $_SESSION['success']        =   $successCount." Contact have been successfully saved!";                
            }else{
                $message    = implode(',', $errorMessageContainer);
                $_SESSION['error']      =   ".Failed to saved contact";
            }
            $message    = implode(',', $errorMessageContainer);
            if(isset($duplicateErrorData) && !empty($duplicateErrorData)){
                $message                = implode(',', $duplicateErrorData);
                $_SESSION['error']      =   count($duplicateErrorData)." Duplicate data.".$message;
            }
        }else{
            $message    = implode(',', $errorMessageContainer);
            $_SESSION['error']      =   $message.".Failed to saved contact";
        }
    }
    header("location: contact_list.php");
                exit();
}

function process_file_upload($uplodData){
    $inputFileName              =   $uplodData['inputFileName'];
    $templateId                 =   $uplodData['templateId'];
    $uploadTypeDirectory        =   $uplodData['uploadTypeDirectory'];
    
    $uploadOk           = 1;
    $uploadErrordata    = [];
    $target_dir         = "resource/$uploadTypeDirectory/";
    $imageFileType      = strtolower(pathinfo($_FILES[$inputFileName]['name'], PATHINFO_EXTENSION));
    $productFileName    = "template" . $templateId . "." . $imageFileType;
    $target_file        = $target_dir . $productFileName;
    // Check if image file is a actual image or fake image
    $check              = getimagesize($_FILES[$inputFileName]["tmp_name"]);
    if ($check == false) {
        $uploadOk = 0;
        array_push($uploadErrordata,'Please upload a valid file');
    }
    // Check file size
    if ($_FILES[$inputFileName]["size"] > 8000) {
        $uploadOk = 0;
        array_push($uploadErrordata,'Sorry, Image file is too large');
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
            $uploadOk   =   1;
        }
    }
}

function contact_validation(){
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