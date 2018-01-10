<?php
/**
 * 
 * Template for displaying Room reservation data in Fourwinds
 * 
 * @return HTML
 * 
 */

//Set up namespaces
use FWF\Includes\SpaceAvailability as SpaceAvailability;


//get the query var value
$room_id = get_query_var( 'room_availability' );

//insert into function
$space_availability = SpaceAvailability\get_space_availability( $room_id );

//cache the output
//var_dump( count($space_availability ) ); 
if( count($space_availability ) <= 4 ){
  $container_height = 60;
}else{
  $container_height = 100;
}

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Reservation Template</title>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css" />
    <link rel="stylesheet" href="<?php echo FWF_DIST.'styles/style.min.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cloud.typography.com/7861216/7459392/css/fonts.css" type="text/css" />    

  </head>
  <body>
  <section class="grid-y fwf-res-container" style="height:<?php echo $container_height ?>vh;">
    
    <?php if($space_availability): foreach($space_availability as $space):?>
    
      <?php if(array_key_exists( 'capacity', $space ) ) continue; ?>
      
      <?php if( array_key_exists( 'confirm_num', $space ) ):?>
        <div class="cell fwf-l-res-time-slot--occupied" style="flex-grow: <?php echo $space['30_min_seg']; ?> ">
       
          <?php if($space['is_current']): ?>
          <div class="fwf-c-res-time-slot--current">
              <i class="fa fa-map-marker" aria-hidden="true"></i> 
              <span>Now</span>
          </div>            
          <?php endif;?>
          
          <div class="fwf-l-occupied__container">
            <div class="fwf-c-occupied__header">Occupied</div>
            <div class="fwf-c-occupied__content"><?php echo $space['rendered_time']; ?></div>         
          </div>
          
          <div class="fwf-l-occupied__container">
            <div class="fwf-c-occupied__header">Confirmation #</div>  
            <div class="fwf-c-occupied__content"><?php echo $space['confirm_num']; ?></div> 
          </div>
           
        </div>    
      <?php else: ?>
          <div class="cell fwf-l-res-time-slot--free" style="flex-grow: <?php echo $space['30_min_seg']; ?> ">
            
          <?php if($space['is_current']): ?>
          <div class="fwf-c-res-time-slot--current">
              <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
              <span>Now</span>
          </div>            
          <?php endif;?>            
          
            <div class="fwf-l-free__container">
              <div class="fwf-c-free__header"><i class="fa fa-plus-circle" aria-hidden="true"></i> Available</div> 
              <div><?php echo $space['rendered_time']; ?></div>              
            </div> 
          
          </div>
          
      <?php endif; ?>
      
  <?php endforeach; else: ?>
  
  <?php endif; ?>

  </section><!--.grid-y fwf-res-container-->
  
    <!-- Compressed JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>

  </body>
</html>