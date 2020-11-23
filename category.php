<?php
    require_once 'funct.php';
    if(isset($_GET['cat'])){
        $category_id = Get('cat');
        $category = Json_Data_Decoder('categories/'.$category_id);
        if($category == false){
            header("Location: $web/404.php");
            die();
        } else{
            $category_name = $category->name;
        }
    }else{
        header("Location: $web/404.php");
    }
    include 'header.php';
?>

<div class="container">
	<div class="row">
        <div class="col-lg-9">
            <?php
                echo '<h2 class="mb-4">Category : '.$category_name.'</h2>';
                $posts = Json_Data_Decoder('posts');
                foreach($posts as $post){
                    $category_count = count($post->categories);
                    $i = 0;
                    while($category_count >= $i){
                        if(isset($post->categories[$i])){
                            $category_post = $post->categories[$i];
                            if($category_id == $category_post){
                                $date = str_replace('T', ' ', $post->date);
                                $date = substr($date, 0, -3);
                                echo '<div class="row mt-2">
                                <div class="col-4">'.
                                    '<img src="' . $featured_image = Get_media($post->featured_media, 'medium'). '" />' .
                                '</div>
                                <div class="col-8">
                                    <a href="'.$web. '/post/' .$post->id.'">
                                        <h4>'.
                                        $post->title->rendered.
                                        '</h4>
                                    </a>'.
                                    // get date and time
                                        $date .
                                '</div></div>';
                            }
                        }
                        $i++;
                    }
                }
            ?>
        </div>
    <?php 
    // include sidebar
    include 'sidebar.php';
    ?>
    </div>
</div>

<?php
    include 'footer.php';
?>