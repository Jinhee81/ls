<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";

    include "car3.php";//조회조건에 필요한 php파일


    // $sql = "select 
    //             brand.name, modelname, lineupname, trimname, trimcode, trim.usepart, price
    //         from trim
    //         left join lineup on lineup.lineupcode = trim.lineupcode 
    //         left join model on lineup.modelcode = model.modelcode 
    //         left join brand on model.brandcode = brand.brandcode
    //         ";
    // $result = mysqli_query($conn, $sql);

    // $allRows = array();
    // while($row = mysqli_fetch_array($result)){
    //     $allRows[] = $row;
    // }
?>

<style>
td.primary {
    background-color: #CEF6F5;
}
</style>

<header class="container jumbotron pt-3 pb-3 mb-2">
    <div class="row">
        <h3 class="">트림코드입니다.</h3>
    </div>
    <p class="lead">
        <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
        <!-- (1) 임대계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 임대계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.<br>
    (3) 등록해야할 세입자(임차인)가 많으면 고객센터로 연락주세요. 대신 등록작업 해드립니다. (1년계약시 유효 ^_^) -->
    </p>
</header>

<section class="container" style="">
    <!-- 조회조건 -->
    <div class="row justify-content-md-center mb-3">
        <div class="col-10">
            <div class="row">
                <div class="col-3">
                    <select name="brand" id="brand" class="form-control form-control-sm">
                    </select>
                </div>
                <div class="col-3">
                    <select name="model" id="model" class="form-control form-control-sm">
                    </select>
                </div>
                <div class="col-6">
                    <select name="lineup" id="lineup" class="form-control form-control-sm">
                    </select>
                </div>
            </div>
        </div>
    </div>


    <!-- 테이블 -->
    <table class="table table-sm table-hover text-center">
        <thead class="">
            <tr class="table-primary">
                <td class="">순번</td>
                <td class="">브랜드명</td>
                <td class="">모델명</td>
                <td class="">라인업명</td>
                <td class="">트림명</td>
                <td class="">트림코드</td>
                <td class="">사용여부</td>
                <td class="">소비자가</td>
            </tr>
        </thead>
        <tbody class="" id="tbodyArea"></tbody>
    </table>
</section>

<script src="/inc/js/jquery-3.3.1.min.js"></script>
<script src="/inc/js/bootstrap.min.js"></script>

<script>
let brandArray = <?=json_encode($brandArray)?>;
let modelArray = <?=json_encode($modelArray)?>;
let lineupArray = <?=json_encode($lineupArray)?>;
</script>

<script src="car3.js?<?=date('YmdHis')?>"></script>

<script>
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function makeTable(a, b, c) {
    let makeTable = $.ajax({
        url: 'ajax/ajax_trim.php',
        method: 'post',
        data: {
            'brand': a,
            'model': b,
            'lineup': c
        },
        success: function(data) {
            data = JSON.parse(data);

            // console.log(data);

            let returns = '';
            let count = 0;

            $.each(data, function(key, value) {
                count += 1;

                returns += '<tr>';
                returns += '<td name=order>' + count + '</td>';
                returns += '<td name=brandname class=>' + value.name + '</td>';
                returns += '<td name=modelname>' + value.modelname + '</td>';
                returns += `<td name=lineupname class='text-left pl-5'>${value.lineupname}</td>`;
                returns += `<td name=trimname class='text-left pl-5'>${value.trimname}</td>`;
                returns += '<td name=trimcode class=primary>' + value.trimcode + '</td>';
                returns += '<td name=usepart>' + value.usepart + '</td>';
                returns += '<td name=usepart>' + numberWithCommas(value.price) + '</td>';
                returns += '</tr>';
            });

            $('#tbodyArea').html(returns);

        }
    })

    return makeTable;
}

$(document).ready(function() {
    brandIdx = JSON.stringify(brandIdx);
    modelIdx = JSON.stringify(modelIdx);
    lineupIdx = JSON.stringify(lineupIdx);

    makeTable(brandIdx, modelIdx, lineupIdx);
})

$('#brand').on('change', function() {
    brandIdx = $('#brand').val();
    modelIdx = $('#model').val();
    lineupIdx = $('#lineup').val();
    brandIdx = JSON.stringify(brandIdx);
    modelIdx = JSON.stringify(modelIdx);
    lineupIdx = JSON.stringify(lineupIdx);

    makeTable(brandIdx, modelIdx, lineupIdx);
})

$('#model').on('change', function() {
    brandIdx = $('#brand').val();
    modelIdx = $('#model').val();
    lineupIdx = $('#lineup').val();
    brandIdx = JSON.stringify(brandIdx);
    modelIdx = JSON.stringify(modelIdx);
    lineupIdx = JSON.stringify(lineupIdx);

    makeTable(brandIdx, modelIdx, lineupIdx);
})

$('#lineup').on('change', function() {
    brandIdx = $('#brand').val();
    modelIdx = $('#model').val();
    lineupIdx = $('#lineup').val();
    brandIdx = JSON.stringify(brandIdx);
    modelIdx = JSON.stringify(modelIdx);
    lineupIdx = JSON.stringify(lineupIdx);

    makeTable(brandIdx, modelIdx, lineupIdx);
})
</script>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>