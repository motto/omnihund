<?php
namespace mod\login;
defined( '_MOTTO' ) or die( 'Restricted access' );
//include_once 'mod/login/lt.php';
//use lib\db\DB;
//use lib\ell;
//use lib\ell;
//use lib\ell\Ell;
//use lib\db\DBA;

class Login
{
    public function result()
    {
        $func='alap';
        if(isset($_POST['ltask'])){$func=$_POST['ltask'];}
        $this->$func();
        $hiba = LogDataS::hibakiir();
        LogADT::$view = str_replace('<!--<h5>hiba</h5>-->', $hiba, LogADT::$view);
        return LogADT::$view;
    }
    public function alap()
    {
        if ($_SESSION['userid'] > 0) {
            LogADT::$view= file_get_contents(LogADT::$kilep_form, true);
        } else {
            LogADT::$view= file_get_contents(LogADT::$belep_form, true); 
        }
    }

    public function belep()
    {
            $this->alap();
    }

    public function kilep()
    {
       /* if(isset($_COOKIE['cook_sess_id']))
        {
        setcookie("cook_sess_id", "", time()-COOKIE_EXPIRE, COOKIE_PATH);
        }*/
        $_SESSION['userid'] = 0;
        $this->alap();
    }
 //szerk--------------------------------  
    public function szerk()
    {
    	LogADT::$view= file_get_contents(LogADT::$szerk_form, true);
    }
    public function passwd_szerk()
    {
    	LogADT::$view= file_get_contents(LogADT::$szerk_passwd, true);
    }
     public function username_szerk()
    {
          LogADT::$view= file_get_contents(LogADT::$szerk_username, true);
    }
     public function email_szerk()
    {
    	LogADT::$view= file_get_contents(LogADT::$szerk_email, true);
    }
    
  //ment--------------------------------------------  
    public function passwd_ment()
    {
      LogDataS::passwdchange();
        if (empty(\GOB::$hiba['login'])) {
        	\GOB::$hiba['login'][]='A jelszó változtatás sikeres.';
        	//$this->kilep();
            $this->alap();
        } else {
           $this->passwd_szerk();
        }
    }
  
   
    public function email_ment()
    {
     LogDataS::emailchange();
        if (empty(\GOB::$hiba['login'])) {
        	\GOB::$hiba['login'][]='Az email váloztatás sikeres!';
            $this->alap();
        } else {
           $this->email_szerk();
        }
    }
    
    public function username_ment()
    {
        LogDataS::usernamechange();
        if (empty(\GOB::$hiba['login'])) {
        	\GOB::$hiba['login'][]='A felhasználónév váloztatás sikeres!';
            $this->kilep();
            $this->alap();
        } else {
           $this->username_szerk();
        }
    }
    public function ment()
    {
    
    	if (LogDataS::ment()) {
    		\GOB::$hiba['login'][]='A regisztráció sikeres!';
    		$this->alap();
    	} else {
    		$view = file_get_contents(LogADT::$reg_form, true);
    		$hiba = LogDataS::hibakiir();
    		$tartalom = str_replace('<!--<h5>hiba</h5>-->', $hiba, $view);
    		LogADT::$view= $tartalom;
    	}
    
    }
    public function reg()
    {
       LogADT::$view= file_get_contents(LogADT::$reg_form, true);
        if(isset($_POST['ref'])){
           // LogADT::$view = str_replace('<!--<h5>ref</h5>-->','<h5>Ref:'.$_POST['ref'].'</h5>', LogADT::$view);
           // LogADT::$view = str_replace('data="ref"','value="'.$_POST['ref'].'"', LogADT::$view);
        }

    }

  

    public function cancel()
    {
        $this->alap();
    }
}

