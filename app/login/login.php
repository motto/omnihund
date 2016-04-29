<?php
use mod\MOD;
GOB::$html=file_get_contents('app/login/tmpl/index.html', true);
$tartalom=MOD::login();
//echo $tartalom;
GOB::$html= str_replace('<!--|tartalom|-->',$tartalom ,GOB::$html);
