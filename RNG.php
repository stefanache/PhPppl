<?php
	class class_RNG{
		/*
			Random Number Generator(RNG)
			usage:
			      require_once('RNG.php');
			      $RNG_obj=new class_RNG('rand');
			      $rand_rng=$RNG_obj->rng;
			      echo "Randon Number Generator rand-rng=".$rand_rng.';<br/>';
		*/
		public  $rng=null;
		private $rng_fct='';
		public  $int_min=0;		
		public  $int_max=null;
		public  $int_seed=null;
		public  $seed_min=0;
		public  $seed_max=null;
		
		private $generator_name=null;
		private $RNG_obj=null;
		private $dir_files='./';
		private $library_filename='';
		private $class_name='';
		private $fctRNG_name='';
		private $have_supportSeed=false;
		private $seedrandom_fct=null;
		private $varRNG_resultName='';
		
		private function getGeneratorParameters($generator_name='mt_rand'){
			$dir_files=$this->dir_files;
			$library_filename='Mersenne_Twister.php';
			$class_name='class_MT';
			$fctRNG_name='int_MTRand';
			$have_supportSeed=true;
			$seedrandom_fct='void_seedMTRand';
			$varResult_name='intMT_rng';
			switch($generator_name){
				case 'mt_rand':
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$fctRNG_name='int_MTRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedMTRand';
					$varResult_name='intMT_rng';				
					break;
				case 'rand':
					$libary_filename='LibC_rand.php';
					$class_name='class_LibCrand';
					$fctRNG_name='int_LibCRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedLibCRand';
					$varResult_name='intLibC_rng';				
					break;
				case 'random_int':
					$libary_filename='Crypt_Random.php';
					$class_name='class_CR';
					$fctRNG_name='int_CRrand';
					$have_supportSeed=false;
					$seedrandom_fct=null;
					$varResult_name='intCR_rng';				
					break;				
									
				default:
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$fctRNG_name='int_MTRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedMTRand';
					$varResult_name='intMT_rng';									
			}
			$library_filename=$dir_files.$libary_filename;
			return array($library_filename,$class_name,$have_supportSeed,$fctRNG_name,$seedrandom_fct,$varResult_name);		
		}
		private function rng($int_seed=null){						
			if(!$int_seed){
				$this->int_seed=$int_seed;
				$this->rng_fct=$this->fctRNG_name;
			}else{
				if( $this->assertValidRandomSeed($int_seed)){
					$this->int_seed=$int_seed;			
					$this->rng_fct=$this->seedrandom_fct;				
				}else{
					exit(1);
				}
			}
			//echo $this->rng_fct;		
		}
		
		public function __construct($generator_name='mt_rand',$rng_assert_handler,$int_seed=null,$int_min=0,$int_max=null){
			$this->generator_name=$generator_name;
			$arrGen_pars=$this->getGeneratorParameters($this->generator_name);
			$this->library_filename=$arrGen_pars[0];
			$this->class_name=$arrGen_pars[1];
			$this->have_supportSeed=$arrGen_pars[2];
			$this->fctRNG_name=$arrGen_pars[3];
			$this->seedrandom_fct=$arrGen_pars[4];
			$this->varRNG_resultName=$arrGen_pars[5];
			
			require_once($this->library_filename);
			$this->RNG_obj=new $this->class_name($int_min,$int_max);
			$this->int_min=$this->RNG_obj->int_min;
			$this->int_max=$this->RNG_obj->int_max;		
			if($this->have_supportSeed){
 				$this->seed_min=$this->RNG_obj->seed_min;
 				$this->seed_max=$this->RNG_obj->seed_max;
				if($this->int_min) $this->seed_min=max($this->seed_min,$this->int_min);
				if($this->int_max) $this->seed_max=min($this->seed_max,$this->int_max); 								
			}
			
			assert_options(ASSERT_ACTIVE, 1);
			assert_options(ASSERT_WARNING, 0);
			assert_options(ASSERT_QUIET_EVAL, 1);
			assert_options(ASSERT_CALLBACK, $rng_assert_handler);
			
			$this->rng($int_seed);
			
			return $this;			
		}

		public function random($subunitary_precision=0){
			if(!$this->int_seed){
				$this->rng=$this->RNG_obj->{$this->rng_fct}($this->int_min,$this->int_max);
			}else{
				$this->rng=$this->RNG_obj->{$this->rng_fct}($this->int_seed);
			}
			if($subunitary_precision!=0){
				$assert_msg = 'The min.value of ('.$this->int_min.') must be strictly < than max.value of ('.$this->int_max.') for random generator result!';
				$assert_expr='('.$this->int_max.'-'.$this->int_min.'>0)';
				$assert_result=assert($assert_expr ,$assert_msg);
				if($assert_result){
					$rng_subunitary_adjusted=($this->rng-$this->int_min)/($this->int_max-$this->int_min);
					$this->rng=round($rng_subunitary_adjusted,$subunitary_precision);
				}
			}
			return $this->rng;
		}
		public function seedRNG($int_seed) {
		  	$this->rng($int_seed);
		}
		public function resetRNG() {
			$int_seed=null;
		  	$this->rng($int_seed);
		  	
		}	
		
		public function assertValidRandomSeed($seed) {	
		 	$this->assert_msg = "The".$this->generator_name." generator don't have seed support.";
		 	$assert_result=assert('$this->have_supportSeed');			        
			if($this->have_supportSeed){
  				$assert_msg = 'Random seed should be a positive integer in [ '.$this->seed_min.' ; '.$this->seed_max.' ] !';
  				$assert_expr='is_finite('.$seed.') && '.$seed.' >= '.$this->seed_min.' && '.$seed.' <= '.$this->seed_max.' ';
  				$assert_result=assert($assert_expr ,$assert_msg);
  			}
  			return $assert_result;
		}

	}	
?>
