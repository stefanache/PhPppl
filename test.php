<?php
	  //	http://contempo-web.ro/PhPppl
	  require_once('Mersenne_Twister.php');
          $mt_obj=new class_MT();
          $mt_rng=$mt_obj->intMT_rng;
          echo 'Mersenne Twister RNG = '.$mt_rng.';<br/>';
          //
          require_once('LibC_rand.php');
          $libCrand_obj=new class_LibCrand();
          $libCrand_rng=$libCrand_obj->intLibC_rng;
          echo 'LibC rng = '.$libCrand_rng.';<br/>';          
	
?>
