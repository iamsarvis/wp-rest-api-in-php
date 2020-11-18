<?php
	require_once('settings.php');
	// get post or page or search or etc; query should set one of them
	function Json_Data_Decoder($query){
		global $url;
		$json = file_get_contents($url.'/wp-json/wp/v2/'. $query);
		$data = json_decode($json);
		return $data;
	}
	// get json post and decode
	function Json_Post_Id_Decoder ($id){
		global $url;
		$json = file_get_contents($url.'/wp-json/wp/v2/posts/'. $id);
		$post_id = json_decode($json);
		return $post_id;
	}
// get posts with pagination
	// count pages of posts
	function Count_Page(){
		global $pagination;
		$posts_count = Json_Data_Decoder('posts');
		$postscount = count($posts_count);
		$pagecount = $postscount/$pagination;
		$pagecount = ceil($pagecount);
		return $pagecount;
	}
	// get all post
	function Get_Posts($page){
		global $url;
		global $pagination;
		
		if($page <= Count_Page()){
			$json = file_get_contents($url.'/wp-json/wp/v2/posts?per_page='.$pagination.'&page='.$page);
			$posts = json_decode($json);
			return $posts;
		}else{
			header('Location: 404.php');
		}
	}
	// pagination posts
	function Pagination(){
		global $web;
		global $pagination;
		$i = 1;
		$pagecount = Count_Page();
		if($pagecount > 1){
			while($i <= $pagecount){
				if($i == 1){
					echo '
					<li class="page-item"><a href="'.$web.'" class="page-link">'.$i.'</a></li>
					';
				}else{
				echo '
					<li class="page-item"><a href="'.$web.'/index.php?page='.$i.'" class="page-link">'.$i.'</a></li>
				';
				}
				$i++;
			}
		}else{
			return 0;
		}
	}
	//get site title and post title
	function Get_Title(){
		if(isset($_GET['id'])){
			global $url;
			$post = Json_Post_Id_Decoder ($_GET['id'], $url);
			$the_title = $post->title->rendered;
			echo $the_title;
		}else{
			global $site_title;
			echo $site_title;
		}
	}
	//get media
	// $size can be 'large', 'medium', 'thumbnail' or another image size of wordpress
	function Get_Media($post_media, $size){
		global $url;
		$json = file_get_contents($url.'/wp-json/wp/v2/media?include='.$post_media);
		$medias = json_decode($json);
		$featured_image = $medias[0]->media_details->sizes->$size->source_url;
		return $featured_image;
	}
	
	// get comments
	function Get_Comment ($post_id){
		global $url;
		$json = file_get_contents($url.'/wp-json/wp/v2/comments?post='.$post_id.'&orderby=date');
		$comments = json_decode($json);
		return $comments;
	}

	// search in posts
	function Search($searchtext){
		global $url;
		$json = file_get_contents($url.'/wp-json/wp/v2/search?search='. $searchtext);
		$search_results = json_decode($json);
		return $search_results;
	}
	
	
?>