<?php

$groups = array();
$child_groups = array();

$blog_admin_group = $modx->newObject('modUserGroup', array(
    'id'            => 0,
    'name'          => 'Blog Administrators',
    'description'   => 'Администраторы Блога',
));
$child_groups[] = $blog_admin_group;

$blog_member_group = $modx->newObject('modUserGroup', array(
    'id'            => 0,
    'name'          => 'Blog Members',
    'description'   => 'Участники Блога',
));
$child_groups[] = $blog_member_group;


$blog_moders_group = $modx->newObject('modUserGroup', array(
    'id'            => 0,
    'name'          => 'Blog Moderators',
    'description'   => 'Модераторы Блога',
));
$child_groups[] = $blog_moders_group;


/* Main group */
$blog_group = $modx->newObject('modUserGroup', array(
    'id'            => 0,
    'name'          => 'Blog',
    'description'   =>  'Общая группа без прав',
    'dashboard'     => 0,
));

$blog_group->addMany($child_groups, 'Children' );

$groups[] =  $blog_group;

return $groups;
?>
