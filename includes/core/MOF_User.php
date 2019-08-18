<?php


class MOF_User
{
    public function __construct()
    {
	    add_action( 'show_user_profile', [$this, 'extra_user_profile_fields'] );
	    add_action( 'edit_user_profile', [$this, 'extra_user_profile_fields'] );

	    add_action( 'personal_options_update', [$this, 'save_extra_user_profile_fields'] );
	    add_action( 'edit_user_profile_update', [$this, 'save_extra_user_profile_fields'] );
    }

    public function get( $user_id = 0, $type = 'object' )
    {
	    global $user_ID, $wpdb;
	    $user_id = (0 == $user_id) ? $user_ID : $user_id;

	    return $wpdb->get_row("	SELECT 
											_user.ID as id,
											_user.display_name as name,
											_user.user_email as email,
											meta_city.meta_value as city,
											meta_adress.meta_value as address,
											meta_st.meta_value as storage
											FROM `{$wpdb->users}` as _user 
											LEFT JOIN `{$wpdb->usermeta}` as meta_city ON meta_city.user_id = _user.ID AND meta_city.meta_key = 'city'
											LEFT JOIN `{$wpdb->usermeta}` as meta_adress ON meta_adress.user_id = _user.ID AND meta_adress.meta_key = 'address'
											LEFT JOIN `{$wpdb->usermeta}` as meta_st ON meta_st.user_id = _user.ID AND meta_st.meta_key = 'storage'
											WHERE _user.ID = '{$user_id}'", $type);
    }

    public function save_extra_user_profile_fields ($user_id)
    {
	    if ( !current_user_can( 'edit_user', $user_id ) ) {
		    return false;
	    }
	    update_user_meta( $user_id, 'address', $_POST['address'] );
	    update_user_meta( $user_id, 'city',    $_POST['city'] );
	    update_user_meta( $user_id, 'storage', $_POST['storage'] );
    }
    public function extra_user_profile_fields ( $user )
    {
	    ?>
	    <h3><?php _e("Extra profile information", "blank"); ?></h3>

	    <table class="form-table">
		    <tr>
			    <th><label for="address"><?php _e("Address"); ?></label></th>
			    <td>
				    <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
				    <span class="description"><?php _e("Please enter your address."); ?></span>
			    </td>
		    </tr>
		    <tr>
			    <th><label for="city"><?php _e("City"); ?></label></th>
			    <td>
				    <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
				    <span class="description"><?php _e("Please enter your city."); ?></span>
			    </td>
		    </tr>
		    <tr>
			    <th><label for="storage"><?php _e("Storage"); ?></label></th>
			    <td>
				    <input type="text" name="storage" id="storage" value="<?php echo esc_attr( get_the_author_meta( 'storage', $user->ID ) ); ?>" class="regular-text" /><br />
				    <span class="description"><?php _e("Please enter your storage code."); ?></span>
			    </td>
		    </tr>
	    </table>
	    <?php
    }
}