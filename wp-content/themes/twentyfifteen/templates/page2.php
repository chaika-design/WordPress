<?php
/**
 * Template Name: Test Page
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

$array_course = array('Aコース' => 'Aコース', 'Bコース' => 'Bコース', 'Cコース' => 'Cコース');
foreach($array_course as $key => $value){
	$coursestr .= '<option value="'.$key.'">'.$value.'</option>';
}
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<script type='text/javascript'>
jQuery(function(){
	console.log('<?php echo $coursestr; ?>');
	jQuery('select.course').append('<?php echo $coursestr; ?>');
	jQuery.ajax({
		url: '<?php echo get_template_directory_uri();?>/test/test.html',
		dataTyle: 'html',
		type: 'get'
	}).done(function(res){
		jQuery('body').append(res);
	});
});
</script>
<?php get_footer(); ?>
