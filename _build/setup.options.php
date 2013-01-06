<?php


switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
         
        $warn = '';
        
        if(!$modx->user->get('sudo')){
            $warn = <<<HTML
            <div style="margin: 20px 0; color:red; font-weight: bold;">
                <h3>Внимание!</h3>
                <p>Вы не являетесь SUDO-пользователем. Пожалуйста, задайте пользователю права SUDO. </p>
                <p>В противном случае возникнут проблемы при создании и обновлении контекстов.</p>
</div>
HTML;
        }
        
        
$output = <<<HTML
{$warn}
<p><input type="button" value="Дополнительные параметры" onClick="1==1  ?  window.BlogInstaler = new (function(){
    var self = this;

    this.toggle = function(){}
    
    this.init  = function(){
        this.paramsBlock = Ext.get('paramsBlock');
        this.paramsBlock.show();
    } 
    
    this.showContextCombo = function(){
        if(!this.contextCombo){
            this.contextCombo = new MODx.Panel({
                border: false,
                renderTo: Ext.get('exsistingContext'),
                items: [{
                    xtype: 'label',
                    text: 'Выбрать контекст'
                },{
                    xtype: 'modx-combo-context'
                    ,id: 'modx-ugc-context-filter'
                    ,width: 300
                    ,name:'exsistingContext'
                    ,emptyText: ''
                    ,allowBlank: true
                    ,listeners: {
                        'select': function(){}
                    }
                }]
            });
        }
        this.contextCombo.show();
    }
    
    this.hideContextCombo = function(){
        if(!this.contextCombo){return;}
        this.contextCombo.hide();
    }

    this.showNewContextField = function(){
        if(!this.newContextField){
            this.newContextField = new Ext.Panel({
                border: false,
                renderTo: Ext.get('newContext')
                ,items:[{
                    xtype: 'label'
                    ,text: 'Название контекста'
                },{
                    xtype: 'textfield'
                    ,name: 'newContextName'
                }]
            })
        }
        this.newContextField.show();
    }
    
    this.hideNewContextField = function(){
        if(!this.newContextField){return;}
        this.newContextField.hide();
    }

    this.toggleContextForm = function(el){
        switch(el.value){
           case 'new':
               self.hideContextCombo();
               self.showNewContextField();
               break;
           case  'exists':
               self.hideNewContextField();
               self.showContextCombo();
               break;
           case 'none':
               self.hideContextCombo();
               self.hideNewContextField();
               break;
           default:;
        }
    }

    this.init();
})() : window.BlogInstaler.toggle();"/></p>   



<div id="paramsBlock" style="margin: 10px 0 0; visibility: hidden;">
    <div>    
        <p><input type="radio" style="margin:  5px 0;" name="contextAction" value="none" onChange="window.BlogInstaler.toggleContextForm(this)" checked="checked" />Оставить без изменений</p>
        <p><input type="radio" style="margin:  5px 0;" name="contextAction" value="new" onChange="window.BlogInstaler.toggleContextForm(this)" />Создать новый контекст</p>
        <p><input type="radio" style="margin:  5px 0;" name="contextAction" value="exists" onChange="window.BlogInstaler.toggleContextForm(this)" />Обновить существующий</p>
     </div>
</div>
<div id="contextsBlock">
    <div id="exsistingContext"></div>
    <div id="newContext"></div>
</div>

HTML;
    break;
    case xPDOTransport::ACTION_UNINSTALL: break;
}

return $output;