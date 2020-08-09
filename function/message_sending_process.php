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
    $error_status = false;
    
    $message_type       =   $_POST['message_type'];
    $template_type      =   $_POST['template_type'];
    
    $receiverData       =   (isset($_POST['receivers']) && !empty($_POST['receivers']) ? $_POST['receivers'] : '');
    $groupData          =   (isset($_POST['groups']) && !empty($_POST['groups']) ? $_POST['groups'] : '');
    $receivers          =   get_receivers_data();
    $groupReceivers     =   get_group_receivers_data();
    // Prepare final receivers data
    $finalReceiverParam        =   [
        'receivers'     =>  $receivers,
        'groups'        =>  $groupReceivers,
    ];
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
    $message_id         =   store_message_processing($messageParam);
    $detailsResponse    =   store_message_details_processing($messageData);
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
    
    $message =   "";
    if(isset($_POST['ifile']) && !empty($_POST['ifile'])){
        print '<pre>';
        print_r($_SERVER);
        print '</pre>';
        
        print '<pre>';
        print_r($_POST['ifile']);
        print '</pre>';
        exit;
        
    }
    $message.=   $header;
    $message.=   $body;
    $message.=   $footer;
    
}
function get_message_new_data(){
}

function store_message_processing($messageData){
}
function store_message_details_processing($messageData){
    
}