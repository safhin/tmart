<?php

function perentMoney($price)
{
    return number_format(floatval($price), 2);
}

function activeCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return ('storage/'.$path != null) && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.png');
}