<li class="edgtf-bl-item edgtf-item-space">
	<div class="edgtf-bli-inner">
        <?php if ( $post_info_image == 'yes' ) {
			entropia_edge_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="edgtf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="edgtf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                entropia_edge_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php entropia_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="edgtf-bli-excerpt">
                <?php if ( $post_info_excerpt == 'yes' ) {
                    entropia_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params );
                } ?>
		        <?php entropia_edge_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>