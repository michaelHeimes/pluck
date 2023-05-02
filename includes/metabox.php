<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function ssxtheme_add_meta_box() {
	add_meta_box('metabox_unique_name',__( 'Metabox title here', 'myplugin_textdomain' ),'meta_box_callback','event');
	
	
}
add_action( 'add_meta_boxes', 'ssxtheme_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */

function meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	//wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, 'custom_order', true );
	$city = get_post_meta( $post->ID, 'city', true );

	?>
	<table>
    	<tr>
        <td><?php echo _e( 'Label Name here ', 'myplugin_textdomain' );?></td>
        <td><input type="text" name="custom_order" value="<?php echo esc_attr( $value );  ?>"/></td>
        </tr>
        <tr>
        <td><?php echo _e( 'Label Name here ', 'myplugin_textdomain' );?></td>
        <td><input type="text" name="city" value="<?php echo esc_attr( $city );  ?>"/></td>
        </tr>
    </table>
	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function ssxtheme_save_meta_box_data( $post_id ) {
	
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'event' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	}
	else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['custom_order'] );
	$city = sanitize_text_field( $_POST['city'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'custom_order', $my_data );
	update_post_meta( $post_id, 'city', $city );
	
}
add_action( 'save_post', 'ssxtheme_save_meta_box_data' );

?>