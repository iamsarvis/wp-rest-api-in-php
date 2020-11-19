<?php 
require_once 'funct.php';

if(isset($_GET['id'])){
    $post_id = Get('id');
    $post = Json_Post_Id_Decoder($post_id);
    if($post == false){
        header("Location: $web/404.php");
		die();
    } else{
		// get info
		$the_title = $post->title->rendered;
		$the_content = $post->content->rendered;
		
		//get comments
		$comments = Get_Comment($post_id);
		
		// get media 
		$post_media = $post->featured_media;
		$featured_image = Get_media($post_media, 'large');
	}
}else{
	header("Location: $web/404.php");
}
?>
<?php require 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="article col-12">
			<img src="<?php echo $featured_image; ?>" />
			<h2 class="title"><?php echo $the_title; ?></h2>
			<div class="content">
				<?php echo $the_content; ?>
			</div>
		</div>
		<!-- do u have comment -->
<?php $have_comment = count($comments);
	if ($have_comment != 0) :
?>
		<div class="comments col-12">
			<h2>Comments</h2>
			<ul class="list-group list-group-flush">
				<?php
				
					
					foreach ($comments as $comment){
						
						if($comment->parent == 0){
							// set avatar size and get it (exist size : 24, 48, 96)
							$size_avatar = 96;
							$avatar = $comment->author_avatar_urls->$size_avatar;
							// get date and time
							$date = str_replace('T', ' ', $comment->date);
							$date = substr($date, 0, -3);

							echo '<li class="list-group-item">
							<img class="comment-avatar col-lg-1 col-md-2 col-3" src="'.
								$avatar. 
							'" alt="avatar">
							<div class="col-xl-11 col-lg-11 col-md-10 col-9"><div class="comment-header">
								<span class="comment-author">'.
									$comment->author_name .
								'</span>
								<span class="comment-date"> '. 
									$date
								.'</span>
							</div>'.
							'<div class="comment-content">'.
								$comment->content->rendered.
							'</div></div>';
							// first li is continue

							// get id parent
							$comment_id = $comment->id;

							foreach ($comments as $comment_child){
								if($comment_child->parent != 0 && $comment_id == $comment_child->parent){
									// get avatar it
									$avatar = $comment_child->author_avatar_urls->$size_avatar;
									// get date and time
									$date = str_replace('T', ' ', $comment_child->date);
									$date = substr($date, 0, -3);
									echo '<li class="child list-group-item">
									<img class="comment-avatar col-xl-1 col-lg-1 col-md-2 col-3" src="'.
										$avatar. 
									'" alt="avatar">
									<div class="col-xl-11 col-lg-11 col-md-10 col-9"><div class="comment-header">
										<span class="comment-author">'.
											$comment_child->author_name .
										'</span>
										<span class="comment-date"> '. 
											$date
										.'</span>
									</div>'.
									'<div class="comment-content">'.
										$comment_child->content->rendered.
									'</div></div>';
									
									// second li is continue

									// get id child
									$comment_id_child = $comment_child->id;
									
									// loop for display child 2
									foreach ($comments as $comment_child_2){
										if($comment_child_2->parent != 0 && $comment_id_child == $comment_child_2->parent){
											// get avatar it
											$avatar = $comment_child_2->author_avatar_urls->$size_avatar;
											// get date and time
											$date = str_replace('T', ' ', $comment_child_2->date);
											$date = substr($date, 0, -3);

											echo '<li class="child-2 list-group-item">
											<img class="comment-avatar col-xl-1 col-lg-1 col-md-2 col-3" src="'.
												$avatar. 
											'" alt="avatar">
											<div class="col-xl-11 col-lg-11 col-md-10 col-9"><div class="comment-header">
												<span class="comment-author">'.
													$comment_child_2->author_name .
												'</span>
												<span class="comment-date"> '. 
													$date
												.'</span>
											</div>'.
											'<div class="comment-content">'.
												$comment->content->rendered.
											'</div></div></li>';
										}
									}
									// end second li
									echo '</li>';
								}
							}
							// end first li
							echo '</li>';
						}
					}
				?>
			</ul>
		</div>
		<?php endif; // end have comment?>
	</div>
</div>
<?php include 'footer.php'; ?>