<?php
/**
 * Visual Composer Eelement: sitemap
 * 
 */
add_shortcode('sitemap', 'ts_sitemap_func');

function ts_sitemap_func($atts) {
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'sitemap' => '',
	), $atts));

	$html = '';

	ob_start();
	?>
	<ul class="sitemap <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
	<?php
	switch ($sitemap) {
		case 'pages':
			wp_list_pages("title_li=");
			break;
		
		case 'posts':
			$archive_query = new WP_Query('showposts=1000&cat=-8');
			while ($archive_query->have_posts()) : $archive_query->the_post();
				?>
					<li>
						<a href="<?php echo esc_url(get_the_permalink()); ?>" rel="bookmark" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>

					</li>
				<?php
				endwhile;
				break;

			case 'categories':
				wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&feed=RSS');
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
	