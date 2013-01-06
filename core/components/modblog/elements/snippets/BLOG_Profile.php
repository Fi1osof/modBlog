<?php
if(empty($modx->user) || empty($modx->user->Profile)){return ;}
$value = '';
switch($field){
    case '':
        break;
    default: $value=$modx->user->Profile->get($field);
}
return $value;