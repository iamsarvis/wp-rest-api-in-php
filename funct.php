<?php
	$web = 'http://localhost/rest-api';
	$url = 'http://localhost/sarvis';
	$site_title = 'WP REST API';
	// get all posts and show
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
	// $media_size can be 'medium', 'large', 'thumbnail' or etc
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