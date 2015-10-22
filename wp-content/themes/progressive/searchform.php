<?php
/**
 * The template for displaying search forms in progressive
 *
 * @package progressive
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'progressive'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	<input type="submit" class="search-submit" value="&rarr;" />
</form>
