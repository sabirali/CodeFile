<?php

$wpcx_cxOptions = get_option('cxOptions');

// Set Content Width

$content_width = 800;

//Load Styles


function wpcx_add_to_admin_style() {
	
	$wpcx_admin_style = get_template_directory_uri() . '/admin.css';
	wp_register_style('wpcx_admin_style', $wpcx_admin_style);
	wp_enqueue_style('wpcx_admin_style');
	
}



//Load JS


// Custom Logo Support


//WP 3.0 Menu



//Remove wp_nav wrapping



// Fallback Nav Menus



// Cut some text



// Get WP Generated thumb



// Styling & Script Functions


// Featured Options



//Check for Post Thumbnail Support




// Register Sidebar



// Add RSS



// Custom BG



// Editor Style



//Loading Theme Options Framework

$wpcx_themename = "Theme";
$wpcx_shortname = "Creativix";

$wpcx_options = array (

array( "type" => "open",
	"title" => "Social Media Settings"
	),

array( "name" => "Facebook Profile URL",
       "desc" => "Insert Facebook Profile",
       "id" => "social_facebook",
       "type" => "text",
       "std" => ""),

array( "name" => "RSS Feed",
       "desc" => "Insert your RSS Feed.",
       "id" => "social_rss",
       "type" => "text",
       "std" => ""),

array( "name" => "Twitter",
       "desc" => "Insert your Twitter URL.",
       "id" => "social_twitter",
       "type" => "text",
       "std" => ""),
	  
	   
	   array( "name" => "Google Plus",
       "desc" => "Insert Google URL.",
       "id" => "social_google",
       "type" => "text",
       "std" => ""),
	   
	   
	   
	   



array("type" => "close"),



);

// create the Options page on the admin side

