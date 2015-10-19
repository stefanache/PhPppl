<?php
  class class_LibCrand{
    /*
       LibC-Random : Generate a random integer(no large) using libc
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
    public $int_min=0;
    public $int_max=null;
    public $int_seed=null;
    public $seed_min=0;
    public $seed_max=null;
        
    public function __construct($int_min=0,$int_max=null, $int_seed=null){
      $this->seed_min=0;
      $this->seed_max=$this->int_maxLibCrand();     
      $int_seed=$this->int_makeSeed();
      $this->void_seedLibCRand($int_seed);
      $this->int_LibCRand($int_min,$int_max);
      return $this;
    }
    //
    public function int_maxLibCrand(){
      return getrandmax();
    }
    
    public function int_LibCRand($int_min=0,$int_max=null){
      $intMIN=$this->seed_min;    
      $int_min = (func_num_args() >= 1)? func_get_arg(0): $intMIN;
      $intMAX=$this->seed_max; 
      $int_max = (func_num_args() >= 2 && $int_max)? func_get_arg(1): $intMAX;
      $int_max = min($int_max,$intMAX);
      $int_max = min($int_max,$intMAX);
      $this->int_min=$int_min;
      $this->int_max=$int_max;      
      $this->intLibC_rng=rand($this->int_min,$this->int_max);
      return $this->intLibC_rng;
    }
    //
    public function int_makeSeed(){
      list($usec, $sec) = explode(' ', microtime());
      $int_seed=(int) $sec + ((int) $usec * 100000);
      $this->void_seedLibCRand($int_seed);
      return $int_seed;
    }
    
    public function void_seedLibCRand(){
      $int_seed = (func_num_args() >= 1)? func_get_arg(0):null;
      $int_seed=min($int_seed,$this->seed_max);
      $int_seed=max($int_seed,$this->seed_min);
      $this->int_seed=$int_seed;      
      ($this->int_seed) ? srand($this->int_seed) : srand();
      return $this->int_LibCRand($this->int_min,$this->int_max);
    }

  }
?>
