<div class="edgtf-pie-chart-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-pc-percentage" <?php echo entropia_edge_get_inline_attrs($pie_chart_data); ?>>
		<h2 class="edgtf-pc-percent" <?php echo entropia_edge_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></h2>
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="edgtf-pc-title" <?php echo entropia_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>

        <svg x="0px" y="0px" viewBox="0 0 230 230" xml:space="preserve">
            <circle cx="142.657" cy="11.932" r="3.711"/>
            <circle cx="168.815" cy="22.832" r="3.711"/>
            <circle cx="191.261" cy="40.13" r="3.712"/>
            <circle cx="208.466" cy="62.648" r="3.711"/>
            <path d="M217.341,85.673c1.751-1.058,4.033-0.494,5.093,1.26c1.059,1.756,0.495,4.038-1.26,5.095
            c-1.754,1.06-4.036,0.495-5.094-1.259C215.021,89.014,215.586,86.733,217.341,85.673z"/>
            <path d="M221.867,113.39c1.968-0.57,4.026,0.566,4.596,2.535c0.569,1.97-0.567,4.028-2.536,4.594
            c-1.97,0.572-4.025-0.565-4.597-2.534C218.763,116.015,219.898,113.959,221.867,113.39z"/>
            <circle cx="219.14" cy="145.043" r="3.71"/>
            <path d="M209.135,167.601c1.987,0.489,3.201,2.503,2.711,4.493c-0.492,1.991-2.504,3.203-4.495,2.711
            c-1.99-0.491-3.203-2.504-2.71-4.493C205.133,168.323,207.143,167.107,209.135,167.601z"/>
            <circle cx="190.945" cy="193.649" r="3.711"/>
            <circle cx="168.426" cy="210.854" r="3.711"/>
            <path d="M145.401,219.73c1.06,1.751,0.496,4.032-1.261,5.093c-1.755,1.059-4.037,0.495-5.094-1.262
            c-1.063-1.753-0.493-4.035,1.26-5.092C142.062,217.411,144.342,217.974,145.401,219.73z"/>
            <path d="M117.686,224.258c0.572,1.967-0.566,4.025-2.536,4.596c-1.967,0.568-4.027-0.567-4.595-2.537
            c-0.57-1.971,0.568-4.026,2.535-4.595C115.06,221.153,117.116,222.288,117.686,224.258z"/>
            <path d="M89.743,221.461c0.042,2.047-1.589,3.74-3.64,3.78c-2.048,0.04-3.743-1.589-3.781-3.638
            c-0.041-2.052,1.591-3.742,3.638-3.782C88.009,217.782,89.703,219.409,89.743,221.461z"/>
            <path d="M63.476,211.526c-0.49,1.989-2.503,3.201-4.495,2.71c-1.989-0.491-3.205-2.502-2.711-4.493
            c0.491-1.991,2.506-3.204,4.493-2.711C62.753,207.524,63.968,209.536,63.476,211.526z"/>
            <path d="M40.673,195.13c-0.987,1.797-3.245,2.446-5.042,1.455c-1.792-0.987-2.447-3.246-1.455-5.039
            c0.989-1.797,3.249-2.446,5.041-1.458C41.012,191.079,41.666,193.337,40.673,195.13z"/>
            <path d="M22.894,173.393c-1.419,1.479-3.769,1.523-5.248,0.101c-1.477-1.418-1.524-3.77-0.101-5.246
            c1.42-1.479,3.771-1.521,5.247-0.102C24.268,169.566,24.315,171.916,22.894,173.393z"/>
            <path d="M11.344,147.795c-1.753,1.062-4.033,0.496-5.096-1.262c-1.058-1.752-0.495-4.037,1.261-5.092
            c1.754-1.064,4.037-0.494,5.094,1.26C13.663,144.455,13.1,146.736,11.344,147.795z"/>
            <path d="M6.813,120.079c-1.968,0.573-4.024-0.565-4.595-2.538c-0.569-1.966,0.567-4.027,2.536-4.592
            c1.97-0.572,4.026,0.568,4.595,2.536S8.784,119.512,6.813,120.079z"/>
            <path d="M9.611,92.135c-2.049,0.044-3.741-1.588-3.781-3.64c-0.042-2.047,1.588-3.743,3.637-3.78
            c2.051-0.042,3.742,1.591,3.782,3.639C13.289,90.403,11.661,92.098,9.611,92.135z"/>
            <path d="M19.545,65.868c-1.992-0.487-3.204-2.502-2.711-4.495c0.49-1.989,2.503-3.205,4.492-2.71
            c1.993,0.49,3.204,2.506,2.712,4.494C23.547,65.146,21.535,66.362,19.545,65.868z"/>
            <path d="M35.938,43.066c-1.796-0.986-2.445-3.247-1.454-5.043c0.987-1.792,3.247-2.447,5.041-1.455
            c1.797,0.99,2.445,3.249,1.456,5.042C39.991,43.404,37.734,44.059,35.938,43.066z"/>
            <path d="M57.675,25.285c-1.48-1.417-1.522-3.77-0.099-5.247c1.418-1.479,3.771-1.525,5.245-0.102
            c1.479,1.42,1.521,3.771,0.101,5.248C61.503,26.659,59.152,26.708,57.675,25.285z"/>
            <path d="M83.273,13.736c-1.062-1.752-0.495-4.035,1.262-5.096c1.751-1.059,4.036-0.496,5.092,1.26
            c1.062,1.754,0.493,4.035-1.26,5.095C86.614,16.053,84.333,15.492,83.273,13.736z"/>
            <path d="M110.987,9.204c-0.572-1.968,0.569-4.026,2.539-4.594c1.965-0.57,4.026,0.565,4.594,2.534
            c0.57,1.97-0.569,4.025-2.536,4.596C113.615,12.307,111.558,11.174,110.987,9.204z"/>
        </svg>

	</div>
	<?php if(!empty($text)) { ?>
		<div class="edgtf-pc-text-holder">
			<p class="edgtf-pc-text" <?php echo entropia_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		</div>
	<?php } ?>
</div>