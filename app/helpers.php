<?php
if (! function_exists('firstchars')) {
    function firstchars($string) {
        $words = explode(" ", $string);
        $acronym = "";
        foreach ($words as $w) {
        $acronym .= $w[0];
        }
        return strtoupper($acronym);
    }
}
if (! function_exists('stringcode')) {
    function stringcode($num, $index) {
        if($index == 2){
            return ($num>=10) ? $num : '0'.$num;
        }else{
            return ($num<10) ? '00'.$num : (($num<100) ? '0'.$num : $num);
        }
    }
}
?>
