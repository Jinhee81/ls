<!-- 차량의 기본가격부문 -->
<table class="table table-borderless mb-0 table-sm">
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
            <input type="text" class="form-control text-right fontred numberComma" name=price id=price value=0>
        </td>
    </tr>
    <tr class="">
        <td class="" colspan=2>
            <?php include "note_car_scar3.php";?>
        </td>
    </tr>
</table>