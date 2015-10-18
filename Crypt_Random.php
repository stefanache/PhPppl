<?php
  class class_CR{
    /*
       (PHP 7) support need!!!!
       
       Crypt-Random : Generate a cryptographically secure pseudo-random integer
                      in range [optional $int_min,optional $int_max] 
                      but don't have seed(initialization) support
    
       usage: 
          require_once('Crypt_Random.php');
          $cr_obj=new class_CR();
          $cr_rng=$cr_obj->intCR_rng;
          echo 'Cryptographic secure preudo-rng = '.$cr_rng.';<br/>';
    */
    public $intCR_rng=null;
    
    public function __construct($int_min=0,$int_max=null){
      $this->intCR_rng=$this->int_CRrand($int_min,$int_max);
      return $this;
    }
    //
    public function int_maxCRrand(){
      return PHP_INT_MAX;
    }
    
    public function int_CRrand($int_min=0,$int_max=null){
      $int_min = (func_num_args() >= 1)? func_get_arg(0): PHP_INT_MIN;
      $intMAX=$this->int_maxCRrand(); 
      $int_max = (func_num_args() >= 2 && $int_max)? func_get_arg(1): $intMAX;
      $int_max = min($int_max,$intMAX);
      return random_int($int_min,$int_max);
    }
  }
?>
