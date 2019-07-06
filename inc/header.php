<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
include_once ($filepath.'/../classes/Post.php');
include_once ($filepath.'/../classes/Category.php');
include_once ($filepath.'/../classes/Slogan.php');
$db = new Database();
$fm = new Format();
$pst = new Post();
$cat = new Category();
$slo = new Slogan();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Basic Website</title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
<style>#det_lie{padding:0px 10px;background:red;color:#fff;text-decoration:none;margin-top:10px;}</style>
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
			<?php
			$slogan = $slo->get_slogan();
			if($slogan){
			while($val = $slogan->fetch_assoc()){ ?>
				<img src="admin/upload/<?php echo $val['image'];?>" alt="Logo"/>
				<h2><?php echo $val['title'];?></h2>
				<p><?php echo $val['slogan'];?></p>
				<?php }} ?>
			</div>
		</a>
		<div class="social clear">
		<?php
			  $soc = $slo->get_social();
			  if($soc){
			  while($val = $soc->fetch_assoc()){ 
		?>
			<div class="icon clear">			
				<a href="<?php echo $val['fa'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $val['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $val['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $val['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
		<?php }}?>	
			<div class="searchbtn clear">
			<form action="" method="post">
				<input type="text" name="keyword" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a id="active" href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>	
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>