function wpcx_add_admin() {

    global $wpcx_themename, $wpcx_shortname, $wpcx_options;

	// Saving and Updating the options
	
	if (!empty($_GET['page']) && $_GET['page'] == basename(__FILE__) && !empty($_POST) && check_admin_referer('wpcx_save_theme_options','wpcx_options_nonce')) { 
		
		if (!empty($_REQUEST['action']) && 'save' == $_REQUEST['action']) {
			
			$wpcx_cxOptions = array();
			
			// print_r($_REQUEST);
			
			foreach ($wpcx_options as $wpcx_value) {
				
				if (!empty($wpcx_value['id'])) {
					
					if(isset($_REQUEST[$wpcx_value['id']])) {
					
						$wpcx_cxOptions[$wpcx_value['id']] = esc_attr($_REQUEST[ $wpcx_value['id'] ]);
						
						if(strpos($wpcx_cxOptions[$wpcx_value['id']], "http") !== false) {
							
							$wpcx_cxOptions[$wpcx_value['id']] = esc_url($_REQUEST[ $wpcx_value['id'] ]);
							
						}
					
					}
				}
				
			}
			
			// Logo Upload
			
			if(!empty($_FILES["logo_file"])) {
			
				// Upload Logo
				
				$wpcx_dir = TEMPLATEPATH . "/images/logos/";
				
				if (is_writable($wpcx_dir)) {
					
					if ((($_FILES["logo_file"]["type"] == "image/gif") || ($_FILES["logo_file"]["type"] == "image/jpeg") || ($_FILES["logo_file"]["type"] == "image/png") || ($_FILES["logo_file"]["type"] == "image/pjpeg")) && ($_FILES["logo_file"]["size"] < 1048576)) {
						
						if ($_FILES["logo_file"]["error"] > 0){
							echo "Return Code: " . $_FILES["logo_file"]["error"] . "<br />";
						} else {
							$_FILES["logo_file"]["name"] = str_replace(' ', '_' , $_FILES["logo_file"]["name"]);
							if (file_exists($wpcx_dir . $_FILES["logo_file"]["name"])) {
								echo $_FILES["logo_file"]["name"] . " already exists. ";
							} else {
								switch($_FILES["logo_file"]["type"]) {
									case "image/jpeg" : $wpcx_end = ".jpg";
									break;
									case "image/png" : $wpcx_end = ".png";
									break;
									case "image/gif" : $wpcx_end = ".gif";
									break;
								}
								$wpcx_newname = time().$wpcx_end;
								
								if(move_uploaded_file($_FILES["logo_file"]["tmp_name"], $wpcx_dir . $wpcx_newname)) {
								
							
									
									$wpcx_cxOptions['logo_file'] = $wpcx_newname;
									
								}
								
							}
						}
					}
				}
			
			}
			
			if(!empty($_REQUEST['del_pic'])) {
				
				$wpcx_cxOptions['logo_file'] = "";
				
			}
			
			update_option('cxOptions', $wpcx_cxOptions);
		
			if (!empty($wpcx_value['id']) && isset($_REQUEST[ $wpcx_value['id']])) {
				
				update_option('cxOptions', $wpcx_cxOptions);
				
			} elseif(!empty($wpcx_value['id'])) {
				
				delete_option( $wpcx_value['id'] );
				
			}
			
			header("Location: themes.php?page=functionoption.php&saved=true");
			
		} elseif(!empty($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
			
			delete_option('cxOptions');
			
			header("Location: themes.php?page=functionsoption.php&reset=true");
			
		}				
			
}
		

    // Add Options page to the admin menu
    
    add_theme_page($wpcx_themename." Options", "$wpcx_themename Options", 'edit_theme_options', basename(__FILE__), 'wpcx_admin');
    
}
 
function wpcx_admin() {

	global $wpcx_themename, $wpcx_shortname, $wpcx_options;
    
	?>
	
	<div class="wrap">
		<div style="float: left; margin-top: 50px;">
			<h1><img src="<?php echo get_template_directory_uri();?>/images/logo.jpeg" /></h1>
		</div>
		
		<div style="float: left; margin-left: 150px;">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="dennis.nissle@iwebix.de">
				<input type="hidden" name="lc" value="US">
				<input type="hidden" name="item_name" value="WP-Creativix Theme Donation">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
				<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
			    
		<h2 style="clear: both; margin-left: 5px; margin-bottom: 20px;">Theme Option</h2>
		
		<?php 
			if ( !empty($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" style="float: left; width: 655px; margin-left: 10px;" class="updated fade"><p><strong>'.$wpcx_themename.' settings saved.</strong></p></div>';
			if ( !empty($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" style="float: left; width: 655px; margin-left: 10px;" class="updated fade"><p><strong>'.$wpcx_themename.' settings reset.</strong></p></div>';
		?>
	    
		<form method="post" enctype="multipart/form-data">
		
		<?php
		
		//print_r($options);
		
		foreach ($wpcx_options as $wpcx_value) {
			
			$wpcx_cxOptions = get_option('cxOptions');
			
			switch ($wpcx_value['type']) {
			
				case "open": ?>
					<div class="container" style="clear: both;background-color: #e8e8e8; border: 1px solid #CCC; padding: 10px; font-size: 11px; width: 650px; margin: 10px; float: left; color: #3b3b3b;">
					<h3><?php echo $wpcx_value['title']; ?></h3>
				<?php break;
	     
				case "close": ?>
					</div>
				<?php break;
	      
				case 'text': ?>
					<div style="margin-top:15px; float: left; clear: both;">
						<?php echo $wpcx_value['name']; ?><br/>
						<input name="<?php echo $wpcx_value['id']; ?>" id="<?php echo $wpcx_value['id']; ?>" type="<?php echo $wpcx_value['type']; ?>" value="<?php if ( !empty($wpcx_cxOptions[$wpcx_value['id']])) { echo esc_attr($wpcx_cxOptions[$wpcx_value['id']]); } else { echo $wpcx_value['std']; } ?>" />
					</div>
					<div style="width: 350px; float: right; margin-right: 20px; margin-top: 15px; background-color: #fff0b5; border: 4px solid #FFF; padding: 5px; font-size: 10px;">
						<?php echo $wpcx_value['desc']; ?>
					</div>
				<?php break;
	     
				case 'textarea': ?>
				
					<div style="margin-top:15px;padding:0; float: left; clear: both;">
						<?php echo $wpcx_value['name']; ?><br/>
						<textarea style="width: 200px; height:70px; font-size: 10px; border: 1px solid #b6b6b6;" name="<?php echo $wpcx_value['id']; ?>" id="<?php echo $wpcx_value['id']; ?>" type="<?php echo $wpcx_value['type']; ?>" cols="" rows=""><?php if ( !empty($wpcx_cxOptions[$wpcx_value['id']])) { echo esc_attr($wpcx_cxOptions[$wpcx_value['id']]); } else { echo $wpcx_value['std']; } ?></textarea>
					</div>
					<div style="width: 350px; float: right; margin-right: 20px; margin-top: 25px; background-color: #fff0b5; border: 4px solid #FFF; padding: 5px; font-size: 10px;">
						<?php echo $wpcx_value['desc']; ?>
					</div>   
				<?php break;
				
				case 'upload': ?>
				
					<div style="margin-top:15px;padding:0; float: left; clear: both;">
						<?php echo $wpcx_value['name']; ?><br/>
						<input type="file" name="<?php echo $wpcx_value['id'];?>" id="<?php echo $wpcx_value['id'];?>" />
					</div>
					<div style="width: 350px; float: right; margin-right: 20px; margin-top: 25px; background-color: #fff0b5; border: 4px solid #FFF; padding: 5px; font-size: 10px;">
						<?php echo $wpcx_value['desc']; ?>
					</div>
					<?php if ( !empty($wpcx_cxOptions[$wpcx_value['id']])) {
						echo "<div class='logo' style='float: left; clear: both;'><img style='float: left; clear: both;' src='".get_template_directory_uri()."/images/logos/".$wpcx_cxOptions[$wpcx_value['id']]."'/><p style='float: left; clear: both;'><input type='checkbox' name='del_pic' value='del' />Delete Logo</p><input type='hidden' name='logo_file' value='".$wpcx_cxOptions[$wpcx_value['id']]."' /></div>";
					}
					?>
				<?php break;
	     
				case 'selectnormal': ?>
					<div style="margin-top:15px; padding:0; float: left; clear: both;">
						<?php echo $wpcx_value['name']; ?><br/>
						<select name="<?php echo $wpcx_value['id']; ?>" id="<?php echo $wpcx_value['id']; ?>"><?php foreach ($wpcx_value['options'] as $wpcx_option) { ?><option<?php if(!empty($wpcx_cxOptions[$wpcx_value['id']]) &&$wpcx_cxOptions[$wpcx_value['id']] == $wpcx_option) { echo ' selected="selected"'; } elseif ($wpcx_option == $wpcx_value['std']) { echo ' selected="selected"'; } ?>><?php echo $wpcx_option; ?></option><?php } ?></select>
					</div>
					<div style="width: 350px; float: right; margin-right: 20px; margin-top: 15px; background-color: #fff0b5; border: 4px solid #FFF; padding: 5px; font-size: 10px;">
						<?php echo $wpcx_value['desc']; ?>
					</div>
				 <?php break;
		    
				case "checkbox": ?>
					<div style="margin-top:15px; padding:0; float: left; clear: both;">
						<?php echo $wpcx_value['name']; ?><br/>
						<?php if(get_option($wpcx_value['id'])){ $wpcx_checked = "checked=\"checked\""; }else{ $wpcx_checked = "";} ?>
						<input type="checkbox" name="<?php echo $wpcx_value['id']; ?>" id="<?php echo $wpcx_value['id']; ?>" value="true" <?php echo $wpcx_checked; ?> />
					</div>
					<div style="width: 350px; float: right; margin-right: 20px; margin-top: 15px; background-color: #fff0b5; border: 4px solid #FFF; padding: 5px; font-size: 10px;">
						<?php echo $wpcx_value['desc']; ?>
					 </div>
			    <?php break; 
			}
		}
		
	?>
	
		<div class="container" style="clear: both; background-color: #e8e8e8; border: 1px solid #CCC; padding: 10px; font-size: 11px; width: 650px; margin: 10px; float: left; color: #3b3b3b;"> 
			<p class="submit" style="float: left; margin-right: 20px;">
				<input name="save" type="submit" value="Save changes" />
				<input type="hidden" name="action" value="save" />
			</p>
			<?php wp_nonce_field('wpcx_save_theme_options','wpcx_options_nonce'); ?>
		</form>
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />
				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
	</div>
	
	<?php

}

add_action('admin_menu', 'wpcx_add_admin');

?>