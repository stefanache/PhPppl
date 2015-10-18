<?php
  class class_MT{
    /*
       Mersenne Twister : Generate a very fast random number Of period 2^19937-1
                          in range [optional $int_min,optional $int_max] 
                           with optional seed(initialization)
    
       usage: 
          require_once('Mersenne_Twister.php');
          $mt_obj=new class_MT();
          $mt_rng=$mt_obj->intMT_rng;
          echo 'Mersenne Twister rng = '.$mt_rng.';<br/>';
    */
    public $intMT_rng=null;
    public $type_rng="fast random integer";
    public $seed_min=0;
    public $seed_max=null;
    
    public function __construct($int_min=0,$int_max=null, $int_seed=null){
      $this->seed_min=0;
      $this->seed_max=$this->int_maxMTRand(); 
      $int_seed=$this->int_makeSeed();
      $this->void_seedMTRand($int_seed);
      $this->int_MTRand($int_min,$int_max);
      return $this;
    }
    //
    public function int_maxMTRand(){
      return mt_getrandmax();
    }
    
    public function int_MTRand($int_min=0,$int_max=null){
      $intMIN=$this->seed_min;
      $int_min = (func_num_args() >= 1)? func_get_arg(0): $intMIN;
      $int_min = max($int_min,$this->seed_min);
      $intMAX=$this->seed_max;
      $int_max = (func_num_args() >= 2 && $int_max)? func_get_arg(1): $intMAX;
      $int_max = min($int_max,$intMAX);
      $this->intMT_rng=mt_rand($int_min,$int_max);
      return $this->intMT_rng;
    }

    //
    public function int_makeSeed(){
      list($usec, $sec) = explode(' ', microtime());
      $int_seed=(int) $sec + ((int) $usec * 100000);
      return $int_seed;
    }
    
    public function void_seedMTRand(){
      $int_seed = (func_num_args() >= 1)? func_get_arg(0):null;
      $int_seed=min($int_seed,$this->seed_max);
      $int_seed=max($int_seed,$this->seed_min);      
      return ($int_seed) ? mt_srand($int_seed) : mt_srand();
    }

  }
?>
