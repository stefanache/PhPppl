<?php
  class class_MT{
    /*
    Mersenne Twister : A very fast random number generator Of period 2^19937-1
    // standard usage:
          require_once('Mersenne_Twister.php');
          $mt_obj=new class_MT();
          $mt_rng=$mt_obj->intMT_rng;
          echo $mt_rng;
    */
    public $intMT_rng;
    public function __construct($int_min=0,$int_max=null, $int_seed=null){
      $int_seed=$this->float_makeSeed();
      $this->void_seedMTRand($int_seed);
      $this->intMT_rng=$this->int_MTRand($int_min,$int_max);
    }
    public function int_maxMTRand(){
      return mt_getrandmax();
    }
    public function int_MTRand($int_min=0,$int_max=null){
      $int_min = (func_num_args() >= 1)? func_get_arg(0): 0;
      $int_max = (func_num_args() >= 2)? func_get_arg(1): $this->int_maxMTRand();
      return mt_rand($int_min,$int_max);
    }
    public function float_makeSeed(){
      list($usec, $sec) = explode(' ', microtime());
      return (float) $sec + ((float) $usec * 100000);
    }
    public function void_seedMTRand(){
      $int_seed = (func_num_args() >= 1)? func_get_arg(0):null;
      return ($int_seed)?mt_srand($int_seed):mt_srand();
    }

  }
?>
