<?php

function prer( $arr ) {
    // output array wrapped in a <pre>.
    echo '<pre>';
    print_r( $arr );
    echo '</pre>';
}


function pred( $arr ) {
    // output array wrapped in a <pre> with die().
    echo '<pre>';
    print_r( $arr );
    die();
}


function prump( $arr ) {
    // output array wrapped in a <pre> with die().
    echo '<pre>';
    var_dump( $arr );
    echo '</pre>';
}


function prumped( $arr ) {
    // output array wrapped in a <pre> with die().
    echo '<pre>';
    var_dump( $arr );
    die();
}