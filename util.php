<?php
 /*
 Mersenne Twister : A very fast random number generator Of period 219937-1
 */
  $int_maxMTRand=mt_getrandmax();
  function int_mtRandom($int_min=0,$int_max=$int_maxMTRand){
    return mt_rand($int_min,$int_max);
  }
?>
