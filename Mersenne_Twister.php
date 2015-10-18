<?php
  class $class_MT{
    /*
    Mersenne Twister : A very fast random number generator Of period 219937-1
    */
  
    public function int_maxMTRand(){
      return mt_getrandmax();
    }
    public function int_MTRand($int_min=0,$int_max=null){
      $int_min = (func_num_args() >= 1)? func_get_arg(0): 0;
      $int_max = (func_num_args() >= 2)? func_get_arg(1): int_maxMTRand();
      return mt_rand($int_min,$int_max);
    }
    public function float_makeSeed(){
      list($usec, $sec) = explode(' ', microtime());
      return (float) $sec + ((float) $usec * 100000);
    }
    public function void_seedMTRand(){
      $int_seed = (func_num_args() >= 1)? func_get_arg(0): null;
      return ($int_seed)?mt_srand($int_seed):mt_srand();
    }

  }
?>
