<?php
define("DEFAULT_PAGINATION", "page");
define("DEFAULT_RANGE",5);
define("DEFAULT_PAGE_LIMIT", 5);

$page_count = $start_page =  $end_page = $previous = $next = $current = null;
$pages_in_range = array();
$pagination_item = DEFAULT_PAGINATION;



function pagination_data(array $values, $range = DEFAULT_RANGE )
{
    $num_items_per_page = $values["num_items_per_page"];
    $total_items = $values["total_items"];
    $items = $values["items"];
    $page_count = intval(ceil($total_items / $num_items_per_page));
    $current = $values["current_page_number"];
    if ($page_count < $current) {
        $current = $page_count;
    }

    if ($range > $page_count) {
        $range = $page_count;
    }

    $delta = intval(ceil($range / 2));

    if ($current - $delta > $page_count - $range) {
        $pages = range($page_count - $range + 1, $page_count);
    } else {
        if ($current - $delta < 0) {
            $delta = $current;
        }

        $offset = $current - $delta;
        $pages = range($offset + 1, $offset + $range);
    }
    $proximity = intval(floor($range / 2));

    $start_page  = $current - $proximity;
    $end_page    = $current + $proximity;

    if ($start_page < 1) {
        $end_page = min($end_page + (1 - $start_page), $page_count);
        $start_page = 1;
    }

    if ($end_page > $page_count) {
        $start_page = max($start_page - ($end_page - $page_count), 1);
        $end_page = $page_count;
    }

    $pagination_data = array(
        'last'              => $page_count,
        'current'           => $current,
        'num_items_per_page'   => $num_items_per_page,
        'first'             => 1,
        'page_count'         => $page_count,
        'total_count'        => $total_items,
        'page_range'         => $range,
        'start_page'         => $start_page,
        'end_page'           => $end_page
    );

    if ($current - 1 > 0) {
        $pagination_data['previous'] = $current - 1;
    }

    if ($current + 1 <= $page_count) {
        $pagination_data['next'] = $current + 1;
    }

    $pagination_data['pages_in_range'] = $pages;
    $pagination_data['first_page_in_range'] = min($pages);
    $pagination_data['last_page_in_range']  = max($pages);

    if (!empty($items)) {
        $pagination_data['current_item_count'] = get_number_of_items($values["items"]);
        $pagination_data['first_item_number'] = (($current - 1) * $num_items_per_page) + 1;
        $pagination_data['last_item_number'] = $pagination_data['first_item_number'] + $pagination_data['current_item_count'] - 1;
    }

    return $pagination_data;

}

function assign_varaiables(array $pagination_vars ){
    global $page_count, $start_page, $end_page, $pages_in_range, $next,  $previous, $current;
    extract($pagination_vars);
    $page_count = $page_count;
    $start_page = $start_page;
    $end_page = $end_page;
    $pages_in_range = $pages_in_range;
    $next = $next;
    $previous = $previous;
    $current = $current;


}

function get_number_of_items($items){
    if(!is_array($items))
        return 0;
    count($items);
}

function start_pagination(array $values){
    // merge all into only one array
    assign_varaiables(pagination_data($values));

}


function get_offset($current_page_number, $number_items_per_page){

    return intval(ceil(($current_page_number - 1)  * $number_items_per_page));

}
