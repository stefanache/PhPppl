<?php
  class class_LibCrand{
    /*
       LibC-random : Generate a random integer(no large) using libC
                     in range [optional $int_min,optional $int_max] 
                     with optional seed(initialization)
    
       usage: 
          require_once('LibC_rand.php');
          $libCrand_obj=new class_LibCrand();
          $libCrand_rng=$libCrand_obj->intLibC_rng;
          echo 'LibC rng = '.$libCrand_rng.';<br/>'; 
    */
    public $intLibC_rng=null;
    public $type_rng="slow no large random integer";
    
    public function __construct($int_min=0,$int_max=null, $int_seed=null){
      $int_seed=$this->int_makeSeed();
      $this->void_seedLibCRand($int_seed);
      $this->intLibC_rng=$this->int_LibCRand($int_min,$int_max);
      return $this;
    }
    //
    public function int_maxLibCrand(){
      return getrandmax();
    }
    
    public function int_LibCRand($int_min=0,$int_max=null){
      $int_min = (func_num_args() >= 1)? func_get_arg(0): 0;
      $intMAX=$this->int_maxLibCRand(); 
      $int_max = (func_num_args() >= 2 && $int_max)? func_get_arg(1): $intMAX;
      $int_max = min($int_max,$intMAX);
      return rand($int_min,$int_max);
    }
    //
    public function int_makeSeed(){
      list($usec, $sec) = explode(' ', microtime());
      $int_seed=(int) $sec + ((int) $usec * 100000);
      $int_seed=min($int_seed,$this->int_maxLibCRand());
      return $int_seed;
    }
    
    public function void_seedLibCRand(){
      $int_seed = (func_num_args() >= 1)? func_get_arg(0):null;
      return ($int_seed) ? srand($int_seed) : srand();
    }

  }
?>
