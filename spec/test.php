<?php
ini_set("allow_url_fopen", 1);
include "simple_html_dom.php";

$urlString = "http://auto.danawa.com/leaserent/?Work=priceCompare&Trims=69568&ProdType=R&Period=36&PriceType=2";

$data = file_get_html($urlString);

if($data){
    echo true;
} else {
    echo false;
}
?>