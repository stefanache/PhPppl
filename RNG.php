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
		public function __construct($generator_name='mt_rand',$int_min=0,$int_max=null){
			$arrGen_pars=$this->getGeneratorParameters($generator_name);
			$libary_filename=$arrGen_pars[0];
			$class_name=$arrGen_pars[1];
			$varRNG_name=$arrGen_pars[2];
			require_once($libary_filename);
			$RNG_obj=new $class_name($int_min,$int_max);			
			$this->rng=$RNG_obj->{$varRNG_name};
		}
		public function getGeneratorParameters($generator_name='mt_rand'){
			$dir_files='./';
			$libary_filename='Mersenne_Twister.php';
			$class_name='class_MT';
			$varRNG_name='intMT_rng';
			switch($generator_name){
				case 'mt_rand':
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$varRNG_name='intMT_rng';				
					break;
				case 'rand':
					$libary_filename='LibC_rand.php';
					$class_name='class_LibCrand';
					$varRNG_name='intLibC_rng';				
					break;
				case 'random':
					$libary_filename='Crypt_Random.php';
					$class_name='class_CR';
					$varRNG_name='intCR_rng';				
					break;				
									
				default:
					$libary_filename='Mersenne_Twister.php';
					$class_name='class_MT';
					$varRNG_name='intMT_rng';									
			}
			$libary_filename=$dir_files.$libary_filename;
			return array($libary_filename,$class_name,$varRNG_name);		
		}
	}	
?>
