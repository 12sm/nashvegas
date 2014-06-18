<?php

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

//Excerpt function
     add_post_type_support( 'page', 'excerpt' );

//
     	//[about]
		function about_page () {
		$page_id = 15;  //Page ID
		$page_data = get_page( $page_id );
		global $more;
		$more = 0;
		$content = apply_filters('the_content', $page_data->post_excerpt);
		echo $content;
		}
		add_shortcode( 'about', 'about_page' );

//Use CRED For User Registration
function my_registration_action($post_id, $form_data)
{
// if registration form
if ($form_data['id']==623)
{
 
 // user can overwrite everything here, eg redirection, messages displayed etc..
    if ($registering_as_author == 1 )
    {
    $user_role = 'author';
    }
    else
    {
    $user_role = 'contributor';
    }
    $display_name = $firstname . $lastname;
    $user_id = username_exists( $post_title );
    if ( !$user_id and email_exists($email_address) == false )
    {
      $user_id = wp_create_user( $post_title, $password, $email_address);
      wp_insert_user( array ('ID' => $user_id, 'first_name' => $firstname, 'last_name' => $lastname, 'role' => $user_role, 'display_name' => $display_name));
}
header('location:wp-login.php');
}
}		


define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}

/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions