<?php
spl_autoload_register(function ($Nameclass) {
    include $Nameclass . '.php';
});
