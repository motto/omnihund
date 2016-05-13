<?php
namespace test\mod\login;
use mod\login;
use lib\ell\Ell;

class T_ell{

	static public function strminmax(){

		echo 'strminmax: hiba ág: ';

		$hibauz='hiba';
		$hibaT=['kk','jkjjjhj','jjjj j','kkkkké','lll@#$','lll #$','llléüő','lll üő',''];
		$joT=['000','kkkkk','jkk54','éáű',' áő','fd$@ ','&#1$@'];
		foreach($hibaT as $par){

			\GOB::$hiba['login']=[];
			Ell::regex($par, '/^.{3,5}$/u',$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['strminmax']='hibaág';
			}
				
		}
		echo ' jo ág: ';
		foreach($joT as $par){

			\GOB::$hiba['login']=[];
			Ell::regex($par, '/^.{3,5}$/u',$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['strminmax']='jóág';
			}
			//echo \GOB::$hiba['login'][0];

		}

		echo "\n";
	}
	static public function email(){

		echo 'email: hiba ág: ';

		$hibauz='hiba';
		$hibaT=['kkghfghfg','jkjjjhj.hu','jjjj j@kk.hu','kkkkkéj@kk.hu','j@kk.hulll@#$','llj@.hu','@ll.hu'];
		$joT=['jjjj@kk.hu','jjjj.fg@kll.com','jjjj.@fgkl.jl.com'];
		foreach($hibaT as $par){

			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['MAIL'],$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['email']='hibaág';
			}

		}
		echo ' jo ág: ';
		foreach($joT as $par){

			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['MAIL'],$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['email']='jóág';
			}
			//echo \GOB::$hiba['login'][0];

		}

		echo "\n";
	}
	static public function magyarszo(){
	
		echo 'magyarszo: hiba ág: ';
	
		$hibauz='hiba';
		$hibaT=['kjh ',' hjjk','áél.á','hg"','sdgh\'shg','sdfs<','@ll.hu'];
		$joT=['űáéőúófdsdfj','sadfafsf12','űáúőóüöéáŰÁŰÉŐÚÓÜÖ1111278'];
		foreach($hibaT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['HU_SZO'],$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['HU_SZO']='hibaág';
			}
	
		}
		echo ' jo:ág ';
		foreach($joT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['HU_SZO'],$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['HU_SZO']='jóág';
			}
			//echo \GOB::$hiba['login'][0];
	
		}
	
		echo "\n";
	}
	static public function magyartext(){
	
		echo 'magyartext: hiba ág: ';
	
		$hibauz='hiba';
		$hibaT=[' hjjk<','áél>á','','sdgh\'shg','sdfs<#','@ll.hu',';ll.hu'];
		$joT=['űáéőúófd sdfj','sadfafsf12!:','űáúőóüöéá". (ŰÁŰÉŐ ÚÓÜÖ1111278?'];
		foreach($hibaT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['HU_TEXT'],$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['HU_TEXT']='hibaág';
			}
	
		}
		echo ' jo ág: ';
		foreach($joT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['HU_TEXT'],$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';
			\GOBT::$resT['T_ell']['HU_TEXT']='jóág';
			}
			//echo \GOB::$hiba['login'][0];
	
		}
	
		echo "\n";
	}
	
}
echo "T_ell:------------- \n";
T_ell::strminmax();
T_ell::email();
T_ell::magyarszo();
T_ell::magyartext();

