<?php


    function pp($arr, $die="true")
    {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
            if($die == 'true')
            {
                die();
            }
    }

	function _print_r($array)
	{
		echo '<pre>';
		print_r($array);
		echo '</pre>';
    }

    function group_by($key, $data) {
        $result = array();
        foreach($data as &$val) {
            $val = (array)$val;
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }
        return $result;
    }

    function decamelize($string) {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }

    function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    function dataFormat($date)
    { 
            if(empty($date))
               return null;
            $return = new Carbon($date,'UTC');
            return $return;
    }

    function parseDateFormat($date,$format='Y-m-d')
    {
        if(empty($date))
            return null;
        return Carbon::parse($date,'UTC')->format($format);
    }

    
    function is_time_cron($time , $cron) 
    {
        $cron_parts = explode(' ' , $cron);
        if(count($cron_parts) != 5)
        {
            return false;
        }
        
        list($min , $hour , $day , $mon , $week) = explode(' ' , $cron);
        
        $to_check = array('min' => 'i' , 'hour' => 'G' , 'day' => 'j' , 'mon' => 'n' , 'week' => 'w');
        
        $ranges = array(
            'min' => '0-59' ,
            'hour' => '0-23' ,
            'day' => '1-31' ,
            'mon' => '1-12' ,
            'week' => '0-6' ,
        );
        
        foreach($to_check as $part => $c)
        {
            $val = $$part;
            $values = array();
            
            /*
                For patters like 0-23/2
            */
            if(strpos($val , '/') !== false)
            {
                //Get the range and step
                list($range , $steps) = explode('/' , $val);
                
                //Now get the start and stop
                if($range == '*')
                {
                    $range = $ranges[$part];
                }
                list($start , $stop) = explode('-' , $range);
                    
                for($i = $start ; $i <= $stop ; $i = $i + $steps)
                {
                    $values[] = $i;
                }
            }
            /*
                For patters like :
                2
                2,5,8
                2-23
            */
            else
            {
                $k = explode(',' , $val);
                
                foreach($k as $v)
                {
                    if(strpos($v , '-') !== false)
                    {
                        list($start , $stop) = explode('-' , $v);
                    
                        for($i = $start ; $i <= $stop ; $i++)
                        {
                            $values[] = $i;
                        }
                    }
                    else
                    {
                        $values[] = $v;
                    }
                }
            }
            
            if ( !in_array( date($c , $time) , $values ) and (strval($val) != '*') ) 
            {
                return false;
            }
        }
        
        return true;
    }

?>