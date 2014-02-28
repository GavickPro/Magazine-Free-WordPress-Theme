<?php

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl;

?>

<?php if(get_option($tpl->name . '_login_popup_state', 'Y') == 'Y' && get_option($tpl->name . '_login_link', 'Y') == 'Y') : ?>
<div id="gk-popup-login">	
	<div class="gk-popup-wrap">
		<?php if ( is_user_logged_in() ) : ?>
			<?php 
				
				global $current_user;
				get_currentuserinfo();
			
			?>
			
			<p>
				<?php echo __('Hi, ', GKTPLNAME) . ($current_user->user_firstname) . ' ' . ($current_user->user_lastname) . ' (' . ($current_user->user_login) . ') '; ?>
			</p>
			<p>
				 <a href="<?php echo wp_logout_url(); ?>" class="btn button-primary" title="<?php _e('Logout', GKTPLNAME); ?>">
					 <?php _e('Logout', GKTPLNAME); ?>
				 </a>
			</p>
		
		<?php else : ?>
		    
			<?php 
				wp_login_form(
					array(
						'echo' => true,
						'form_id' => 'loginform',
						'label_username' => __( 'Username', GKTPLNAME ),
						'label_password' => __( 'Password', GKTPLNAME ),
						'label_remember' => __( 'Remember Me', GKTPLNAME ),
						'label_log_in' => __( 'Log In', GKTPLNAME ),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => NULL,
						'value_remember' => false 
					)
				); 
			?>		
		<?php endif; ?>
	</div>
</div>

<div id="gk-popup-overlay"></div>
<?php endif; ?>