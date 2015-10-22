<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package progressive
 */
?>
<div class="breadcrumb-box">
	<div class="container">
		<?php if (function_exists('progressive_breadcrumbs')) {
			progressive_breadcrumbs();
		} ?>	
	</div>
</div>