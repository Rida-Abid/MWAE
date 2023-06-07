<?php
	the_posts_pagination( array(
		'prev_text' => esc_html__( 'Previous page', 'nonprofit-organization' ),
		'next_text' => esc_html__( 'Next page', 'nonprofit-organization' ),
	) );