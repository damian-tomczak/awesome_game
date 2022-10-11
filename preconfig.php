<?php
    enum Menu {
        case LOGIN;
        case NEWS;
        case LOGO;
        case INFO;
        case CONTACT;
    }

    function isEnable(Menu $menu, Menu $expected) {
        if (isset($menu) && ($menu == $expected)) {
            echo 'active';
        }
    }
?>