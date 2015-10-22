<?php
/**
 * Visual Composer Eelement: WPML Languages
 * 
 */
add_shortcode('wpml_languages', 'ts_wpml_languages_func');

function ts_wpml_languages_func($atts, $content = null) {
	$html = null;

	if (function_exists('icl_get_languages')):

		ob_start();
		global $sitepress_settings;

		$skip_missing = 0;
		$languages = icl_get_languages('skip_missing=' . $skip_missing . '&orderby=KEY&order=DIR&link_empty_to=str');

		if (is_array($languages) && count($languages) > 0):
			$active_language = null;
			foreach ($languages as $language):
				if ($language['active'] == 1):
					if (isset($sitepress_settings['icl_lso_native_lang']) && $sitepress_settings['icl_lso_native_lang'] == 1):
						$active_language = $language['native_name'];
					elseif (isset($sitepress_settings['icl_lso_display_lang']) && $sitepress_settings['icl_lso_display_lang'] == 1):
						$active_language = $language['translated_name'];
					endif;

					break;
				endif;
			endforeach;
			?>

			<div class="btn-group language btn-select">
				<a class="btn dropdown-toggle btn-default" role="button" data-toggle="dropdown" href="#">
					<span class="hidden-xs"><?php _e('Language', 'progressive'); ?></span><span class="visible-xs"><?php _e('Lang', 'progressive'); ?></span><!-- 
					-->: <?php echo esc_html($active_language); ?>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<?php
					foreach ($languages as $language):
						$flag = '';
						if (isset($sitepress_settings['icl_lso_flags']) && $sitepress_settings['icl_lso_flags'] == 1):
							$flag = '<img src="' . esc_url($language['country_flag_url']) . '" />';
						endif;

						$language_name = '';
						if (isset($sitepress_settings['icl_lso_native_lang']) && $sitepress_settings['icl_lso_native_lang'] == 1):
							$language_name = $language['native_name'];
						endif;

						if (isset($sitepress_settings['icl_lso_display_lang']) && $sitepress_settings['icl_lso_display_lang'] == 1):
							if (!empty($language_name)):
								$language_name .= ' (' . $language['translated_name'] . ')';
							else:
								$language_name = $language['translated_name'];
							endif;
						endif;
						?>
						<li <?php echo ($language['active'] == 1 ? 'class="active"' : ''); ?>><a href="<?php echo esc_url($language['url']); ?>" title="<?php echo esc_attr($language['native_name']); ?>"><?php echo $flag; ?><?php echo esc_html($language_name); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>	
			<?php
		endif;

		$html = ob_get_contents();
		ob_end_clean();

	endif;
	return $html;
}
