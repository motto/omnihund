<?php
trait alap
{
    public function alap()
    {
        ADT::$dataT=\lib\db\DB::assoc_tomb(PAR::$alap_sql);
    }

}
trait alap_view
{
    public function alap_view()
    {
        ADT::$dataT=\lib\db\DB::assoc_tomb(PAR::$alap_sql);
    }

}
trait alap_data
{
    public function alap_view()
    {
        ADT::$dataT=\lib\db\DB::assoc_tomb(PAR::$alap_sql);
    }

}