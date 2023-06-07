<?php

// Donation Meta Data
function nonprofit_organization_custom_meta_donation() {
    add_meta_box( 
    	'bn_meta', __( 'Donation Meta Feilds', 'nonprofit-organization' ), 
    	'nonprofit_organization_meta_callback_donation',
    	'post',
    	'normal',
    	'high'
    );
}

/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'nonprofit_organization_custom_meta_donation');
}

function nonprofit_organization_meta_callback_donation( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'nonprofit_organization_meta_nonce_donation' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $raised_amount = get_post_meta( $post->ID, 'nonprofit_organization_raised_amount', true );
    $goal_amount = get_post_meta( $post->ID, 'nonprofit_organization_goal_amount', true );
    $amount_currency = get_post_meta( $post->ID, 'nonprofit_organization_amount_currency', true );
    ?>
    <div id="donation_meta">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-8">
                    <td class="left">
                        <h3 style="margin-top:0"><?php esc_html_e( 'Raised Amount', 'nonprofit-organization' )?></h3>
                        <input type="text" placeholder="2500" name="nonprofit_organization_raised_amount" id="nonprofit_organization_raised_amount" value="<?php echo esc_attr($raised_amount); ?>" />
                    </td>
                </tr>
                <tr id="meta-8">
                    <td class="left">
                        <h3 style="margin-top:0"><?php esc_html_e( 'Goal Amount', 'nonprofit-organization' )?></h3>
                        <input type="text" placeholder="5500" name="nonprofit_organization_goal_amount" id="nonprofit_organization_goal_amount" value="<?php echo esc_attr($goal_amount); ?>" />
                    </td>
                </tr>
                <tr id="meta-8">
                    <td class="left">
                        <h3 style="margin-top:0"><?php esc_html_e( 'Currency', 'nonprofit-organization' )?></h3>
                        <input type="text" placeholder="$" name="nonprofit_organization_amount_currency" id="nonprofit_organization_amount_currency" value="<?php echo esc_attr($amount_currency); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function nonprofit_organization_meta_save_donation( $post_id ) {
    if (!isset($_POST['nonprofit_organization_meta_nonce_donation']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['nonprofit_organization_meta_nonce_donation']) ), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Raised Amount
    if( isset( $_POST[ 'nonprofit_organization_raised_amount' ] ) ) {
        update_post_meta( $post_id, 'nonprofit_organization_raised_amount', strip_tags( wp_unslash( $_POST[ 'nonprofit_organization_raised_amount' ]) ) );
    }

    // Save Goal Amount
    if( isset( $_POST[ 'nonprofit_organization_goal_amount' ] ) ) {
        update_post_meta( $post_id, 'nonprofit_organization_goal_amount', strip_tags( wp_unslash( $_POST[ 'nonprofit_organization_goal_amount' ]) ) );
    }

    // Save Currency
    if( isset( $_POST[ 'nonprofit_organization_amount_currency' ] ) ) {
        update_post_meta( $post_id, 'nonprofit_organization_amount_currency', strip_tags( wp_unslash( $_POST[ 'nonprofit_organization_amount_currency' ]) ) );
    }
}
add_action( 'save_post', 'nonprofit_organization_meta_save_donation' );