<?php
/**
 * Shortcode Title: Tabs
 * Shortcode: tabs
 * Usage: [tabs  orientation="horizontal"  animation="fadein"][tab url="http://test.com" target="_blank"]Your text here...[/tab][/tabs]
 */
add_shortcode('tabs', 'ts_tabs_func');

function ts_tabs_func( $atts, $content = null ) {

	$oArgs = ThemeArguments::getInstance('ts_tabs_func');
	
	//[tabs ]
	extract(shortcode_atts(array(
		'animation' => '',
		'animation_delay' => '',
		'animation_iteration' => '',
		'style' => 'horizontal',
	    'animation' => '',
    ), $atts));

	switch ($style) {
		case 'tabs_left':
			$class = 'tabs-left';
			break;
		case 'tabs_right':
			$class = 'tabs-right';
			break;
		default:
			$class = '';
	}

	$oArgs -> set('shortcode_tabs', array());
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
	$shortcode_tabs = $oArgs -> get('shortcode_tabs');
	$tabs_nav = '';
	$tabs_content = '';
	
	$ts_tab_it = (int)$oArgs -> get('ts_tab_it') + 1;
	ob_start();
	?>
	
	<div class="tabs <?php echo esc_attr($class); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay,$animation_iteration); ?>>
		<ul class="nav nav-tabs">
			<?php 
			$i = 0;
			if (is_array($shortcode_tabs)):
				foreach ($shortcode_tabs as $tab): $i++; ?>
					<li <?php echo ($i == 1 ? 'class="active"' : ''); ?>>
						<a href="#tstab<?php echo esc_attr($ts_tab_it + $i); ?>" data-toggle="tab"><?php echo (!empty($tab['icon']) ? '<i class="'.sanitize_html_class($tab['icon']).'"></i>' : '')?> <?php echo esc_html($tab['title']); ?></a>
					</li>
				<?php endforeach; 
			endif; ?>
		</ul>
		<div class="tab-content">
			<?php
			$i = 0;
			if (is_array($shortcode_tabs)):
				foreach ($shortcode_tabs as $tab): $i++; $ts_tab_it++; ?>
					<div class="tab-pane <?php echo ($i == 1 ? 'active' : ''); ?> fade in" id="tstab<?php echo esc_attr($ts_tab_it); ?>">
						<?php echo wp_kses_post($tab['content']); ?>
					</div>
				<?php endforeach;
			endif; ?>
		</div>
	</div>
	
	<?php
	$oArgs -> set('ts_tab_it', $ts_tab_it);
	
	$html = ob_get_contents();
	ob_clean();
	return $html;
}

/**
 * Shortcode Title: Tab - can be used only with tabs shortcode
 * Shortcode: tab
 * Usage: [tabs][tab label="New 1"]Your text here...[/tab][/tabs]
 */
add_shortcode('tab', 'ts_tab_func');
function ts_tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title' => '',
	    'icon' => 'no'
    ), $atts));
    
	$oArgs = ThemeArguments::getInstance('ts_tabs_func');
	$shortcode_tabs = $oArgs -> get('shortcode_tabs');
	if (!is_array($shortcode_tabs)) {
		$shortcode_tabs = array();
	}
    $shortcode_tabs[] = array('title' => $title, 'icon' => $icon, 'content' => trim(do_shortcode($content)));
	$oArgs -> set('shortcode_tabs', $shortcode_tabs);
}