<?php
    include "params.php";
    include "lang_dictionary.php";

    $t_1 = strtotime($_POST["t_1"]);
    $t_2 = strtotime($_POST["t_2"]);

    $lang = $_POST["lang"];

    $modelList = json_decode($_POST["modelList"]);
    $n = count($modelList);


    /*Вывод таблицы*/
    echo "<table class='table table-bordered table-hover'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th rowspan='2'><span class='white-space'>".$dictionary[$lang][12]."</span></th>";
                echo "<th colspan='".$n."'>".$dictionary[$lang][13]."</th>";
            echo "</tr>";
            echo "<tr>";
                for($i = 0; $i < $n; $i++) {
                    echo "<th>".$modelList[$i]."</th>";
                }
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for($i = $t_2; $i <= $t_1; $i+=21600) {
            echo "<tr>";
            echo "<td class='date'>".date("Y-m-d-H", $i)."</td>";
            for ($j = 0; $j < $n; $j++) {
                $curLink = $link[$modelList[$j]][0].date('YmdH', $i)."/";

                $file_headers = get_headers($curLink);
                if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $pageArr = false;
                }
                else {
                    $pageArr = file($curLink);
                }
                if($pageArr === false) {
                    $lastModifDate = "";
                    $class = "table-danger";
                }
                else {
                    $fileName = replaceH ($link[$modelList[$j]][1], $link[$modelList[$j]][2][date("H", $i)][1]);
                    preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}\s{1}[0-9]{2}:[0-9]{2}/', $pageArr[12], $lastModifDateArr);
                    foreach($pageArr as $key => $value) {
                        if(strpos($value, $fileName) !== false) {
                            preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}\s{1}[0-9]{2}:[0-9]{2}/', $value, $lastModifDateArr);
                            $lastModifDate = formLastModifDate($lastModifDateArr[0]);
                            $class = "table-success";
                            break;
                        }
                        else {
                            $class = "table-warning";
                        }
                    }
                }
                $onclick = ($class == "table-warning" || $class == "table-success")?"onClick=\"showDetails($(this).data('date'), $(this).data('model'), '".$lang."');\"":"";
                echo "<td class='".$class."' data-date='".date("YmdH", $i)."' data-model='".$modelList[$j]."'".$onclick.">".$lastModifDate."</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
    echo "</table>";

    function replaceH($name, $time) {
        if(strpos($name, "HHH") === false) {
            //HH
            if($time >= 0 && $time < 10) {$str = "0".$time;}
            else {$str = $time;}
            return str_replace("HH", $str, $name);
        }
        else {
            // HHH
            if($time >= 0 && $time < 10) {$str = "00".$time;}
            else if($time >= 10 && $time <= 99) {$str = "0".$time;}
            else {$str = $time;}
            return str_replace("HHH", $str, $name);
        }
    }

    function formLastModifDate ($str) {
        return "<span>".$str."</span>";
    }
 ?>
