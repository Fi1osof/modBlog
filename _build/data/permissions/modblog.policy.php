<?php

$permissions = array();
$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'moderate_blogs',
    'description' => 'perm.moderate_blogs_desc',
    'value' => true,
)); 


return $permissions;