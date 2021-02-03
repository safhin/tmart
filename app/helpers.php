<?php

function perentMoney($price)
{
    return number_format(floatval($price), 2);
}