<section class="sidebar col-lg-3">
    <div class="categories">
        <h4>Categories</h4>
        <ul class="list-group">
        <?php
            $categories = Json_Data_Decoder('categories');
            foreach($categories as $category){
                $parent = $category->parent;
                if($category->parent == 0){
                    $category_id = $category->id;
                    echo '
                    <a href="'.$web.'/category.php?id='.$category_id.'"><li class="list-group-item d-flex justify-content-between align-items-center">
                        '.$category->name.'
                        <span class="badge badge-primary badge-pill">'.$category->count.'</span>
                    </li></a>';

                    $category_parent = $category->id;
                    foreach($categories as $category_child){
                        if($category_child->parent != 0 && $category_parent == $category_child->parent){
                            $category_child_id = $category_child->id;
                            echo '
                            <a href="'.$web.'/category.php?id='.$category_child_id.'"><li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center">
                                - '.$category_child->name.'
                                <span class="badge badge-primary badge-pill">'.$category_child->count.'</span>
                            </li></a>';
                        }
                        
                    }
                }
            }
        ?>
        </ul>
    </div>
</section>
