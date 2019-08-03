<?php

if ( ! function_exists( 'entropia_edge_like' ) ) {
	/**
	 * Returns EntropiaEdgeClassLike instance
	 *
	 * @return EntropiaEdgeClassLike
	 */
	function entropia_edge_like() {
		return EntropiaEdgeClassLike::get_instance();
	}
}

function entropia_edge_get_like() {
	
	echo wp_kses( entropia_edge_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}