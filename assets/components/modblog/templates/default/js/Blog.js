var Blog = new(function(options){
    var self = this;
    this.options = options || {};
    
    this.init = function(){
        this.addListeners();
    }
    
    this.addListeners = function(){
        // Create
        $('.blogModalOpener').live('click', function(e){
            self.openModalWindow($(this).attr('rel'));
        });
        
        $('.blogModalWindow .close').live('click', function(e){
            $(this).parents('.blogModalWindow').hide();
        });
    }
    
    this.openModalWindow = function(id){
        if(!id){return false;}
        var win = $('#' + id);
        if(!win[0]){return;}
        
        
        win.css({
            'min-width': 400
        });
        
        var h = $(window).height();
        var w = $(window).width();
        
        var top = h/4 ;
        if(top < 50){ top = 50}
        
        var left = w/2 - win.width()/2;
        if(left < 50){ left = 50;}
        
        win.css({
            top: top,
            left: left
        });
        win.show();
    }
    
    $(document).ready(function(){
        self.init();
    });
})({});