<?php
    // Include and instantiate the class.
    require_once 'Mobile_Detect.php';
    $detect = new Mobile_Detect;
  
 
  
   // Any mobile device (phones or tablets).
    if ( $detect->isMobile() ) {
     
    }
     
    // Any tablet device.
    if( $detect->isTablet() ){
     
    }
     
    // Exclude tablets.
    if( $detect->isMobile() && !$detect->isTablet() ){
     
    }
     
    // Check for a specific platform with the help of the magic methods:
    if( $detect->isiOS() ){
   	}
     
    if( $detect->isAndroidOS() ){
     
    }
     
    // Alternative method is() for checking specific properties.
    // WARNING: this method is in BETA, some keyword properties will change in the future.
    $detect->is('Chrome');
	$detect->is('iOS');
    $detect->version('UC Browser');
	if($detect->version('Chrome')){
		echo "Chrome";
		}
	if($detect->version('Firefox')){
		echo "Firefox";
		}
		
	if($detect->version('MSIE')){
		echo "MSIE"; 
		}	
		
		if($detect->version('Safari')){
		echo "Safari";
		}	
?>