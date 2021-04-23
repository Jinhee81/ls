<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

    $sql_b = "select brandcode, name from brand";
    $result_b = mysqli_query($conn, $sql_b);

    $allRows_b = array();
    while( $row_b = mysqli_fetch_array($result_b) ){
        $allRows_b[] = $row_b;
    }

// print_r($allRows_b);
?>

<style>
td.primary {
    background-color: #CEF6F5;
}

td.fontgrey {
    color: #d8d8d8;
}
</style>

<header class="container jumbotron pt-3 pb-3 mb-2">
    <div class="row">
        <h3 class="">모델코드입니다.</h3>
    </div>
    <p class="lead">
        <!-- (1) 정확한 표현은 이해관계자리스트라고 보아도 무방합니다. 세입자(고객) 뿐만 아니라, 문의하는 사람 및 자주 거래하는 거래처도 저장할 수 있어요.<br> -->
        <!-- (1) 임대계약이 발생하면 숫자가 표시됩니다. (2)'기타' 분류는 임대계약 외의 일회성매출에 대한 고객을 분류할 수 있습니다.<br>
    (3) 등록해야할 세입자(임차인)가 많으면 고객센터로 연락주세요. 대신 등록작업 해드립니다. (1년계약시 유효 ^_^) -->
    </p>
</header>

<section class="container">
    <div class="row">
        <div class="col-3">
            <select name="brand" id="brand" class="form-control form-control-sm">
                <option value="all" class="">브랜드전체</option>
                <?php
                        for($i=0; $i < count($allRows_b); $i++) {
                            echo "<option value='".$allRows_b[$i]['brandcode']."'>".$allRows_b[$i]['name']."</option>";
                        }
                        ?>
            </select>
        </div>
        <div class="col-7">
            <table class="table table-sm table-hover text-center">
                <thead class="">
                    <tr class="table-primary">
                        <td class="">순번</td>
                        <td class="">모델코드</td>
                        <td class="">모델명</td>
                        <td class="">danawa</td>
                        <td class="">브랜드명(코드)</td>
                        <td class=""></td>
                    </tr>
                </thead>
                <tbody class="" id="tbodyArea">
                </tbody>
            </table>
        </div>
    </div>

</section>

<script src="/inc/js/jquery-3.3.1.min.js"></script>
<script src="/inc/js/bootstrap.min.js"></script>

<script>
function makeTable(a) {
    let makeTable = $.ajax({
        url: 'ajax/ajax_model.php',
        method: 'post',
        data: {
            'brand': a
        },
        success: function(data) {
            data = JSON.parse(data);

            // console.log(data);

            let returns = '';
            let count = 0;

            // $.each(data, function(key, value) {
            //     count += 1;

            //     returns += '<tr>';
            //     returns += '<td name=order>' + count + '</td>';
            //     returns += '<td name=modelcode class=primary>' + value.modelcode + '</td>';
            //     returns += '<td name=modelname>' + value.modelname + '</td>';
            //     returns += '<td name=danawa class=fontgrey>' + value.danawacode + '</td>';
            //     returns += '<td name=danawa>' + value.name + '</td>';
            //     returns += '</tr>';
            // });

            $.each(data, function(key, value) {
                count += 1;

                returns += `<tr>
                    <td name=order>${count}</td>
                    <td name=modelcode class=primary>${value.modelcode}</td>
                    <td name=modelname>${value.modelname}</td>
                    <td name=danawa><input type=text name=danawacode class='form-control form-control-sm text-center' value=${value.danawacode}></td>
                    <td name=brandname>${value.name}</td>
                    <td><span class="badge badge-info editbadge">수정</span></td>
                </tr>`;
            });

            $('#tbodyArea').html(returns);

        }
    })

    return makeTable;
}

$(document).ready(function() {
    let brand = $('#brand').val();
    brand = JSON.stringify(brand);

    makeTable(brand);
})

$('#brand').on('change', function() {
    let brand = $('#brand').val();
    brand = JSON.stringify(brand);

    makeTable(brand);
})
</script>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>