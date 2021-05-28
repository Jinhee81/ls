<?php
include "car4.php";//조회조건에 필요한 php파일
?>
<table class="table table-borderless mb-0">
    <tr class="">
        <td class="p-0" width=50%>
            <?php include "note_car_scar1.php";?>
        </td>
        <td class="p-0" colspan=>
            <?php include "note_car_scar2.php";?>
        </td>
    </tr>
</table>

<script>
let brandArray = <?=json_encode($brandArray)?>;
let modelArray = <?=json_encode($modelArray)?>;
let lineupArray = <?=json_encode($lineupArray)?>;
let trimArray = <?=json_encode($trimArray)?>;
// console.log(trimArray);
</script>

<script src="j_car4.js?<?=date('YmdHis')?>"></script>