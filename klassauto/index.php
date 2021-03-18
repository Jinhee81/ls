<?php
    ini_set("allow_url_fopen", 1);
    include "simple_html_dom.php";
    include "view/header.php";
    include "data/car.php";


    // $data = file_get_html("http://auto.danawa.com/leaserent/?Work=priceCompare&Trims=69151&ProdType=R&Period=36&PriceType=1");

    // $a = $data->find("div.rbw_title h3");

    // // foreach($data->find("ul.list_txt") as $ul){
    // //     foreach($ul -> find("li") as $li){
    // //         echo $li->plaintext."<br>";
    // //     }
    // // }

    // foreach($a as $value){
    //     echo $value->plaintext;
    // }
    
    // echo $data;

?>
<style>
td {
    width: 20%;
}
</style>
<section class="header container text-center mt-5">
    <div class="row justify-content-md-center">
        <div class="col-10">
            <table class="table table-bordered table-sm">
                <tr>
                    <td scope="col">브랜드</td>
                    <td scope="col">모델명</td>
                    <td scope="col">렌트/리스</td>
                    <td scope="col">개월수</td>
                    <td scope="col">보증금</td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" name="brand">
                            <option value="1">현대</option>
                            <option value="2">기아</option>
                            <option value="3">삼성/쉐보레/쌍용</option>
                            <option value="4">제네시스</option>
                            <option value="5">수입차</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="model">
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="rentlease">
                            <option value="rlall">렌트/리스</option>
                            <option value="r">렌트</option>
                            <option value="l">리스</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control">
                            <option value="pall">전체</option>
                            <option value="36">36개월</option>
                            <option value="48">48개월</option>
                            <option value="60">60개월</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control">
                            <option value="dall">전체</option>
                            <option value="1">0%</option>
                            <option value="2">선납금30%</option>
                            <option value="3">보증금30%</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>


</section>

<script>
var car = <?=json_encode($car)?>;
let brand = $('select[name=brand]').val();
console.log(car);

car[brand].forEach(function(item, index) {

})

// Object.keys(car);
// console.log(Object.entries(car));

// Object.entries(car).forEach(([key, value]) => console.log(`${key}: ${value[0]}`));

// console.log(Object.keys(car));

// let brand = $('select[name=brand]').val();
// console.log(brand);

// console.log(car[brand]);

// car[brand].forEach(item => item)

// console.log('hanju');

// let modeloption;

// Object.entries(car).forEach([key, value])
</script>

<?php
include "view/footer.php";
?>