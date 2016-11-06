<?php
/**
 * Get current time
 * @return mixed
 */
function current_time(){
    return $_SERVER['REQUEST_TIME'];
}

/**
 * Get current time in human readable format
 */
function print_in_human_readable()       {
    date('Y-m-d H:i:s', currentTime());
}