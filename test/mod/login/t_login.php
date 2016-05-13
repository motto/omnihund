<?php
namespace test\mod\login;
use mod\login;
use lib\ell\Ell;
use mod\login\ModLT;



class T_login{
	
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
	
	}
	echo "T_login:------------- \n";
	T_login::strminmax();

	
	