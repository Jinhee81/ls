<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

    $sql = "select code, name
            from danawa
            where usepart = 'Y'
            ";
    $result = mysqli_query($conn, $sql);

    $allrows = array();
    while ($row = mysqli_fetch_array($result)){
        $allrows[] = $row;
    }

?>

<style>
td.t1 {
    width: 20%;
}

th.t2 {
    width: 6%;
}

.loader {
    display: none;
}
</style>
<section name='header' class="container text-center mt-5">
    <div class="row justify-content-md-center">
        <div class="col-10">
            <table class="table table-bordered table-sm">
                <tr>
                    <!-- <td scope="col">브랜드</td> -->
                    <td class="t1">모델명</td>
                    <td class="t1">렌트/리스</td>
                    <td class="t1">개월수</td>
                    <td class="t1">보증금</td>
                    <td class="t1"></td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" name="model">
                            <?php
                        for($i=0; $i < count($allrows); $i++) {
                            echo "<option value=".$allrows[$i]['code'].">".$allrows[$i]['name']."</option>";
                        }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="rentlease">
                            <option value="rlall">전체</option>
                            <option value="R" selected>렌트</option>
                            <option value="L">리스</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="period">
                            <option value="pall">전체</option>
                            <option value="36" selected>36개월</option>
                            <option value="48">48개월</option>
                            <option value="60">60개월</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="deposit">
                            <option value="dall">전체</option>
                            <option value="1" selected>0%</option>
                            <option value="2">선납금30%</option>
                            <option value="3">보증금30%</option>
                        </select>
                    </td>
                    <td class='pt-2 text-center'>
                        <button type='button' id='extract' class='btn btn-primary btn-sm'>조회하기</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>

<section class="text-center">
    <p class="purple font-italic">lc(lineup count)색상 표시 및 사용여부 N인것도 출력(단, font color red 적용) ^^</p>
</section>
<div class="loader container">
    <img src="/inc/img/abc.gif" alt="" class="" style="width:50px;height:50px;">
</div>

<section name='header' class="row justify-content-center mt-5" id="content">
    <!-- <p class="text-end">단위:원, 부가세포함 (렌트 R,/리스 L, 개월수 36/48/60개월, 보증금 1:0%,2:선납금30%,3:보증금30%)</p> -->
    <div class="col-11">
        <!-- <div class="">
        </div> -->
        <table class="table table-hover table-bordered table-sm text-center">
            <thead class="">
                <tr class="table-secondary">
                    <!-- <th class="t2" name="checkbox"></th> -->
                    <!-- <th class="t2" name="order">#</th> -->
                    <th class="" name="brand">브랜드명</th>
                    <th class="" name="model">모델명</th>
                    <th class="" name="lineup">라인업명</th>
                    <th class="" name="trim">트림명</th>
                    <th class="" name="bcode">브랜드코드</th>
                    <th class="" name="mcode">모델코드</th>
                    <th class="" name="lcode">라인업코드</th>
                    <th class="" name="tcode">트림코드</th>
                    <th class="" name="rentlease">상품구분</th>
                    <th class="" name="month">할부기간</th>
                    <th class="" name="deposit">가격타입</th>
                    <th class="" name="mf">월납부금</th>
                    <th class="" name="rf">잔존가치</th>
                    <th class="" name="gf">취득원가</th>
                    <th class="" name="j1">해지수수료</th>
                    <th class="" name="j2">약정거리</th>
                    <th class="" name="j3">혜택유무</th>
                    <th class="" name="j4">부가설명</th>
                    <!--18-->
                    <th class="" name="price">소비자가</th>
                    <th class="" name="fee">최저가</th>
                    <th class="" name="loadOrder">순번</th>
                    <!--전체순번-->
                    <th class="" name="loadOrder">#uo</th>
                    <!--url순번-->
                    <th class="" name="loadOrder">#uoo</th>
                    <!--url내의 순번-->
                    <th class="primary" name="lineupCount">lc</th>
                    <!--라인업개수-->
                    <th class="" name="lineupOrder">#l</th>
                    <!--라인업순번-->
                    <th class="" name="trimCount">tc</th>
                    <!--트림개수-->
                    <th class="" name="trimOrder">#t</th>
                    <!--트림순번-->
                    <!--27-->
                    <th class="" name="lineup_use">lu</th>
                    <th class="" name="trim_use">tu</th>
                    <!--29-->
                </tr>
            </thead>
            <tbody id="allvals">
                <tr class="">
                    <td class="" colspan="29">조회하기를 누르세요.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>
<script src="extract.js?<?=date('YmdHis')?>"></script>
</body>

</html>