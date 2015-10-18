<?php
  $max_mtRandom=mt_getrandmax();
  function mtRandom($int_min=0,$int_max=$max_mtRandom){
    $int_result=mt_rand($int_min,$int_max);
    return $int_result; 
  }
?>
