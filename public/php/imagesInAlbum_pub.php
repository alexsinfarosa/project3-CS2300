<?php require_once '../../incs/session.php'; ?> 
<?php require_once '../../incs/config.php'; ?> 
<?php require_once '../../incs/functions.php'; ?>
<?php include '../../incs/layout/header_pub.php'; ?>


<!-- Perform database query -->
<?php
	$album_id = $_GET['album_id'];

	$query  = "SELECT DISTINCT images.image_url, images.image_caption, images.image_date_taken, images_in_albums.album_id, images_in_albums.image_id ";
	$query .= "FROM images_in_albums ";
	$query .= "INNER JOIN images ";
	$query .= "ON images.image_id = images_in_albums.image_id ";
	$query .= "WHERE images_in_albums.album_id = $album_id ";
	$query .= "ORDER BY image_id DESC";

	
	$imagesInAlbum = $mysqli -> query($query);

	// Check for query errrors
	confirm_query($imagesInAlbum);

?>

<!-- Displaying the images -->
<div class="col-12">
	<div class="container">
		<?php 
		while($image = mysqli_fetch_assoc($imagesInAlbum)) {
		?>
			<figure class="text-center bottom-margin">
				<img class="img-responsive round-borders" src="../img/<?php echo $image["image_url"]; ?>" alt="<?php echo $image["image_caption"] ?>">
				<figcaption>
					<span class="author">Image Caption:</span> <?php echo $image["image_caption"]; ?>
					<br>
					<span class="author">Date Taken:</span> <?php echo $image["image_date_taken"]; ?>
				</figcaption>	
			</figure>
		<?php  
		}
		?>
	</div>
</div>

<?php include '../../incs/layout/footer.php'; ?>