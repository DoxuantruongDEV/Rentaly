<?php
function formatDate($date)
{
    $datetime = new DateTime($date);
    return $datetime->format('F d, Y');
}
