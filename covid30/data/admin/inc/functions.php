<?php
function sanitize_string($val)
{
    $final_val = filter_var($val, FILTER_SANITIZE_STRING);
    return $final_val;
}
function sanitize_email($val)
{
    $final_val = filter_var($val, FILTER_SANITIZE_EMAIL);
    return $final_val;
}
function sanitize_int($val)
{
    $final_val = filter_var($val, FILTER_SANITIZE_NUMBER_INT);
    return $final_val;
}
function sanitize_float($val)
{
    $final_val = filter_var($val, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    return $final_val;
}
function sanitize_url($val)
{
    $final_val = filter_var($val, FILTER_SANITIZE_URL);
    return $final_val;
}
function sanitize_ckeditor($val)
{
    $final_val = strip_tags($val,'
                <h1><h2><h3><h4><h5><h6><p><img><b><i><u><ul><ol><li>
                <table><tbody><tr><td>
                ');
    return $final_val;
}


// Output Data
function safe_data($str)
{
    $output_value = htmlspecialchars_decode($str);
    return $output_value;
}

function date_format_1($dt)
{
	$ts = strtotime($dt);
	$day = date('d',$ts);
	$month = date('M',$ts);
	$year = date('Y',$ts);
	return $month.' '.$day.', '.$year;
}

function n_to_decimal($number)
{
    $final = number_format((float)$number, 2, '.', '');
    return $final;
}