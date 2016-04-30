<?php
namespace test\mod\login;
use mod\login;
use lib\ell\Ell;
use mod\login\ModLT;

class T_login{
	
	static public function strminmax(){
		
		echo 'strminmax: hiba: ';
		
		$hibauz='hiba';	
		$hibaT=['kk','jkjjjhj','jjjj j','kkkkké','lll@#$','lll #$','llléüő','lll üő',''];
		$joT=['000','kkkkk','jkk54','éáű',' áő','fdjj '];
		foreach($hibaT as $par){

			\GOB::$hiba['login']=[];
			Ell::regex($par, '/^.{3,5}$/u',$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';}
			
		}
		echo ' jo: ';
		foreach($joT as $par){
		
			\GOB::$hiba['login']=[];
			Ell::regex($par, '/^.{3,5}$/u',$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';}
			//echo \GOB::$hiba['login'][0];
				
		}
		
		echo "\n";
	}
	static public function email(){
	
		echo 'email: hiba: ';
	
		$hibauz='hiba';
		$hibaT=['kkghfghfg','jkjjjhj.hu','jjjj j@kk.hu','kkkkkéj@kk.hu','j@kk.hulll@#$','llj@.hu','@ll.hu'];
		$joT=['jjjj@kk.hu','jjjj.fg@kll.com','jjjj.fg@kl.jl.com'];
		foreach($hibaT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['MAIL'],$hibauz,'login');
			if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(\GOB::$hiba['login'][0]==$hibauz){echo 'OK,';}else{echo '!!!,';}
				
		}
		echo ' jo: ';
		foreach($joT as $par){
	
			\GOB::$hiba['login']=[];
			Ell::regex($par, Ell::$regexT['MAIL'],$hibauz,'login');
			//if(!isset(\GOB::$hiba['login'][0])){\GOB::$hiba['login'][0]='ok';}
			if(!isset(\GOB::$hiba['login'][0])){echo 'OK,';}else{echo '!!!,';}
			//echo \GOB::$hiba['login'][0];
	
		}
	
		echo "\n";
	}
}
T_login::strminmax();
T_login::email();

