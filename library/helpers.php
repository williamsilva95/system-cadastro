<?php

function arrayToSelect(array $values, $key, $value, $noZeroIndex=null) {
    if(count($values) > 0)
    {
        $data = array();
        if($noZeroIndex==null)
        {
            $data[0] = 'Selecione';
        }
        foreach ($values as $row) {
            $data[$row[$key]] = $row[$value];
        }
        return $data;
    }else{
        if($noZeroIndex==null)
        {
            return ['Selecione'];
        }
        return [];
    }
}
