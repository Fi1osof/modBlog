<div class="ADD">
    <div><h3 class="title">Создать топик</h3></div>
    
    <div class="container add">
        <div class="errors">[[+ErrorMessage:notempty=`<h3>[[+ErrorMessage]]</h3>`]]</div>
        <div class="errors">[[+errors]]</div>
        <form method="post" action="">
            
            <div class="field">
                <label for="topic_blog" class="block">В какой блог публикуем?</label>
                [[!BLOG_Widget_blogList?
                    &tagname=`topic_blog`
                    &tagid=`topic_blog`
                    &tagclass=`input-width-200`
                    &current=`[[+topic_blog]]`
                ]]
                <small class="note block" ></small>
            </div>
            
            
            <div class="field">
                <label for="topic_title" class="block">Заголовок:</label>
                <input id="topic_title" class="input-text input-width-full" type="text" value="[[+topic_title]]" name="topic_title">
                <small class="note block">Заголовок должен быть наполнен смыслом, чтобы можно было понять, о чем будет топик.</small>
            </div>
            
            
            <div class="field">
                <label for="topic_text" class="block">Текст:</label>
                <textarea class="input-text input-width-full " rows="15" id="topic_text" name="topic_text">[[+topic_text]]</textarea>
            </div>
            
            <div class="field">
                <label for="topic_tags" class="block">Теги:</label>
                <input id="topic_tags" name="topic_tags" value="[[+topic_tags]]" class="input-text input-width-full" type="text">
                <small class="note block">Теги нужно разделять запятой. Например: google, вконтакте, кирпич</small>
            </div>
             
            
            <div class="field">		
                <input type="submit" value="Сохранить" name="save_blog"/>
            </div>
            
        </form>
    </div>
</div>