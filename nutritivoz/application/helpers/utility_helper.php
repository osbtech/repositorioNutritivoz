<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

function asset_url() {
    return base_url() . 'assets/';
}

function asset_admin_url() {
    return base_url() . 'assets_admin/';
}

function base_url_control() {
    return base_url() . 'index.php/';
}

function calcularCostoEnvio($total) {
    if ($total <= 500) {
        return 100;
    } else if (($total > 500) && ($total <= 1000)) {
        return 50;
    } else if ($total > 1000) {
        return 0;
    }
}
