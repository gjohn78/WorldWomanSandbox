<?php
/**
 * Visual Composer Eelement: sitemap
 * 
 */
add_shortcode('sitemap', 'ts_sitemap_func');

function ts_sitemap_func($atts) {
	extract(shortcode_atts(array(
		'sitemap' => '',
					), $atts));


	$html = '';


	ob_start();
	?>
	<ul class="sitemap">
		<?php
		switch ($sitemap) {

			case 'pages':
				wp_list_pages("title_li=");
				break;

			case 'posts':

				$archive_query = new WP_Query('showposts=1000&cat=-8');
				while ($archive_query->have_posts()) : $archive_query->the_post();
				endwhile;
				break;

			case 'archives':
				wp_get_archives('type=monthly&show_post_count=true');
				break;

			default:
				wp_list_pages("title_li=");
				break;
		}
		?>
	</ul>


	<?php
	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
