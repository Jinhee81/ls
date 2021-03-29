<?php
    ini_set("allow_url_fopen", 1);
    include "simple_html_dom.php";

    include "data/car.php";

    // echo 'jinhee';

    $model = json_decode($_POST['model']);
    $rentlease = json_decode($_POST['rlArray']);
    $period = json_decode($_POST['pArray']);
    $deposit = json_decode($_POST['dArray']);

    // var_dump($model);

    // $model = '71838';
    // $rentlease = 'L';
    // $period = '48';
    // $deposit = '2';

    $brand_name = '';
    $brand_code = '';
    $model_name = '';
    $model_code = '';
    $lineup_code = '';
    $trim_code = '';
    $j1 = 'Y'; //해지수수료
    $j2 = '20000'; //약정거리
    $j3 = 'Y'; //혜택유무
    $j4 = '최신형 2CH 블랙박스, 썬팅(전면,측후면) 서비스'; //부가설명

    for($i=0; $i < count($model_array); $i++) {
        if($model_array[$i][3] === strval($model)){
            $model_name = $model_array[$i][0];
            $model_code = $model_array[$i][1];
            $brand_code = $model_array[$i][2];
            break;
        } 
    }

    // echo $model_name, $model_code, $brand_code;
    
    for($i=0; $i < count($brand_array); $i++) {
        if($brand_array[$i][1] === $brand_code){
            $brand_name = $brand_array[$i][0];
            break;
        } 
    }

    // echo $brand_name;

    // $aaa = array(
    //     array($model, $rentlease, $period, $deposit)
    // );
    $aaa = array();

    foreach ( $rentlease as $i ) {
        foreach ( $period as $j ) {
            foreach ( $deposit as $k) {
                $aa = array();
                array_push($aa, $model, $i, $j, $k);
                array_push($aaa, $aa);
            }
        }
    }

    // print_r($aaa);echo "<br>";

    $urlString = "http://auto.danawa.com/leaserent/?Work=priceCompare&Trims=".$aaa[0][0]."&ProdType=".$aaa[0][1]."&Period=".$aaa[0][2]."&PriceType=".$aaa[0][3];
    
    // echo $urlString."<br>";
    
    $data = file_get_html($urlString);
    
    // $brand_model_name_len[$x] = count($data->find("div.rbw_title h3"));
    $brand_model_name = $data->find("div.rbw_title h3");
    
    $brand_model_name = $brand_model_name[0]->plaintext;
    
    // echo $brand_model_name."<br>";
    // echo '112'."<br>";
    
    $urlString = array();
    $lineup = array();
    $trim = array();
    
    for($x = 0; $x < count($aaa); $x++){
        $k = 0;
        
        $urlString[$x] = "http://auto.danawa.com/leaserent/?Work=priceCompare&Trims=".$aaa[$x][0]."&ProdType=".$aaa[$x][1]."&Period=".$aaa[$x][2]."&PriceType=".$aaa[$x][3];

        $data = file_get_html($urlString[$x]);

        
        $lineuplen = count($data -> find('div.ml_con dl.mlc_main dt'));

        // var_dump($lineuplen); echo "<br>";


        for($i=0; $i < $lineuplen; $i++){
            $lineupName = $data -> find('div.ml_con dl.mlc_main dt', $i);
            $lineupName = $lineupName -> plaintext;

            for ($j=0; $j<count($lineup_array); $j++) {
                if($lineupName === $lineup_array[$j][0]) {
                    if($model_code === $lineup_array[$j][2]) {
                        $lineup_code = $lineup_array[$j][1];
                        $lineup_use = $lineup_array[$j][3];
                        break;
                    }
                }
            }

            if($lineup_use==='Y'){
                $trimCount = count($data -> find('div.ml_con dl.mlc_main', $i) -> children(1) -> children(0) -> children());
            
            
                for($j=0; $j < $trimCount; $j++) {

                    $trimEle = array();
                    $k += 1; //조회순번의 순번
                    $trimName = $data -> find('div.ml_con dl.mlc_main', $i) -> children(1) -> children(0) -> children($j) -> children(1) -> children(0) -> children(0);

                    $trimPrice = $data -> find('div.ml_con dl.mlc_main', $i) -> children(1) -> children(0) -> children($j) -> children(1) -> children(1);

                    $trimFee = $data -> find('div.ml_con dl.mlc_main', $i) -> children(1) -> children(0) -> children($j) -> children(2);

                    $trimName = $trimName -> plaintext;

                    for ($m=0; $m<count($trim_array); $m++) {
                        if($trimName === $trim_array[$m][0]) {
                            if($lineup_code === $trim_array[$m][2]) {
                                $trim_code = $trim_array[$m][1];
                                $trim_use = $trim_array[$m][3];
                                break;
                            }
                        }
                    }//트림코드 추출
                    
                    $trimPrice = $trimPrice -> plaintext;
                    $trimFee = $trimFee -> plaintext; //사이트의최저가
                    $trimFee = str_replace("월 ", "", $trimFee);
                    $trimFee = str_replace("원", "", $trimFee);
                    $trimFee = str_replace(",", "", $trimFee);
                    $modifiedTrimFee = (int)$trimFee - 10;//10원제외한 최저가
                    
                    $trimPrice = str_replace("원", "", $trimPrice);
                    $trimPrice = str_replace(",", "", $trimPrice);
                    
                    $remainAmount = round((int)$trimPrice/1.8, -3);//잔존가치, 소비자가/1.8
                    
                    if($aaa[$x][1]==='R'){
                        $gainAmount = '';
                    } else {
                        $gainAmount = round((int)$trimPrice*1.054+300000,0);
                    }
                    //취득원가, 리스만해당, 소비자가*1.054+30만원
                    
                    if($trim_use==='Y') {
                        array_push($trimEle, $brand_name, $model_name, $lineupName, $trimName, $brand_code, $model_code, $lineup_code, $trim_code, $aaa[$x][1], $aaa[$x][2], $aaa[$x][3], $modifiedTrimFee, $remainAmount, $gainAmount, $j1, $j2, $j3, $j4, $trimPrice, $trimFee, $x+1, $k, $lineuplen, $i+1, $trimCount, $j+1, $lineup_use, $trim_use);
                        array_push($lineup, $trimEle);
                    }

                    //x+1, url개수
                    //k, url 내에서의 순번
                    //i+1, 라인업순번
                    //j+1, 트림순번
                }
            }

        }
    }

    echo json_encode($lineup);
    

    // print_r($lineup);
    // // echo "<br>";

    // // print_r(count($lineup));
    // // echo "<br>";
    // // echo "123"."<br>";
    
?>