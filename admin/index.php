<?php

function add_script_to_admin() {

    wp_enqueue_style('icon_picker' ,  plugin_dir_url( __FILE__ ) . 'assets/css/fontawesome-iconpicker.min.css');
	wp_enqueue_style('font_icon' ,  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css');


	wp_enqueue_script( 'icon_picker' ,  plugin_dir_url( __FILE__ ) . 'assets/js/fontawesome-iconpicker.min.js', array(), '1.0' );
	wp_enqueue_script( 'icon_main' ,  plugin_dir_url( __FILE__ ) . 'assets/js/main.js' , array(), '1.0' );

}

add_action('admin_enqueue_scripts', 'add_script_to_admin');
function moashqar_plugin_settings() {
	add_menu_page(
		'Show Count Posts',
		'Show Count Posts',
		'manage_options',
		'show-count-posts',
		'moahsqar_plugin_settings_callback',
		'dashicons-menu-alt3',
		'59'

	);
}

add_action('admin_menu', 'moashqar_plugin_settings');


function moashqar_plugin_register_fields() {
	register_setting('moashqar_global_settings_plugin' , 'moashqar_view_word');
	register_setting('moashqar_global_settings_plugin' , 'moashqar_icon');
	register_setting('moashqar_global_settings_plugin' , 'moahsqar_viewing_place');

}

add_action('admin_init', 'moashqar_plugin_register_fields');

function moahsqar_plugin_settings_callback() {
	?>
	<div class="wrap">
			<h1>Settings Show Count Posts </h1>
		<form action="options.php" method="post">
			<?php settings_fields('moashqar_global_settings_plugin');
			$moashqar_viewing_place  = get_option('moahsqar_viewing_place');
			?>
			<table class="form-table">
				<tr>
				<th>View Word</th>
					<td>
						<input type="text" class="regular-text" name="moashqar_view_word" value="<?php echo get_option('moashqar_view_word'); ?>">
					</td>
				</tr>
                <tr>
                    <th>Icon</th>
                    <td>
                        <input type="text" class="regular-text icon_picker" name="moashqar_icon" value="<?php echo get_option('moashqar_icon'); ?>">
                    </td>
                </tr>
				<th> Viewing Place</th>
				<td>
					<fieldset>
						<label >
							<input type="radio" name="moahsqar_viewing_place" value="moashqar_up"
							<?php echo ($moashqar_viewing_place == 'moashqar_up') ? "checked" : "" ;?>>
							<span> Up</span>
							<code>Before the Article</code>
						</label>
						<br>
						<label >
							<input type="radio" name="moahsqar_viewing_place" value="moashqar_down"
								<?php echo ($moashqar_viewing_place == 'moashqar_down') ? "checked" : "" ;?>>
							<span> Down</span>
							<code>After the Article</code>
						</label>
						<br>
						<label >
							<input type="radio" name="moahsqar_viewing_place" value="moashqar_both"
								<?php echo ($moashqar_viewing_place == 'moashqar_both') ? "checked" : "" ;?>>
							<span> Both</span>
							<code> Before and After the Article</code>
						</label>
						<br>
						<label >
							<input type="radio" name="moahsqar_viewing_place" value="moashqar_remove"
								<?php echo ($moashqar_viewing_place == 'moashqar_remove') ? "checked" : "" ;?>>
							<span> Remove</span>
							<code> Remove the Article</code>
						</label>
						<p>
							<strong>Note:</strong>
							Choose Where the Number of Views
						</p>
					</fieldset>
				</td>
				</tr>

			</table>
			<?php submit_button(); ?>
		</form>
	</div>

<?php
}
add_action('settings_callback', 'moahsqar_plugin_settings_callback');
