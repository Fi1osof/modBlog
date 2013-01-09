<div class="ADD">
    <div><h3 class="title">Создать топик</h3></div>
    
    <div class="container add">
        <div class="errors">[[+ErrorMessage:notempty=`<h3>[[+ErrorMessage]]</h3>`]]</div>
        <div class="errors">[[+errors]]</div>
        <form method="post" action="">
            
            <div class="field">
                <label for="topic_blog" class="block">В какой блог публикуем?</label>
                [[!BLOG_Widget_blogList]]
                <div id="blogTypeDescription">
                    <small class="note block" id="blog_type_note_open" ></small>
                </div>
            </div>
            
            
            <div class="field">
                <label for="blog_title" class="block">Название блога:</label>
                <input id="blog_title" class="input-text input-width-full" type="text" value="[[+blog_title]]" name="blog_title">
                <small class="note block">Название блога должно быть наполнено смыслом, чтобы можно было понять, о чем будет блог.</small>
            </div>
            
            <div class="field">
                <label for="blog_url" class="block">URL блога:</label>
                <input id="blog_url" name="blog_url" value="[[+blog_url]]" class="input-text input-width-full" type="text">
                <small class="note block">URL блога, по которому он будет доступен. Может содержать только буквы латинского алфавита, цифры, дефис; пробелы будут заменены на "_". По смыслу URL  должен совпадать с названием блога, после его создания редактирование этого параметра будет недоступно</small>
            </div>
            
            
            
            <div class="field">
                <label for="blog_description" class="block">Описание блога:</label>
                <textarea class="input-text input-width-full " rows="15" id="blog_description" name="blog_description">[[+blog_description]]</textarea>
            </div>
            
            <div class="field">
                <label for="blog_limit_rating_topic" class="block">Ограничение по рейтингу:</label>
                <input id="blog_limit_rating_topic" name="blog_limit_rating_topic" value="[[+blog_limit_rating_topic]]" class="input-text input-width-100" type="text">
                <small class="note block">Рейтинг, который необходим пользователю, чтобы написать в этот блог</small>
            </div>
            
            <div class="field">		
		<label for="avatar">Аватар:</label>
		<input type="file" id="avatar" name="avatar">
            </div>
            
            <div class="field">		
                <input type="submit" value="Сохранить" name="save_blog"/>
            </div>
            
        </form>
    </div>
</div>