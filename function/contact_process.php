<?php

if (isset($_POST['contact_create']) && !empty($_POST['contact_create'])) {
    
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
function get_csv_data($fName){
    $fileHaveError = false;
    $importSuccess = 0;
    $importError = 0;
    $fileErrorMessage = [];
    $allowed = array('csv');
    $filename = $_FILES[$fName]['name'];
    if ($_FILES[$fName]['error'] > 0) {
        $fileHaveError = true;
        array_push($fileErrorMessage, 'Please select an import file first');
    }
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        $fileHaveError = true;
        array_push($fileErrorMessage, 'Please import only CSV file');
    }
    
    if (!$fileHaveError) {
        $file = $_FILES[$fName]['tmp_name'];
        $csvdata = csv_to_array($file);
        $feedback = [
            'status' => 'success',
            'message' => 'File was OK',
            'data' => $csvdata,
        ];
    } else {
        $feedback = [
            'status' => 'error',
            'message' => 'File Have error',
            'data' => $fileErrorMessage,
        ];
    }
    
    return $feedback;
    
}
function csv_to_array($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        $count = 1;
        if (($handle = fopen($filename, 'r')) !== false) {
            while ($row = fgetcsv($handle)) {
                if ($count == 1) {
                    $count++;
                    continue;
                }
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
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

