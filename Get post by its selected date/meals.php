<?php
/*
Template Name:Meals Page
 */
?>
<?php
get_header();    ?>
<?php include(TEMPLATEPATH.'/common_slider.php'); $_GET['']; ?>

<script type="text/javascript">
function selected_state(){

	//var singleValues = $('#field1').val();
	
	jQuery("#eventCategoryId option").each(function(){
		
		var hidval = jQuery('#hardik').val();
			var hidval2 = jQuery('#hardik2').val();
	
		
        if(jQuery(this).val() == hidval){
            jQuery(this).attr("selected","selected");
            return false;
        }
		
    });
}

function selected_state2(){
	
	//var singleValues = $('#field1').val();
	
	
    jQuery("#displayPeriod option").each(function(){
		
		
		var hidval = jQuery('#hardik').val();
			var hidval2 = jQuery('#hardik2').val();
				
		
		
		
       if(jQuery(this).val() == hidval2){
            jQuery(this).attr("selected","selected");
            return false;
        }
		
    });
}

 
jQuery(document).ready(function(){
	
    selected_state();
	selected_state2();
});
</script>

<div class="panel section-feature">
  <div class="section-container clearfix panel-container">
    <div class="news-header">
      <h1 style="text-align: center;">Meals</h1>
      
    
      
   
        <?php  $catname = $_GET['eventCategoryId']; ?>
      <form name="catSelect" class="filter-form newfilter" action="" method="GET">
        <fieldset>
        <h4 class="newmeals">Select a Date:</h4>
      
       
     
       
  
  <input style="display:none;" type="hidden" value="<?php
$post_7 = get_post($catname); 
echo $title = $post_7->post_title;

?>"  id="hardik343" />
       
        
      <input onclick="catSelect" id="eventdate" name="eventdate" type="text" value="<?php echo $_GET['eventdate']; ?>"  />
        
        

     

        </fieldset>
     
        <?php  
			$year123 = $_GET['displayPeriod'];
			/*$year123 = 0;*/
		?>
        <input type="hidden" value="<?php echo $catname; ?>"  id="hardik" />
     
        <?php
	

$sepparator = ' ';
$parts = explode($sepparator, $date);
 $dayForDate123 = date("l", mktime(0, 0, 0,(int) $parts[1], (int)$parts[2],(int) $parts[0]));







		?>
         <input  type="hidden" value="<?php echo $dayForDate23 ; echo $post->ID ?>"  id="hardik2" />
           <input type="submit" id="newgo" value="GO"   />
      </form>
		
		<?php
 

wp_reset_query();

 $date = $_GET['eventdate'];
$sepparator = '/';
 $parts = explode($sepparator, $date);
 $dayForDate = date("l", mktime(0, 0, 0, (int) $parts[1], (int)$parts[2],(int) $parts[0]));
 $timestamp = mktime(0, 0, 0, $parts[2], 10);

  $month = (int)$parts[2]."<br>";
 $date123 =(int) $parts[1]."<br>";
 $year = (int)$parts[0]."<br>";
 $newget = implode("/",$parts);
$timestamp = strtotime($newget); 

 $day = date('l', $timestamp);






query_posts( "post_type=meals&year=$month&monthnum=$date123&day=$year&post_status=published");



  
 ?>
 

	
    </div>
    
    
		
	<div class="article-wrapper featured-event mealspage">
    
 

 <?php 
   if (!empty($_GET['eventdate'])) {
	
		while (have_posts() ) {
			the_post();  ?>
		 
       
      <article>

  
        <div class="article-content column half">
		
          <h2><?php the_title(); ?></h2>
		 
          
        </div>
		<div class="article-content column half"><?php echo the_content(); ?></div>		
		
		
		
		</div>
   
	  </article>
      
  
   
	  
	</div>
	<?php	} ?>
    <?php  } else {  // end while ?>
	
	
	<div class="newclass234"><p class="aligncenter"><?php _e( 'There are no events for the selected month and category.' ); ?></p>
	
	</div>
    
  <?php } ?>
	
    <ul class="news-list clearfix">
    </ul>
  </div>
  <a class="btt" href="resources/activities-events#top"><i class="icon-up-open left"></i> Back to the top <i class="icon-up-open right"></i></a>
 
</div>

</div>

<?php get_footer(); ?>
