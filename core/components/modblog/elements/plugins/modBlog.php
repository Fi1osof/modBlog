<?php
if($modx->context->key == 'mgr'){return;}

switch($modx->event->name){
    case 'OnHandleRequest':
        //  Sanitize MODX tags
        // Если разрешены MODX-теги
        if($modx->getOption('allow_tags_in_post', null)){
            if(!function_exists('clear_post_data')){
                function clear_post_data(&$data){
                    if(is_array($data)){
                        foreach($data as $r_name => &$r_val){
                            clear_post_data($r_val);
                            continue;
                        }
                    }
                    else{
                        $data =  str_replace(array('[', ']', '%5B', '%5D'), array('&#91;', '&#93;', '&#91;','&#93;',), $data);
                    }
                }
            }
            clear_post_data($_SERVER['REQUEST_URI']);
            clear_post_data($_GET);
            clear_post_data($_POST);
            $_REQUEST = array_merge($_REQUEST, $_GET);
            $_REQUEST = array_merge($_REQUEST, $_POST);
	}
        
        // set default MODX-user
        if($modx->user->id == 0){
            if($user = $modx->newObject('SocietyUser', $modx->user->toArray())){
                $modx->user = $user;
                $modx->user->set('id', 0);
            }
        }
        break;
    
    case 'OnPageNotFound':
        print "OnPageNotFound";
        exit;
        
        
        // $modx->sendForward(1);
        // exit;
        break;
    default:;
}