<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>리스맨</title>
    <link rel="icon" type="image/svg" href="/img/favicon.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
      shrink-to-fit=no">
    <!-- <meta property="og:image" content="https://www.instagram.com/"> -->
    <meta content='website' property='og:type'>
  	<meta content='http://charm3007.cafe24.com/leaseman/' property='og:url'>
  	<meta content='유진희' property='og:title'>
  	<meta content='회원가입웹사이트입니다' property='og:description'>
  	<meta content='http://charm3007.cafe24.com/PracticeIntroduce/img/ci.png' property='og:image'>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/css/font-awesome.min.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Gothic+A1:700|Nanum+Gothic" rel="stylesheet">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- <script src="/js/mdb.min.js"></script> 이걸왜했지? 머티리얼디자인부트스트랩 js파일임-->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/datepicker-ko.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="/js/daumAddressAPI.js"></script>
    <script>
    $(document).ready($( function() {
      $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
      });
    } ));
    </script>
  </head>
