<?php
    include "params.php";
    include "lang_dictionary.php";

    $initDate = $_POST["date"];
    $dateInSec = strtotime($initDate."00");
    $term = substr($initDate, -2);
    $model = $_POST["model"];
    $lang = $_POST['lang'];

    $a = $link[$model][2][$term][0];
    $b = $link[$model][2][$term][1];
    $delta = $link[$model][2][$term][2];

    $curLink = $link[$model][0].$initDate."/";
    $pageArr = file($curLink);

    $fileList = getFileList($link[$model][1], $model, date("H", $dateInSec), $a, $b, $delta);


    echo "<div class='title'>";
        echo "<div id='close' class='d-flex justify-content-end close' onclick=\"$('#details-wrapper').hide();\">";
            echo "<img src='assets/img/close.svg' alt='Закрыть'>";
        echo "</div>";
        echo "<div class='d-flex justify-content-center'>";
            echo $dictionary[$lang][9]." <span>".substr($initDate, 0, 4)."-".substr($initDate, 4, 2). "-".substr($initDate, 6, 2)."-".substr($initDate, 8)."</span>";
            echo $dictionary[$lang][10]." <span>".$model."</span>";
        echo "</div>";
    echo "</div>";
            $start = 11;
            for($i = 0; $i < count($fileList); $i++) {
                $resultArr[$i] = 0; //not found
            }
            for($i = 0; $i < count($fileList); $i++) {
                for($j = $start; $j < count($pageArr)-4; $j++) {
                    if(strpos($pageArr[$j], $fileList[$i], 80)) {
                        preg_match('/[0-9]{2,3}K/', $pageArr[$j], $fileSize);
                        $fileSize[0] = substr($fileSize[0],0,-1);
                        if ($fileSize[0] <= 30) {
                            $resultArr[$i] = 1; //small file size
                        }
                        else {
                            $resultArr[$i] = 2; //found
                        }
                        $start = $j+1;
                        break;
                    }
                }
            }


            $k = 0; $j = 0;
            $res[$k][0] = 0;
            $fix = $resultArr[0];
            for($i = 0; $i < count($resultArr); $i++) {
                if($fix != $resultArr[$i]) {
                    $j = $i - 1;
                    $res[$k][1] = $j * $delta;
                    $res[$k][2] = $fix;
                    $k++;
                    $res[$k][0] = $i *  $delta;
                    $fix = $resultArr[$i];
                }
            }
            $res[$k][1] = (count($resultArr) - 1) * $delta;
            $res[$k][2] = $fix;


            echo "<table id='details' class='table table-bordered table-hover'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th colspan='".count($res)."'>".$dictionary[$lang][11]."</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    echo "<tr>";
            foreach($res as $key => $value) {
                if($value[2] == 2) {
                    $class = "table-success";
                }
                else if ($value[2] == 1) {
                    $class = "table-info";
                }
                else if ($value[2] == 0) {
                    $class = "table-danger";
                }
                if($value[0] == $value[1]) {
                    echo "<th class='".$class."'>".$value[0]."</th>";
                }
                else {
                    echo "<th class='".$class."'>".$value[0]."-".$value[1]."</th>";
                }
            }
            echo "</tr>";
        echo "</tbody>";
    echo "</table>";

    function getFileList($link, $model, $term, $a, $b, $delta) {
        $j = 0;
        if(strpos($link, "HHH") === false) {
            //HH
            for($i = $a; $i <= $b; $i = $i + $delta) {
                if($i >= 0 && $i < 10) {$str = "0".$i;}
                else {$str = $i;}
                $arr[$j] = str_replace("HH", $str, $link);
                $j++;
            }
        }
        else {
            // HHH
            for($i = $a; $i <= $b; $i = $i + $delta) {
                if($i >= 0 && $i < 10) {$str = "00".$i;}
                else if($i >= 10 && $i <= 99) {$str = "0".$i;}
                else {$str = $i;}
                $arr[$j] = str_replace("HHH", $str, $link);
                $j++;
            }
        }
        return $arr;
    }
?>
