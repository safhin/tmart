<?php

function perentMoney($price)
{
    return number_format(floatval($price), 2);
}

function activeCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}