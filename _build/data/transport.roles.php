<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$roles = array();

$role = $modx->newObject('modUserGroupRole', array(
    'name'          => 'Blog Administrator',
    'description'   => 'Blog Administrator role',
    'authority'     => 3000
));
$roles[] = $role;

$role = $modx->newObject('modUserGroupRole', array(
    'name'          => 'Blog Moderator',
    'description'   => 'Blog Moderator role',
    'authority'     => 4000
));
$roles[] = $role;

return $roles;

?>
