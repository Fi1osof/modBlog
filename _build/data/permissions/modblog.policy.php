<?php

$permissions = array();


$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'add_children',
    'description' => 'Добавлять любые ресурсы как дочерние указанного ресурса или добавлять элементы в категории.',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'list',
    'description' => 'Возможность «list» любого объекта. «List» означает получить колекцию объектов.',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'load',
    'description' => 'Возможность «загружать» объекты.',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'moderate_blogs',
    'description' => 'perm.moderate_blogs_desc',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'new_document_in_root',
    'description' => 'Создавать ресурсы в корне.',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'publish_document',
    'description' => 'Публиковать или отменять публикацию ресурсов',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'save',
    'description' => 'Возможность «сохранять» объекты.',
    'value' => true,
)); 

$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'view',
    'description' => 'Возможность «просмотра» объектов.',
    'value' => true,
)); 


return $permissions;