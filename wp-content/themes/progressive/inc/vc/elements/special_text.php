<?php

/**
 * Visual Composer Eelement: Special Text
 * 
 */
add_shortcode('special_text', 'special_text_func');

function special_text_func($atts, $content = null) {

	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		"tagname" => 'h1',
		"pattern" => 'no',
		"color" => '',
		"font_size" => '',
		"font_weight" => '',
		"font" => '',
		"margin_top" => '',
		"margin_bottom" => '',
		"align" => 'left',
		"replace" => '',
		"replace_with" => '',
		"replace_with" => '',
		"rotating_style" => 'solid',
		"rotating_color" => '',
		"rotating_text_color" => ''
					), $atts));

	$classes = array();
	$classes[] = 'special-text';
	$styles = array();

	if (empty($tagname)) {
		$tagname = 'span';
	}

	if (!empty($animation)) {
		$classes[] = ts_get_animation_class($animation);
	}

	if ($pattern == 'yes') {
		$classes[] = 'special-text-pattern';
	}

	if (!empty($color)) {
		$styles[] = "color: " . $color;
	}

	if (intval($font_size)) {
		$styles[] = "font-size: " . esc_attr($font_size) . "px";
	}

	if (!empty($font_weight) && $font_weight != 'default') {
		$styles[] = "font-weight: " . esc_attr($font_weight);
	}

	if (!empty($font)) {
		$font = str_replace('google_web_font_', '', $font);

		if ($font != 'default') {
			$styles[] = "font-family: " . esc_attr($font);
		}
	}

	if (intval($margin_top)) {
		$styles[] = "margin-top: " . esc_attr($margin_top) . "px";
	}

	if (intval($margin_bottom)) {
		$styles[] = "margin-bottom: " . esc_attr($margin_bottom) . "px";
	}

	if (!empty($align)) {
		$styles[] = "text-align: " . esc_attr($align);
	}

	$classes_html = '';
	if (is_array($classes) && count($classes) > 0) {
		$classes_html = 'class="' . implode(' ', $classes) . '"';
	}

	$styles_html = '';
	if (is_array($styles) &&  count($styles) > 0) {
		$styles_html = 'style="' . implode(';', $styles) . '"';
	}

	//apply rotating text
	if (!empty($replace) && strpos($content, $replace) && !empty($replace_with)) {

		$texts = explode("\n", $replace_with);
		if (is_array($texts) && count($texts) > 0) {
			$rotating_text_items = '';
			foreach ($texts as $text) {
				$text = preg_replace('/^\s+|\n|\r|\s+$/m', '', $text); //remove line breaks
				if (empty($text)) {
					continue;
				}
				$rotating_text_items .= '<span>' . $text . '</span>';
			}
			if (!empty($rotating_text_items)) {

				$rotating_styles = array();
				$rotating_styles_outlined = array();
				if (!empty($rotating_color)) {
					$rotating_styles[] = 'background-color: ' . esc_attr($rotating_color);
					$rotating_styles_outlined[] = 'border-color: ' . esc_attr($rotating_color);
				}
				if (!empty($rotating_text_color)) {
					$rotating_styles[] = 'color: ' . esc_attr($rotating_text_color);
					$rotating_styles_outlined[] = 'color: ' . esc_attr($rotating_text_color);
				}

				$rotating_styles_html = '';
				$rotating_class = '';

				if ($rotating_style == 'outlined' && count($rotating_styles_outlined) > 0) {
					$rotating_styles_html = 'style="' . implode(';', $rotating_styles_outlined) . '"';
					$rotating_class = 'border';
				} else if (count($rotating_styles_outlined) > 0) {
					$rotating_styles_html = 'style="' . implode(';', $rotating_styles) . '"';
				}

				$rotating_text = '
					<span class="word-rotate ' . sanitize_html_class($rotating_class) . '" ' . $rotating_styles_html . '>
						<span class="words-box">
							' . $rotating_text_items . '
						</span>
					</span>';
			}
			$content = str_replace($replace, $rotating_text, $content);
		}
	}
	return '<' . esc_attr($tagname) . ' ' . $classes_html . ' ' . $styles_html . ' ' . ts_get_animation_data_class($animation_delay, $animation_iteration) . '>' . $content . '</' . esc_attr($tagname) . '>';
}
