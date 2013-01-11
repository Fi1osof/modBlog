<?php

/*print '<pre>';
// print_r($modx->context->findPolicy());
print_r($_SESSION);*/

$output = ''; 

$where = array(
    'SocietyTopic.published' => true,
    'SocietyTopic.deleted' => false,
    'SocietyTopic.hidemenu' => false,
);

$q = $modx->newQuery('SocietyTopic');
$q->innerJoin('modUser', 'CreatedBy', 'SocietyTopic.createdby=CreatedBy.id'); 


/*
 * By blog ID
 */
if($blog_id){
    $q->innerJoin('SocietyBlogTopic', 'TopicBlogs');
    $q->innerJoin('SocietyBlog', 'Blog', "TopicBlogs.blogid=Blog.id 
    AND Blog.published = '1' AND Blog.deleted = '0' AND Blog.hidemenu = '0'");
    $where['Blog.id'] = $blog_id;
}

/*
 * By user ID
 */
if($user_id){
    $where['CreatedBy.id'] = $user_id;
}

$q->where($where);

$q->select(array(
    'SocietyTopic.*',
    'CreatedBy.username',
));
 
$q->sortby('publishedon', 'DESC');

if(!$topics = $modx->modblog->getTopics($q)){
    return 'Сюда еще никто не написал';
}

foreach($topics as $topic){
    $blogsStr  = '';
    if($topicBlogs = $topic->getMany('TopicBlogs')){
        $blogs = array();
        foreach($topicBlogs as $topicBlog){
            if($blog = $topicBlog->getOne('Blog', array(
                'published' => true,
                'deleted'   => false,
                'hidemenu'  => false,
                'id'        => $topicBlog->get('blogid'),
            ))){
                $url = $modx->makeUrl($blog->get('id'));
                $blogTitle = $blog->get('pagetitle');
                $blogs[] = '<a href="'.$url.'">'.$blogTitle.'</a>';
            }
            $blogsStr = implode(", ", $blogs);
        }
    }
    if(!$blogsStr){
        $blogsStr = '<a href="/profile/'.$topic->get('username').'/created/topics/">Блог им. '. $topic->get('username').'</a>';
    }
    
    
    $options = array(
        'title'     => $topic->get('pagetitle'),
        'author'    => $topic->get('username'),
        'topic_url' => $topic->makeUrl(),
        'content'   => $topic->get('content'),
        'blogs'     => $blogsStr,
    );
    
    $output .= $modx->getChunk('BLOG_topicListTpl', $options);
}

return $output;