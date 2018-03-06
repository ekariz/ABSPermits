<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ymd_dropdown{

    public function buildDayDropdown($name='',$id='',$value='')
    {
        $days='';
        while ( $days <= '31')
        {
            if($days>0)
            {
                $day[$days]=$days;
            }else{
                $day['select a day'] = '';  // PUT ANY DEFAULT VALUE HERE
            }
            $days++;
        }
        $id = 'id='.$id;
        return form_dropdown($name, $day, $value, $id);
    }

    function buildYearDropdown($name='',$id='',$value='')
    {
        $years = range(1900, date("Y"));
        array_unshift($years, 'Select a year');
        foreach($years as $year)
        {
            if($year == 'Select a year'){
                $year_list['Select a year'] = '';  // PUT ANY DEFAULT VALUE HERE
            }else{
                $year_list[$year] = $year;
            }
        }
        $id = 'id='.$id;
        return form_dropdown($name, $year_list, $value, $id);
    }

    function buildMonthDropdown($name='',$id='',$value='')
    {
        $month=array(
            'Select a month'=>'',   // PUT ANY DEFAULT VALUE HERE
            '01'=>'Jan',
            '02'=>'Feb',
            '03'=>'Mar',
            '04'=>'Apr',
            '05'=>'May',
            '06'=>'Jun',
            '07'=>'Jul',
            '08'=>'Aug',
            '09'=>'Sep',
            '10'=>'Oct',
            '11'=>'Nov',
            '12'=>'Dec');

        $id = 'id='.$id;
        return form_dropdown($name, $month, $value, $id);
    }

}
