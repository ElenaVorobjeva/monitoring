<?php
    include "lang_dictionary.php";

    $lang = $_POST['lang'];

    echo "<header class='row'>";
        echo "<div class='col-6 d-flex justify-content-start'>";
            echo "<div class='d-flex'>";
                echo "<div class='logo'>";
                    echo "<img src='assets/img/logo-hmc.png' alt='logo'>";
                echo "</div>";
                echo "<div class='main_text'>";
                    echo "<a href='http://u2019.meteoinfo.ru/services/monitoring_test.php'>Гидрометцентр России</a>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        echo "<div class='col-6 d-flex justify-content-end'>";
            echo "<div class='info'>";
                echo "<div onClick='infoFunc();'>".$dictionary[$lang][0]."</div>";
            echo "</div>";
            echo "<div class='feedback'>";
                echo "<a href='https://docs.google.com/forms/d/e/1FAIpQLSf6DfYoNiEdB022UzWBNrNbaQ97IbzQaROFSCA7_ANJ3ThjVQ/viewform' target='_blank'>".$dictionary[$lang][1]."</a>";
            echo "</div>";
            echo "<div class='lang'>";
                echo "<div class='btn-group btn-group-toggle' data-toggle='buttons'>";
                    echo "<label class='btn btn-primary";
                    if($lang == 'ru') {
                        echo " active";
                    }
                    echo "'>";
                        echo "<input type='radio' name='options' id='ru_lang' autocomplete='off' value='ru' onChange='getPage();'> RU";
                    echo "</label>";
                    echo "<label class='btn btn-primary";
                    if($lang == 'en') {
                        echo " active";
                    }
                    echo "'>";
                        echo "<input type='radio' name='options' id='en_lang' autocomplete='off' value='en' onChange='getPage();'> EN";
                    echo "</label>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</header>";

    echo "<div class='row head_title'>";
        echo "<div class='col-12'>";
            echo "<h1>".$dictionary[$lang][2]."</h1>";
            echo "<p>".$dictionary[$lang][19]."</p>";
        echo "</div>";
    echo "</div>";

    echo "<div class='row params-wrapper'>";
        echo "<div class='col-12'>";
            echo "<div class='row'>";
                echo "<div class='params_head col-12 d-flex justify-content-center'>";
                    echo "<h2>Параметры</h2>";
                echo "</div>";
                echo "<div class='params col-12 d-flex justify-content-center'>";
                    echo "<div class='date-wrapper col-xl-3 col-lg-6 col-12'>";
                        echo "<div class='text-lg-center'>".$dictionary[$lang][3]."</span></div>";
                        echo "<div class='date-input d-lg-flex justify-content-center'>";

                            $t_1 = date("H");
                            if($t_1 > 4) {
                                if($t_1 >= 22) { $t_1 = "18"; $t_2 = "00"; }
                                else if ($t_1 >= 16 && $t_1 < 22) { $t_1 = "12"; $t_2 = "18"; }
                                else if ($t_1 >= 10 && $t_1 < 16) { $t_1 = "06"; $t_2 = "12"; }
                                else if ($t_1 >= 4 && $t_1 < 10) { $t_1 = "00"; $t_2 = "06"; }
                                $d_1 = date("Ymd");
                                $d_2 = date('Ymd', mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
                            }
                            else {
                                $t_1 = "18"; $t_2 = "00";
                                $d_1 = date('Ymd', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
                                $d_2 = date('Ymd', mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
                            }
                            $date_1 = $d_1.$t_1;
                            $date_2 = $d_2.$t_2;
                            $date_1 = formDateWithSeparator($date_1);
                            $date_2 = formDateWithSeparator($date_2);

                            function formDateWithSeparator ($date) {
                                return substr($date, 0, 4)."-".substr($date, 4, 2). "-".substr($date, 6, 2)."-".substr($date, 8);
                            }

                            echo "<span>".$dictionary[$lang][4]." </span><input id='input_t_2' type='text' value='".$date_2."' placeholder='yyyy-mm-dd-hh'>";
                            echo "<span>".$dictionary[$lang][5]." </span><input id='input_t_1' type='text' value='".$date_1."' placeholder='yyyy-mm-dd-hh'>";
                        echo "</div>";
                    echo "</div>";


                    echo "<div class='model-wrapper col-xl-7 col-lg-6 col-12'>";
                        echo "<div class='text-lg-center'>".$dictionary[$lang][7]."</div>";
                        echo "<div class='model-list d-lg-flex justify-content-center'>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='13ena' value='13ENA' checked='checked'>13ENA</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='7etr' value='7ETR' checked='checked'>7ETR</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='2cfo' value='2CFO' checked='checked'>2CFO</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='2sfo' value='2SFO' checked='checked'>2SFO</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='2vfo' value='2VFO' checked='checked'>2VFO</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='1sochi' value='1Sochi' checked='checked'>1Sochi</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='6ena' value='6ena' checked='checked'>6ena</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='2etr' value='2etr' checked='checked'>2etr</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='2krs' value='2krs' checked='checked'>2krs</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='1msk' value='1msk' checked='checked'>1msk</label>";
                            echo "<label><input class='checkbox-list' type='checkbox' name='model' id='1krs' value='1krs' checked='checked'>1krs</label>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='date-switch-wrapper d-flex align-items-center col-xl-2 col-lg-12 col-12'>";
                        echo "<label><input class='date-switch' type='checkbox' name='date-switch' id='date-switch'>".$dictionary[$lang][8]."</label>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='col-12 d-flex justify-content-center button-wrapper'>";
                    echo "<button id='selectParams' class='bnt btn-primary btn-sm' onClick=getMainTable('".$lang."');>".$dictionary[$lang][6]."</button>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";

    echo "<div class='col-xl-12'>";
        echo "<div class='d-flex justify-content-center'>";
            echo "<div id='details-spinner' class='spinner-grow text-primary' role='status'>";
                echo "<span class='sr-only'>Loading...</span>";
            echo "</div>";
        echo "</div>";
        echo "<div id='details-wrapper'></div>";
    echo "</div>";
    echo "<div class='col-xl-12'>";
        echo "<div class='d-flex justify-content-center'>";
            echo "<div id='spinner' class='spinner-grow text-primary' role='status'>";
                echo "<span class='sr-only'>Loading...</span>";
            echo "</div>";
        echo "</div>";
        echo "<div id='main-table'></div>";
    echo "</div>";
?>
