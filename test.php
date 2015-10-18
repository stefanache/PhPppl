<?php	  
	  require_once('Mersenne_Twister.php');
    $mt_obj=new class_MT();
    $mt_rng=$mt_obj->intMT_rng;
    echo 'Mersenne Twister RNG = '.$mt_rng.';<br/>';
  ?>
