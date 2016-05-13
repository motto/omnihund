<?php
namespace app\admin;
use lib\html\FeltoltS;

defined( '_MOTTO' ) or die( 'Restricted access' );
\GOB::$html=file_get_contents('app/admin/tmpl/index.html', true);

$fget='user';
if(isset($_GET['fget'])){$fget=$_GET['fget'];}
if(isset($_POST['fget'])){$fget=$_POST['fget'];}

switch ($fget) {

    case 'home':

        break;
    default:
        include_once 'app/admin/'.$fget.'.php';
}

\GOB::$html= str_replace('<!--|tartalom|-->',ADT::$view,\GOB::$html);

\GOB::$html=FeltoltS::mod(\GOB::$html,MODPAR::class);
//\GOB::$html=FeltoltS::LT(\GOB::$html,ADT::$LT);
//\GOB::$html=FeltoltS::data(\GOB::$html,ADT::$dataT);
\GOB::$html=FeltoltS::tisztit(\GOB::$html);


?>