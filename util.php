<?php
// Login security
function user_verify() {
    $verify = false;
    if(isset($_SESSION['user_id'])) {
        // is an IP address, stored at the session match the current user's IP?
        if(isset($_SESSION['user_ip']) && $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR']) {
            // is a web browser, stored at the session match the current user's browser?
            if(isset($_SESSION['user_agent']) && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT']) {
                $verify = true;
            }
        }
    }

    return $verify;
};


// SQL injection prevention
function filter_post($_input_name, $_conn) {
    $input = trim(filter_input(INPUT_POST, $_input_name, FILTER_SANITIZE_STRING));
    $input = mysqli_real_escape_string($_conn, $input);
    return $input;
};


function filter_get($_input_name, $_conn) {
    $input = trim(filter_input(INPUT_GET, $_input_name, FILTER_SANITIZE_STRING));
    $input = mysqli_real_escape_string($_conn, $input);
    return $input;
};



function old($_val) {
    return isset($_REQUEST[$_val]) ? $_REQUEST[$_val] : "";
};



function showError($_errorName, $_errorArray) {
    return isset($_errorArray[$_errorName]) ? $_errorArray[$_errorName] : "";
};