<?php
//give the sticky value where the session exists // used in different pages
function sticky_info($category){
    if (isset($_SESSION['sticky'])) {
        return $_SESSION['sticky'][$category];
    }
}
//for givinig different colors to info defined in styles...
function give_the_class($name){
    if (isset($_SESSION['sticky'])) {
        echo $name;
    }
}

?>
