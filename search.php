<?php

require 'funct.php';
require 'header.php';
?>
<div class="container">
<div class="row">
	<section class="col-lg-9">
	<?php
	if(!empty($_GET['searchtext'])){
		$searchtext = Get('searchtext');
		$search_results = Search($searchtext);
		$has_existed = count($search_results);
		if($has_existed != 0){
			echo 
			'<div class="col-12 mb-4 panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Result(s) for "'. $searchtext .'" : ('.$has_existed.')
					</h3>
				</div>
			</div>
			';
			foreach ($search_results as $search_result){
			echo 
			'<article class="post col-12">
			<div class="row"> ';
				$id = $search_result->id;
				// check for post or page
				$page = "Post";
				if($search_result->subtype == 'page'){
					$page = "Page";
				}
				echo 
				'<div class="post-meta col-12">
					<div class="post-title">
						'.$page.'<a href="'. $web .'/post/' .$id .'"><h2>' . $search_result->title . '</h2></a>
					</div>
				</div>
			</div></article>';
			}
		}else{
			echo '
			<div class="col-12">
			<div class=" panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nothing Not Found!</h3>
				</div>
				<div class="panel-body">
					<p class="alert alert-danger">
						Dear User, The "'. $searchtext .'"  could not be found!
						Search everyword else
					</p>
				</div>
			</div>
			</div>
			';
		}

	}elseif(!isset($_GET['searchtext'])){
		header('Location:' .$web );
	}else{
		echo '
			<div class="col-lg-9">
			<div class=" panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nothing Not Found!</h3>
				</div>
				<div class="panel-body">
					<p class="alert alert-danger">
						You did not enter any text.	Enter at least one word to search.
					</p>
				</div>
			</div>
			</div>
			';
	}
	?>
	</section>
<?php 
	include 'sidebar.php';
?>
</div>
</div>