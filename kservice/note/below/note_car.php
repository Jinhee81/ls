<?php
include "car4.php";//조회조건에 필요한 php파일
?>
<div class="p-3 mb-2 text-dark border border-info rounded">
    <table class="table table-borderless">
        <tr class="">
            <td class="" width=50%>
                <table class="table table-borderless table-sm">
                    <tr class="">
                        <th class="">브랜드</th>
                        <td class="">
                            <select class='form-control' name=brand id="brand">
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <th class="">모델명</th>
                        <td class="">
                            <select class='form-control' name=model id="model">
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <th class="">라인업명</th>
                        <td class="">
                            <select class='form-control' name=lineup id="lineup">
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <th class="">트림명</th>
                        <td class="">
                            <select class='form-control' name=trim id="trim">
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <th class="">소비자가(A)</th>
                        <td class="">
                            <input type="text" class="form-control text-right fontred numberComma" name=price id=price
                                value=0>
                        </td>
                    </tr>
                    <tr class="">

                    </tr>
                </table>
            </td>
            <td class="" colspan=2>
                <button class="btn btn-warning btn-sm" id=btnAdd>옵션추가</button><br>
                <table class="table table-sm mt-2">
                    <thead class="">
                        <tr class="table-info text-center">
                            <td class="" width=10%>순번</td>
                            <td class="" width=50%>옵션명</td>
                            <td class="" width=40%>옵션가격</td>
                        </tr>
                    </thead>
                    <tbody class="" id=optionRow>

                    </tbody>
                    <tfoot class="">
                        <tr class="">
                            <th class="text-right" colspan=2>옵션가(B)</th>
                            <!-- <td class=""></td> -->
                            <td>
                                <input type="text" class="form-control text-right form-control-sm fontred numberComma"
                                    name=optionTotalPrice id=optionTotalPrice value=0>
                            </td>
                        </tr>
                        <tr class="">
                            <th class="text-right" colspan=2>총차량가(A+B)</th>
                            <!-- <td class=""></td> -->
                            <td>
                                <input type="text" class="form-control form-control-sm text-right fontred numberComma"
                                    name=carPrice1 id=carPrice1>
                            </td>
                        </tr>
                        <tr class="">
                            <th class="text-right" colspan=2>할인금액</th>
                            <!-- <td class=""></td> -->
                            <td>
                                <input type="text" class="form-control form-control-sm text-right fontred numberComma"
                                    name=carPrice2 id=carPrice2>
                            </td>
                        </tr>
                        <tr class="">
                            <th class="text-right" colspan=2>할인적용금액</th>
                            <!-- <td class=""></td> -->
                            <td>
                                <input type="text" class="form-control form-control-sm text-right fontred numberComma"
                                    name=carPrice3 id=carPrice3>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <tr class="">
            <td class="" width="" colspan=2>
                <table class="table table-sm table-borderless">
                    <tr class="">
                        <th class="text-right">외장색상
                        </th>
                        <td class="">
                            <input type="text" class="form-control form-control-sm text-center" name=exColor id=exColor>
                        </td>
                        <th class="text-right">썬팅측후면
                        </th>
                        <td class="">
                            <input type="text" class="form-control form-control-sm text-center" name=suntingSide
                                id=suntingSide value=15%>
                        </td>
                        <th class="text-right">배기량
                        </th>
                        <td class="">
                            <input type="number" class="form-control form-control-sm text-center" name=cc id=cc>
                        </td>
                    </tr>
                    <tr class="">
                        <th class="text-right">내장색상
                        </th>
                        <td class="">
                            <input type="text" class="form-control form-control-sm text-center" name=inColor id=inColor>
                        </td>
                        <th class="text-right">썬팅전면
                        </th>
                        <td class="text-right">
                            <input type="text" class="form-control form-control-sm text-center" name=suntingFront
                                id=suntingFront value=35%>
                        </td>
                        <th class="text-right">유종
                        </th>
                        <td class="">
                            <select class='form-control form-control-sm' name=fuel id="fuel">
                                <option value="" class="">가솔린</option>
                                <option value="" class="">디젤</option>
                                <option value="" class="">LPi</option>
                                <option value="" class="">HEV</option>
                                <option value="" class="">전기</option>
                                <option value="" class="">수소</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<script>
let brandArray = <?=json_encode($brandArray)?>;
let modelArray = <?=json_encode($modelArray)?>;
let lineupArray = <?=json_encode($lineupArray)?>;
let trimArray = <?=json_encode($trimArray)?>;
// console.log(trimArray);
</script>

<script src="j_car4.js?<?=date('YmdHis')?>"></script>