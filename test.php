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
	  function rng_assert_handler($file, $line, $code, $desc = null){
		echo "<hr>Assertion Failed:
		File: '$file'<br />
		Line: '$line'<br />
		Code: '$code'<br />";
		if ($desc) {
		    echo "Msg. : '$desc'<br />";
		}        		
		echo "<hr />\n";
	  }          
	  require_once('RNG.php');
	  $seed=700;//null
	  $min=0;
	  $max=10000;
          $RNG_obj=new class_RNG('rand','rng_assert_handler',$seed,$min,$max);
          $rand_rng=$RNG_obj->random();
          echo "Randon Number Generator libc::rand-rng=".$rand_rng.' with seed='.$seed.', from ['.$min.','.$max.'] range;<br/>';
          $rand_rng=$RNG_obj->random();                   
	  echo " ...and again libc::rand-rng=".$rand_rng.' with seed='.$seed.', from ['.$min.','.$max.'] range;<br/>';
	  $RNG_obj->resetRNG();
	  $subunitary_precision=3;
          $rand_rng=$RNG_obj->random($subunitary_precision);                   
	  echo " continue...  libc::rand-rng=".$rand_rng.' with subunitary-precision of '.$subunitary_precision.' without seed(because it was resetted), from ['.$min.','.$max.'] range(but moved into [0,1]);<br/>';
	  $subunitary_precision++;
	  $rand_rng=$RNG_obj->random($subunitary_precision);                   
	  echo " ...and so on again libc::rand-rng=".$rand_rng.' with subunitary-precision of '.$subunitary_precision.' without seed, from ['.$min.','.$max.'] range(but moved into [0,1]);<br/>';
	  	    
?>
