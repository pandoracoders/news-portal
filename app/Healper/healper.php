<?php

function customUcwords($str)
{
    return ucwords(str_replace("_", " ", $str));
}
