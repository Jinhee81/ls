<?php
    ini_set("allow_url_fopen", 1);
    include "simple_html_dom.php";

    $data = file_get_html("http://auto.danawa.com/leaserent/?Work=priceCompare&Trims=69151&ProdType=R&Period=36&PriceType=1");

    // $a = $data->find("div.rbw_title h3");

    // // foreach($data->find("ul.list_txt") as $ul){
    // //     foreach($ul -> find("li") as $li){
    // //         echo $li->plaintext."<br>";
    // //     }
    // // }

    // foreach($a as $value){
    //     echo $value->plaintext;
    // }
    
    echo $data;
    

?>