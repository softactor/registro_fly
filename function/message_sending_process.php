<?php
/*
     * Array
        (
            [message_type] => whatsapp
            [receivers] => Array
                (
                    [0] => 11
                    [1] => 10
                    [2] => 9
                )

            [groups] => Array
                (
                    [0] => 4
                    [1] => 5
                )

            [template_type] => t
            [template_id] => 10
            [header] => H
            [footer] => F
            [body] => B
            [sending_message] => Send
        )
     */
if (isset($_POST['sending_message']) && !empty($_POST['sending_message'])) {
    print '<pre>';
    print_r($_SERVER);
    print '</pre>';
    exit;
    //http://flyingpigeon.com.sg/admin/sms/Twilio/send_message.php
    $error_status = false;
    
    $message_type       =   $_POST['message_type'];
    $template_type      =   $_POST['template_type'];
    
    $receiverData       =   (isset($_POST['receivers']) && !empty($_POST['receivers']) ? $_POST['receivers'] : '');
    $groupData          =   (isset($_POST['groups']) && !empty($_POST['groups']) ? $_POST['groups'] : '');
    $receivers          =   get_receivers_data();
    $groupReceivers     =   get_group_receivers_data();
    // check is message type is template data
    if($template_type == 't'){
        $messageData    =   get_message_temeplate_data();
    }else{
        $messageData    =   get_message_new_data();
    }
    $messageParam        =   [
        'message'       =>  $messageData,
        'receivers'     =>  $receiverData,
        'groups'        =>  $groupData,
    ];
    $mresponse         =   store_message_processing($messageParam);
    if(isset($mresponse) && $mresponse['status']    ==  'success'){
        $mdetails           =   [
            'message_id'    =>  $mresponse['last_id'],
            'receivers'     =>  $receivers,
            'groups'        =>  $groupReceivers,
            'message'       =>  $messageData,
        ];
        $detailsResponse    =   store_message_details_processing($mdetails);
        $_SESSION['success']        = "Data have been successfuly sent for message";
        header("location: send_message.php");
        exit();
    }
}

function get_receivers_data(){
    if(isset($_POST['receivers']) && !empty($_POST['receivers'])){
        $groupsPhoneNumbers     =   [];
        $groups                 =   implode(',', $_POST['receivers']);
        $table                  =   "contact_details WHERE id IN ($groups)";
        $response               =   getAllRowsbyTable($table);
        if(isset($response) && !empty($response)){
            return $response;
        }
        return $groupsPhoneNumbers;
    }
}
function get_group_receivers_data(){
    if(isset($_POST['groups']) && !empty($_POST['groups'])){
        $groupsPhoneNumbers     =   [];
        $groups                 =   implode(',', $_POST['groups']);
        $table                  =   "contact_details WHERE group_id IN ($groups)";
        $response               =   getAllRowsbyTable($table);
        if(isset($response) && !empty($response)){
            return $response;
        }
        return $groupsPhoneNumbers;
    }
}
function get_message_temeplate_data(){
    $header     =   trim($_POST['header']);
    $footer     =   trim($_POST['footer']);
    $body       =   trim($_POST['body']);
    
    $message    =   "";
    $iFile      =   "";
    $aFile      =   "";
    $vFile      =   "";
    if(isset($_POST['ifile']) && !empty($_POST['ifile'])){
        $iFile      =   $_SERVER['HTTP_HOST'].'/resource/image/'.$_POST['ifile'];
    }
    if(isset($_POST['afile']) && !empty($_POST['afile'])){
        $aFile      =   $_SERVER['HTTP_HOST'].'/resource/audio/'.$_POST['afile'];
    }
    if(isset($_POST['vfile']) && !empty($_POST['vfile'])){
        $vFile      =   $_SERVER['HTTP_HOST'].'/resource/video/'.$_POST['vfile'];
    }
    $message.=   chr(10).$header;
    $message.=   chr(10).$body;
    $message.=   chr(10).$footer;
    $feedBack   =   [
        'ifile'     =>  $iFile,
        'afile'     =>  $aFile,
        'vfile'     =>  $vFile,
        'body'      =>  $message
    ];
    return $feedBack;
}
function get_message_new_data(){
}
function store_message_processing($messageData){
    //message_details
    $insData        =   [
        'client_id' =>  $_SESSION['logged']['user_id'],
        'groups'    =>  json_encode($messageData['groups']),
        'receivers' =>  json_encode($messageData['receivers']),
        'message'   =>  $messageData['message'],
        'create_at' =>  date('Y-m-d H:i:s'),
        'create_by' =>  $_SESSION['logged']['user_id'],
    ];  
    
    $res    =   saveData('message_details', $insData);
    return  $res;
    
}
function store_message_details_processing($data){
    $contactContainer   =   [];
    $message_id         =   $data['message_id'];
    $receivers          =   $data['receivers'];
    $groups             =   $data['groups'];
    $message             =   $data['message'];
    if(isset($receivers) && !empty($receivers)){
        foreach($receivers as $mh){
            if(!in_array($mh->contact_no, $contactContainer)){
                $hisData    =   [
                    'message_id'    =>  $message_id,
                    'audio_file'    =>  $message['afile'],
                    'video_file'    =>  $message['vfile'],
                    'image_file'    =>  $message['ifile'],
                    'body'          =>  $message['body'],
                    'contact_no'    =>  '+65'.$mh->contact_no,
                    'created_at'    =>  date("Y-m-d H:i:s"),
                    'created_by'    =>  $_SESSION['logged']['user_id']
                ];
                $res    =   saveData('message_send_history', $hisData);
                array_push($contactContainer, $mh->contact_no);
            }
        }
    }
    if(isset($groups) && !empty($groups)){
        foreach($groups as $mh){
            if(!in_array($mh->contact_no, $contactContainer)){
                $hisData    =   [
                    'message_id'    =>  $message_id,
                    'contact_no'    =>  '+65'.$mh->contact_no,
                    'created_at'    =>  date("Y-m-d H:i:s"),
                    'created_by'    =>  $_SESSION['logged']['user_id']
                ];
                $res    =   saveData('message_send_history', $hisData);
                array_push($contactContainer, $mh->contact_no);
            }
        }
    }
}