<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?=$subject?></title>
</head>

<body>

<div style="margin:30px auto;width:600px;border:10px solid #f7f7f7">
    <div style="border:1px solid #dedede">
        <h1 style="padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em">
            <?=$user_name?>님 비밀번호 찾기입니다.
        </h1>
        <!-- <span style="display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right">
            <a href="http://leaseman.co.kr" target="_blank">리스맨</a>
        </span> -->
        <p style="margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee">
            <b><?php echo $user_name ?></b> 님 비밀번호는 <?=$return_pass?> 입니다.<br>
			사이트 방문 후 임시비밀번호는 재설정 후 이용바랍니다.<br>
            <br>
            감사합니다.
        </p>
    </div>
</div>

</body>
</html>
