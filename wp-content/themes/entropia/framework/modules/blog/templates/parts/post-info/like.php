<?php if(entropia_edge_core_plugin_installed()) { ?>
    <div class="edgtf-blog-like">
        <?php if( function_exists('entropia_edge_get_like') ) entropia_edge_get_like(); ?>
    </div>
<?php } ?>