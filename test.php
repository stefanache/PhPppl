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
          /*
          //(PHP 7) support need!!!!
          require_once('Crypt_Random.php');
          $cr_obj=new class_CR();
          $cr_rng=$cr_obj->intCR_rng;
          echo 'Cryptographic secure preudo-rng = '.$cr_rng.';<br/>';
          */ 
          //
	  require_once('RNG.php');
          $RNG_obj=new class_RNG('rand');
          $rand_rng=$RNG_obj->rng;
          echo "Randon Number Generator rand-rng=".$rand_rng.';<br/>';                   
	
?>
