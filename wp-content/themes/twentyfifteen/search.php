<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php if(isset($_GET['low']) && isset($_GET['high'])): ?>
<?php
//値を取得
$compare = 'BETWEEN';
$s = $_GET['s'];
$low = intval($_GET['low']);
$high = intval($_GET['high']);
if($high > 0) {
	$value = array( $low, $high );
} else {
	$value = $low;
	$compare = '>=';
}
//meta_query用
$metaquerysp[] = array(
            'key'     => 'price',
            'value'   => $value,
            'compare' => $compare,
            'type'    => 'NUMERIC',
            );
?>
<?php
$cutomSearchPosts = new WP_Query(array(
  'post_type' => 'book',
  'meta_query' => $metaquerysp,
  's' => $s,
));
?>
<!--ここから表示-->
<?php if ( $cutomSearchPosts->have_posts() ) : while ( $cutomSearchPosts->have_posts() ) : $cutomSearchPosts->the_post(); ?>
	<?php get_template_part( 'content', 'search' ); ?>
<?php endwhile; wp_reset_postdata(); else : ?>
該当なし
<?php endif; ?>
<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfifteen' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
