<?php

function get_table_all($table) {
    $fetch = DB::table($table);
    $fetch = $fetch->get();
    return $fetch;
}

function get_table_all_where($table, $column_name, $value) {
    $fetch = DB::table($table);
    $fetch = $fetch->where($column_name, $value);
    $fetch = $fetch->get();
    return $fetch;
}

function get_table_json($table) {
    $fetch = DB::table($table)
    ->get();
    return $fetch->toJson(JSON_PRETTY_PRINT);
}

function status_meeting($start_date, $end_date) {
    $date_now =strtotime(date('d-m-Y H:i'));
    $start_date=strtotime($start_date);
    $end_date=strtotime($end_date);
    if($start_date<=$date_now and $date_now<=$end_date){
        return true;
    }else{
        return false;
    }
}
