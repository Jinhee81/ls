<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);

/*-----------------------------------------------------------------------------  
*        제작자 : 강훈일 
*        제작일 : 2004. 1. 6 
*        이메일 : kanghoonil@npine.com , hoonil@javastars.com 
*        파일명 : lib_ImageConvert.php 
*         
*        > 함수 설명 < 
*        워터마크 처리 함수 
*         
*        > 전달인자 설명 < 
*        $imagePath                                :                워터마크를 처리할 이미지 
*        $waterMakeSourceImage        :                워터마크 이미지 
*        $ARGimageQuality                :                이미지 퀄리티 
*         
-----------------------------------------------------------------------------*/ 
FUNCTION imageWaterMaking($ARGimagePath, $ARGwaterMakeSourceImage, $ARGimageQuality = 100){ 
                #####----- 이미지 정보 가져오기 -----##### 
                $getSourceImageInfo = GETIMAGESIZE($ARGimagePath); 
                #####----- 원본 이미지 검사 -----##### 
                if(!$getSourceImageInfo[0]){ 
                                return ARRAY(0, "!!! 원본 이미지가 존재하지 않습니다. !!!"); 
                } 
                $getwaterMakeSourceImageInfo = GETIMAGESIZE($ARGwaterMakeSourceImage); 
                #####----- 워터마크 이미지 검사 -----##### 
                if(!$getwaterMakeSourceImageInfo[0]){ 
                                return ARRAY(0, "!!! 워터마크 이미지가 존재하지 않습니다. !!!"); 
                } 
                 
                #####----- 원본 이미지 생성(로드) -----##### 
                switch($getSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMGIF($ARGimagePath); 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMJPEG($ARGimagePath); 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        $sourceImage = IMAGECREATEFROMPNG($ARGimagePath); 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return array(0, "!!! 원본이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                #####----- 워터마크 이미지 생성(로드) -----##### 
                switch($getwaterMakeSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMGIF($ARGwaterMakeSourceImage); 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMJPEG($ARGwaterMakeSourceImage); 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        $waterMakeSourceImage = IMAGECREATEFROMPNG($ARGwaterMakeSourceImage); 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return array(0, "!!! 워터마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                 
                #####----- 워터마크 위치 구하기(중앙에 워터마크 삽입) -----##### 
                $waterMakePositionWidth = ($getSourceImageInfo[0] - $getwaterMakeSourceImageInfo[0]) / 2; 
                $waterMakePositionHeight = ($getSourceImageInfo[1] - $getwaterMakeSourceImageInfo[1]) / 2; 
                 
                #####----- 이미지 그리기 -----##### 
                /** 
                 *        $save_image=ImageCreate($save_path_width_size, $save_path_height_size) 부분에 원본이미지로 부터 복사본을 그린다. 
                 *        $arg1                :                ImageCreateTrueColor 리턴 인자(붙여넣기 할 이미지) 
                 *        $arg2                :                ImageCreateFromXXX 리턴 인자(복사할 이미지) 
                 *        $arg3                :                붙여넣기 할 이미지의 X 시작점 
                 *        $arg4                :                붙여넣기 할 이미지의 Y 시작점 
                 *        $arg5                :                복사할 이미지의 X 시작점 
                 *        $arg6                :                복사할 이미지의 Y 시작점 
                 *        $arg7                :                붙여넣기 할 이미지의 X 끝점 
                 *        $arg8                :                붙여넣기 할 이미지의 Y 끝점 
                 *        $arg9                :                복사할 이미지의 X 끝점 
                 *        $arg10                :                복사할 이미지의 Y 끝점 
                 */ 
                IMAGECOPYRESIZED($sourceImage, $waterMakeSourceImage, $waterMakePositionWidth, $waterMakePositionHeight, 0, 0, ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage), ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage)); 
                 
                #####----- 이미지 저장 -----##### 
                switch($getSourceImageInfo[2]){ 
                                case 1 :        #####----- GIF 포맷 형식 -----##### 
                                                        if(IMAGEGIF($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "GIF 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "GIF 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                case 2 :        #####----- JPG 포맷 형식 -----##### 
                                                        if(IMAGEJPEG($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "JPG 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "JPG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                case 3 :        #####----- PNG 포맷 형식 -----##### 
                                                        if(IMAGEPNG($sourceImage, $ARGimagePath, $ARGimageQuality)){ 
                                                                        return ARRAY(1, "PNG 형식 워터마크 이미지가 처리 되었습니다."); 
                                                        }else{ 
                                                                        return ARRAY(0, "PNG 형식 워터마크 이미지가 처리 도중 오류가 발생했습니다."); 
                                                        } 
                                                        break; 
                                default :        #####----- GIF, JPG, PNG 포맷방식이 아닐경우 오류 값을 리턴 후 종료 -----##### 
                                                        return ARRAY(0, "!!! 원본마크이미지가 GIF, JPG, PNG 포맷 방식이 아니어서 이미지 정보를 읽어올 수 없습니다. !!!"); 
                } 
                 
                 
} 

//워터마크를 삽입할 부분에 아래를 입력하시면 됩니다.
// imageWaterMaking(워터마크를 집어넣을 이미지경로/이미지화일명, 워터마크로 쓸 이미지, 이미지의퀄리티)
imageWaterMaking("../data/partner/20160219130214.jpg", "../_images/common/std.png", 100);


?> 

<img src="/data/partner/20160219130214.jpg">