<?php
	require 'funct.php';
	require 'header.php'; 
?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class=" panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">صفحه درخواستی شما یافت نشد</h3>
						<span style="margin-top: -15px;" class="pull-left">
							 
						</span>
					</div>
					<div class="panel-body">
						<p class="alert alert-danger">
							کاربر گرامی صفحه یا مطلب درخواستی شما یافت نشد
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">اخرین مطالب</h3>
					</div>
					<div class="panel-body">
						<ul class="posts-list">
						<?php
						// $latest=get("posts",10);
						// while($post=mysql_fetch_assoc($latest)): ?>
							<li ><a href="view.php?p=<?php // echo $post['post_ID']; ?>"><?php //echo $post['post_title']; ?></a></li>
						<?php // endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
	  </div>
  </div>
</body>
</html>