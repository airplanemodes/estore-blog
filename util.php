<?php
function filter_post($_input_name, $_conn) {
    $input = trim(filter_input(INPUT_POST, $_input_name, FILTER_SANITIZE_STRING));
    $input = mysqli_real_escape_string($_conn, $input);
    return $input;
}

function old($_val) {
    return isset($_REQUEST[$_val]) ? $_REQUEST[$_val] : "";
}

function showError($_errorName, $_errorArray) {
    return isset($_errorArray[$_errorName]) ? $_errorArray[$_errorName] : "";
}