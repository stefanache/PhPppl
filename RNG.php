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
		public $generator_name=null;
		public $RNG_obj=null;
		public $rng=null;
		public $dir_files='./';
		public $library_filename='';
		public $class_name='';
		public $fctRNG_name='';
		public $have_supportSeed=false;
		public $seedrandom_fct=null;
		

		public function __construct($generator_name='mt_rand',$rng_assert_handler,$int_min=0,$int_max=null){
			$this->generator_name=$generator_name;
			$arrGen_pars=$this->getGeneratorParameters($this->generator_name);
			$this->library_filename=$arrGen_pars[0];
			$this->class_name=$arrGen_pars[1];
			$this->varRNG_name=$arrGen_pars[2];
			$this->have_supportSeed=$arrGen_pars[3];
			$this->seedrandom_fct=$arrGen_pars[4];
			
			require_once($this->library_filename);
			$this->RNG_obj=new $this->class_name($int_min,$int_max);
						
			$this->rng($int_min,$int_max);
						
			// Active assert and make it quiet
			assert_options(ASSERT_ACTIVE, 1);
			assert_options(ASSERT_WARNING, 0);
			assert_options(ASSERT_QUIET_EVAL, 1);
			assert_options(ASSERT_CALLBACK, $rng_assert_handler);			
		}
		public function getGeneratorParameters($generator_name='mt_rand'){
			$dir_files=$this->dir_files;
			$library_filename='Mersenne_Twister.php';
			$class_name='class_MT';
			$fctRNG_name='int_MTRand';
			$have_supportSeed=true;
			$seedrandom_fct='void_seedMTRand';
			switch($generator_name){
				case 'mt_rand':
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$fctRNG_name='int_MTRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedMTRand';				
					break;
				case 'rand':
					$libary_filename='LibC_rand.php';
					$class_name='class_LibCrand';
					$fctRNG_name='int_LibCRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedLibCRand';				
					break;
				case 'random':
					$libary_filename='Crypt_Random.php';
					$class_name='class_CR';
					$fctRNG_name='int_CRrand';
					$have_supportSeed=false;
					$seedrandom_fct=null;				
					break;				
									
				default:
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$fctRNG_name='int_MTRand';
					$have_supportSeed=true;
					$seedrandom_fct='void_seedMTRand';									
			}
			$library_filename=$dir_files.$libary_filename;
			return array($library_filename,$class_name,$fctRNG_name,$seedrandom_fct);		
		}
		public function rng($int_min=0,$int_max=null){			
			$this->rng=$this->RNG_obj->{$this->varRNG_name}($int_min,$int_max);		
		}
		public function random($int_min=0,$int_max=null){
			$this->rng($int_min,$int_max);
			return $this->rng;
		}
		public function seedRNG($seed) {
		 	if(!$this->have_supportSeed){
		 		$error_msg = "The".$this->generator_name." generator don't have seed support.";
		 		//echo $this->assert_msg ;
		 		assert(false,$error_msg);
		 	}else{
		  		$this->seedrandom_fct($seed);
		  		$this->resetRNG();
		  	}
		}
		public function resetRNG() {
		  	$this->rng = $this->rng();
		}	
		
		public function assertValidRandomSeed($seed) {
		        
			if(!$this->have_supportSeed){
		 		$this->assert_msg = "The".$this->generator_name." generator don't have seed support.";
		 		assert(false);
		 	}else{
  				$assert_msg = 'Random seed should be a positive integer in [ '.$this->RNG_obj->seed_min.' ; '.$this->RNG_obj->seed_max.' ] !';
  				$assert_expr='is_finite('.$seed.') && '.$seed.' >= '.$this->RNG_obj->seed_min.' && '.$seed.' <= '.$this->RNG_obj->seed_max.' ';
  				assert($assert_expr ,$assert_msg);
  			}
		}
	}	
?>
