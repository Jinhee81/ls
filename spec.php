<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include "view/header.php";
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
                    <!-- <td>
                        <select class="form-control" name="brand">
                            <option value="hd">현대</option>
                            <option value="kia">기아</option>
                            <option value="rss">삼성/쉐보레/쌍용</option>
                            <option value="genesis">제네시스</option>
                            <option value="import">수입차</option>
                        </select>
                    </td> -->
                    <td>
                        <select class="form-control" name="model">
                            <option value="69261">현대 그랜저</option>
                            <option value="70422">현대 싼타페</option>
                            <option value="71091">현대 투싼</option>
                            <option value="70587">현대 쏘나타</option>
                            <option value="69314">현대 팰리세이드</option>
                            <option value="62308">현대 포터2</option>
                            <option value="71481">기아 K5</option>
                            <option value="71281">기아 K7</option>
                            <option value="69052">기아 K9</option>
                            <option value="69063">기아 모하비</option>
                            <option value="71136">기아 스포티지</option>
                            <option value="71680">기아 쏘렌토</option>
                            <option value="70807">기아 카니발</option>
                            <option value="69506">제네시스 G80</option>
                            <option value="73461">제네시스 G90</option>
                            <option value="71838">제네시스 GV70</option>
                            <option value="70463">제네시스 GV80</option>
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

<div class="loader container">
    <img src="inc/img/abc.gif" alt="" class="" style="width:50px;height:50px;">
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
                    <th class="" name="lineupCount">lc</th>
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

<script src="inc/js/bootstrap.min.js?<?=date('YmdHis')?>"></script>
<script src="extract.js?<?=date('YmdHis')?>"></script>

<?php
include "view/footer.php";
?>