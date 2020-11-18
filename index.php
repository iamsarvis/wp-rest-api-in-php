<?php require 'funct.php'; ?>
<?php require 'header.php'; ?>

<div class="container">
	<div class="row">
		<section class="posts col-lg-9">
			<div class="row">
			<?php 
				$posts = Json_Data_Decoder('posts');
					
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
			?>
			</div>
		</section>
		<?php include 'sidebar.php'; ?>
	</div>
</div>

<?php include 'footer.php'; ?>