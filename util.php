<?php
  /*
  Mersenne Twister : A very fast random number generator Of period 219937-1
  */
   $class_MT = new stdClass();
   $class_MT->int_maxMTRand = function int_maxMTRand(){
                                return mt_getrandmax();
                              }
   
    $class_MT->int_MTRand = function int_MTRand($int_min=0,$int_max=null){
                              $int_min = (func_num_args() >= 1)? func_get_arg(0): 0;
                              $int_max = (func_num_args() >= 2)? func_get_arg(1): int_maxMTRand();
                              return mt_rand($int_min,$int_max);
                            }
   $class_MT->void_seedMTRand = function void_seedMTRand(){
                                   $int_seed = (func_num_args() >= 1)? func_get_arg(0): null;
                                   return ($int_seed)?mt_srand($int_seed):mt_srand();
                                }
  }
?>
