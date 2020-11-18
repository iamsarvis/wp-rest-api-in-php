<?php require 'funct.php'; ?>
<?php require 'header.php'; ?>

<div class="container">
	<div class="row">
		<section class="posts col-lg-9">
			<div class="row">
			<?php
			// get page id and check it, set default page
			if(isset($_GET['page'])){
				$page = htmlentities($_GET['page']);
			}else{
				$page = 1;
			}
			
				// get posts with pagination
				$posts = Get_Posts($page);
					foreach ($posts as $post){
						// get post id
						$post_id = $post->id;
						// get post media 
						$post_media = $post->featured_media;
						// get media 
						$featured_image = Get_media($post_media, 'medium');
						
						echo 
						'<article class="post col-12">
						<div class="row">
							<div class="post-thumbnail col-lg-4">
								<img src="'.
									$featured_image.
								'">
							</div>';
							
							// get date
							$date = str_replace('T', ' ', $post->date);
							$date = substr($date, 0, -3);
							echo 
							'<div class="post-meta col-lg-8">
								<div class="post-title">
									<a href="'. $web .'/post/' . $post_id .'"><h2>' . $post->title->rendered . '</h2></a>
								</div>
								<div class="post-date">' .
									$date .
								'</div>
							</div>
						</div></article>';
						
					}
					//pagination
					echo '<ul class="pagination mx-auto">';
						Pagination();
					echo '</ul>';
			?>
			</div>
		</section>
		<?php include 'sidebar.php'; ?>
	</div>
</div>

<?php include 'footer.php'; ?>