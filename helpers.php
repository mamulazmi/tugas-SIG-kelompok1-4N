<?php
function mergeMapsAndLocation(&$array1, &$array2) {
    $result = Array();
    foreach($array1 as $key => &$value) {
        $result[$key] = array_merge($value, $array2[$key]);
    }
    return $result;
}