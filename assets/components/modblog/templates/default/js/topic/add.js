Blog.addTopic = new (function(){
    
    var self = this;
    
    this.init = function(){
        this.addListeners();
    }
    
    // Добавляем события
    this.addListeners = function(){
        // Навешиваем событие на селектор типа блогов
        this.addBlogTypeSelector();
    }
    
    // Обработчик выбора типа блога
    this.onTypeSelectorChange = function(){
        $('#blog_type_note_open').toggle();
        $('#blog_type_note_close').toggle();
    }
    
    // Навешиваем событие на селектор типа блогов
    this.addBlogTypeSelector = function(){
        $('#blog_type').live('change', this.onTypeSelectorChange);
    }
    
    $(document).ready(function(){
        self.init();
    });
    
    return this;
})();