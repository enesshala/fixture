<?php
include_once '../config/dbconnection.php';
$posts = $connection->query("SELECT posts.*, users.username, users.user_profile FROM posts INNER JOIN users ON posts.post_author = users.user_id")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
	<!-- META TAGS -->
	<meta charset="UTF-8">
	<meta name="keywords" content="HTML, CSS, JavaScript, PHP, MYSQL">
	<meta name="description" content="Projekti per Inxhinieri t'Webit">
	<meta name="author" content="Fitim Bytyqi">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- TITLE -->
	<title>Groove App - BLOG</title>

	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/blog.css">

	<!-- FAVICON -->
	<link rel="icon" href="favicon.ico" type="image/ico">

	<!-- GOOGLE FONT -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">

	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>

	<?php include_once 'inc/preloader.php'; ?>

	<div class="container">
		<div class="parallax-window" data-parallax="scroll" data-image-src="assets/images/blog_banner.jpg">
			<div class="tm-header">
				<div class="row tm-header-inner">
					<div class="col-md-6 col-12">
						<div class="tm-site-text-box">
							<h1 class="tm-site-title">GROVE APP</h1>
							<h6 class="tm-site-description">|BLOG</h6>
						</div>
					</div>
					<nav class="col-md-6 col-12 tm-nav">
						<ul class="tm-nav-ul">
							<li class="tm-nav-li"><a href="index.php" class="tm-nav-link active">HOME</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<main>
			<?php foreach ($posts as $post) : ?>
				<article class="col-md-12">
					<div class="cards-1 section-gray">
						<div class="card card-blog">
							<div class="card-image">
								<img class="img" src="../admin/<?php echo $post['post_image']; ?>">
								<div class="ripple-cont"></div>
							</div>
							<div class="table">
								<h6 class="category text-success"><i class="fab fa-yelp"></i> <?php echo $post['post_category']; ?></h6>
								<h4 class="card-caption">
									<?php echo $post['post_title']; ?>
								</h4>
								<p class="card-description"><?php echo $post['post_description']; ?></p>
								<div class="ftr">
									<div class="author">
										<img src="../admin/<?php echo (is_file('../admin/' . $post['user_profile'])) ? $post['user_profile'] : '../admin/assets/img/anime3.png'; ?>" alt="user profile pic" class="avatar img-raised"> <span><?php echo $post['username']; ?></span>
									</div>
									<div class="stats"> <i class="fa fa-clock-o"></i> <?php echo $post['post_date']; ?></div>
								</div>
							</div>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</main>

		<footer class="tm-footer text-center">
			<p>Copyright &copy; 2020 - <?php Date("Y"); ?> GROOVE APP

				| Design: <a rel="nofollow" href="https://facebook.com/fitimbyttyqi" target="_blank">FITIM BYTYQI</a></p>
		</footer>
	</div>

	<script src="assets/js/blog/jquery.min.js"></script>
	<script src="assets/js/blog/parallax.min.js"></script>
	<script>
		$(document).ready(function() {
			// Handle click on paging links
			$('.tm-paging-link').click(function(e) {
				e.preventDefault();

				var page = $(this).text().toLowerCase();
				$('.tm-gallery-page').addClass('hidden');
				$('#tm-gallery-page-' + page).removeClass('hidden');
				$('.tm-paging-link').removeClass('active');
				$(this).addClass("active");
			});
		});
	</script>
</body>

</html>