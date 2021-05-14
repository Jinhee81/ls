<?php
    session_start();
    if(!isset($_SESSION['is_login'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
    }
    include $_SERVER['DOCUMENT_ROOT']."/view/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/view/conn.php";

    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    settype($filtered_id, 'integer');

    $sql = "select
                idnote, firstDate, channel, danawaNumber,
                c_name, c_contact, c_location,
                rentlease, c_content,
                sales_content,
                user.name as username,
                user.department as department
            from note
            left join user
            on note.usercode = user.usercode
            where idnote={$filtered_id}
            ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $clist['firstDate'] = htmlspecialchars($row['firstDate']);
    $clist['channel'] = htmlspecialchars($row['channel']);
    $clist['danawaNumber'] = htmlspecialchars($row['danawaNumber']);
    $clist['c_name'] = htmlspecialchars($row['c_name']);
    $clist['c_contact'] = htmlspecialchars($row['c_contact']);
    $clist['c_location'] = htmlspecialchars($row['c_location']);
    $clist['rentlease'] = htmlspecialchars($row['rentlease']);
    $clist['c_content'] = htmlspecialchars($row['c_content']);
    $clist['sales_content'] = htmlspecialchars($row['sales_content']);
    $clist['usercode'] = htmlspecialchars($row['usercode']);
    $clist['username'] = htmlspecialchars($row['username']);
    $clist['department'] = htmlspecialchars($row['department']);

?>

<style>
td.primary {
    background-color: #CEF6F5;
}
</style>

<section class="container">
    <div class="jumbotron pt-3 pb-3">
        <h3 class=""> >> 상담 진행 화면이에요 :)</h3>
        <p class="lead">열심히 다가가면 언젠가 이루어진답니다. 희망을 잃지 마세요.^^ </p>
        <hr class="my-4">
        <small class="text-right">클라스오토는 계약율, 고객인지도, 서비스만족도가 높은 업체로 상단에 노출되어 있습니다. <br class="">
            목표의식, 두려움, 타성을 이겨내는 순간, 일에 대한 열정을 불어 넣을 수 있다. - <span class=font-italic>로버트 J 크리겔.</span></small>
    </div>
</section>

<section class="container">
    <div class="border border-info rounded mb-4">
        <div class="container">
            <div class="row justify-content-md-end mr-1 mb-2 mt-2">
                <button class="btn btn-danger mr-1 btn-sm" id=btnSave>저장</button>
                <a href='note.php'><button type='button' class='btn btn-secondary btn-sm'><i
                            class="fas fa-angle-double-right"></i>
                        상담목록</button></a>
            </div>

            <table class="table">
                <tr>
                    <th class="fontblue" width=10%>부서명</th>
                    <td class="">
                        <select name="department" id="department" class="form-control center">
                            <option value="관리팀" class="" <?php if($clist['department']==='관리팀'){echo "selected";}?>>관리팀
                            </option>
                            <option value="영업1팀" class="" <?php if($clist['department']==='영업1팀'){echo "selected";}?>>
                                영업1팀
                            </option>
                            <option value="영업2팀" class="" <?php if($clist['department']==='영업2팀'){echo "selected";}?>>
                                영업2팀
                            </option>
                            <option value="영업3팀" class="" <?php if($clist['department']==='영업3팀'){echo "selected";}?>>
                                영업3팀
                            </option>
                            <option value="영업4팀" class="" <?php if($clist['department']==='영업4팀'){echo "selected";}?>>
                                영업4팀
                            </option>
                        </select>
                    </td>
                    <th class="fontblue">담당자명</th>
                    <td class="">
                        <input type="text" class="form-control text-center" name="salesman" id="salesman"
                            value=<?=$clist['username']?>>
                    </td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                </tr>
                <tr class="">
                    <th class="fontblue">상담일</th>
                    <td class="">
                        <input type="text" class="form-control text-center dateType" name="firstDate" id="firstDate"
                            value="<?=$clist['firstDate']?>">
                    </td>
                    <th class="fontblue">유입경로</th>
                    <td class="">
                        <select name="channel" id="channel" class="form-control center">
                            <option value="다나와" class="" <?php if($clist['channel']==='다나와'){echo "selected";}?>>다나와
                            </option>
                            <option value="홈페이지" class="" <?php if($clist['channel']==='홈페이지'){echo "selected";}?>>홈페이지
                            </option>
                            <option value="기타" class="" <?php if($clist['channel']==='기타'){echo "selected";}?>>기타
                            </option>
                        </select>
                    </td>
                    <th class="fontblue">다나와번호</th>
                    <td class="">
                        <input type="number" class="form-control text-center" name="danawaNumber" id="danawaNumber"
                            value="<?=$clist['danawaNumber']?>">
                    </td>
                    <td class=""></td>
                </tr>
                <tr class="">
                    <th class="fontblue">고객명</th>
                    <td class="">
                        <input type="text" class="form-control text-center" name="customerName" id="customerName"
                            value="<?=$clist['c_name']?>">
                        <button class="btn btn-warning btn-sm">고객등록</button>
                    </td>
                    <th class="fontblue">연락처</th>
                    <td class="">
                        <input type="text" class="form-control text-center" name="customerContact" id="customerContact"
                            value="<?=$clist['c_contact']?>">
                    </td>
                    <th class="fontblue">위치</th>
                    <td class="">
                        <input type="text" class="form-control text-center" name="customerLocation"
                            id="customerLocation" value="<?=$clist['c_location']?>">
                    </td>
                    <td class="">
                        <select name="rentlease" id="rentlease" class="form-control fontred">
                            <option value="렌트" class="" <?php if($clist['rentlease']==='렌트'){echo "selected";}?>>렌트
                            </option>
                            <option value="리스" class="" <?php if($clist['rentlease']==='리스'){echo "selected";}?>>리스
                            </option>
                            <option value="렌트+리스" class="" <?php if($clist['rentlease']==='렌트+리스'){echo "selected";}?>>
                                렌트+리스
                            </option>
                        </select>
                    </td>
                </tr>
                <tr class="">
                    <th class="fontblue">고객<br>요청사항</th>
                    <td class="" colspan=6><textarea name="customerContent" id="customerContent" cols="120" rows="5"
                            class="form-control"><?=$clist['c_content']?></textarea></td>
                </tr>
                <tr class="">
                    <th class="">상담내용</th>
                    <td class="" colspan=6><textarea name="salesContent" id="salesContent" cols="120" rows="5"
                            class="form-control"><?=$clist['sales_content']?></textarea></td>
                </tr>
            </table>
        </div>


    </div>
</section>

<!-- 하단 탭 -->
<section class=container>
    <nav>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link<?php if($_GET['page']==='carInfo'){echo " active";}?>"
                    href="note_edit.php?page=carInfo&id=<?=$filtered_id?>">차량정보</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php if($_GET['page']==='customerInfo'){echo " active";}?>"
                    href="note_edit.php?page=customerInfo&id=<?=$filtered_id?>">고객정보</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php if($_GET['page']==='contractInfo'){echo " active";}?>"
                    href="note_edit.php?page=contractInfo&id=<?=$filtered_id?>">계약/보험정보</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link<?php if($_GET['page']==='insuranceInfo'){echo " active";}?>"
                    href="note_edit.php?page=insuranceInfo&id=<?=$filtered_id?>">보험정보</a>
            </li> -->
        </ul>
    </nav>
    <div class="">
        <?php if($_GET['page']==='carInfo'){
            include "below/note_car.php";
        } else if($_GET['page']==='customerInfo'){
            include "below/note_customer.php";
        } else if($_GET['page']==='contractInfo'){
            include "below/note_contract.php";
        } else if($_GET['page']==='insuranceInfo'){
            include "below/note_insurance.php";
        }
        ?>
    </div>
</section>

<?php
include $_SERVER['DOCUMENT_ROOT']."/view/footer.php";
?>

<script class="">
$('#btnSave').on('click', function() {
    let firstDate = $('#firstDate').val();
    let channel = $('#channel :selected').val();
    let danawaNumber = $('#danawaNumber').val();
    let customerName = $('#customerName').val();
    let customerContact = $('#customerContact').val();
    let customerLocation = $('#customerLocation').val();
    let rentlease = $('#rentlease :selected').val();
    let customerContent = $('#customerContent').val();
    let salesContent = $('#salesContent').val();
    let department = $('#department :selected').val();
    let salesman = $('#salesman').val();
    let idnote = <?=$filtered_id?>;

    console.log(firstDate, channel, danawaNumber, customerName, customerContact, customerLocation, rentlease,
        customerContent, salesContent, department, salesman, idnote);

    $.ajax({
        url: '../ajax/ajax_note_edit.php',
        method: 'post',
        data: {
            'firstDate': firstDate,
            'channel': channel,
            'danawaNumber': danawaNumber,
            'customerName': customerName,
            'customerContact': customerContact,
            'customerLocation': customerLocation,
            'rentlease': rentlease,
            'customerContent': customerContent,
            'salesContent': salesContent,
            'department': department,
            'salesman': salesman,
            'idnote': idnote
        },
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            if (data === 'account_error') {
                alert('해당부서에 담당자명이 존재하지 않아요. 다시 확인해주세요.')
                return false;
            } else if (data === 'save_error') {
                alert('저장하지 못했습니다. 관리자에게 문의하세요.')
                return false;
            } else {
                alert('저장했습니다.');
                location.reload();
            }
        }
    })
})

$('#btnAdd').on('click', function() {
    let ordered = $('#optionRow tr').length + 1;

    let row = `<tr class=text-center>
            <td>${ordered}</td>
            <td><input type=text class='form-control form-control-sm text-center' name=eachOptionName></td>
            <td><input type=text class='form-control form-control-sm numberComma text-right eachOptionPrice' name=eachOptionPrice></td>
           </tr>`;

    $('#optionRow').append(row);
    $('.eachOptionPrice').on('click', function() {
        $(this).number(true);

        let optionTotalPrice = 0;

        for (let i = 0; i < $('#optionRow tr').length; i++) {
            let eachOptionPrice = $(`#optionRow tr:eq(${i})`).find('input[name=eachOptionPrice]').val();

            optionTotalPrice += Number(eachOptionPrice.replace(',', ''));
        }

        // $('#optionTotalPrice').empty();
        $('#optionTotalPrice').val(optionTotalPrice);

        let price1 = $('#price').val(); //소비자가
        let price2 = optionTotalPrice + Number(price1.replace(',', '')); //총합계
        $('#carPrice1').val(price2);
    })
})
</script>
</body>

</html>