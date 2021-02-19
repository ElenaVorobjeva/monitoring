<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/index.css">
        <title>Мониторинг прогнозов COSMO-Ru</title>
    </head>
    <body>
        <div class="container-fluid" id="main"></div>

        <div class="info_block" id="info_block">
            <div class="wrapper" id="wrapper" onClick="infoCloseFunc()"></div>
            <div class="block container">
                <div class="header d-flex justify-content-center">
                    <h1>Информация о работе интерфейса</h1>
                </div>
                <div class="content">
                    <p>Данный интерфейс разработан для проверки наличия визуализированный прогнозов погоды на ftp-сервере 10.1.112.224. Во время работы интерфейс проверяет наличие файлов по определенным конфигурациям модели COSMO-Ru за определенный промежуток времени. Для сокращения времени работы интерфейса проверка ведется не по всем доменам, а по одному, который включает в себя большую часть рассчитанной информации (самые большие домены для данной конфигурации). В таблице ниже представлены эти домены.</p>
                    <table class="table table-bordered table-hover table-sm domen">
                        <thead>
                            <tr>
                                <th>Конфигурация</th>
                                <th>Домен</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>13ENA</td><td>FM-SNG</td></tr>
                            <tr><td>7ETR</td><td>FM-CFO</td></tr>
                            <tr><td>2CFO</td><td>FM-CFO</td></tr>
                            <tr><td>2SFO</td><td>FM-BSC</td></tr>
                            <tr><td>2VFO</td><td>FM-VolFO</td></tr>
                            <tr><td>1Sochi</td><td>FM-SochiTu</td></tr>
                            <tr><td>6ena</td><td>fm_Rusia</td></tr>
                            <tr><td>2etr</td><td>fm_Belarus</td></tr>
                            <tr><td>2krs</td><td>fm_Krasn</td></tr>
                            <tr><td>1msk</td><td>fm_MosReg</td></tr>
                            <tr><td>1krs</td><td>fm_Krasn</td></tr>
                        </tbody>
                    </table>
                    <p>Данные о наличии прогнозов сводятся в таблицу, где по горизонтали располагаются конфигурации модели, а по вертикали время прогноза. Цвет ячейки определяет полноту наличия прогнозов (обозначения цветов представлены в таблице ниже).</p>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Ячейка</th>
                                <th>Значение ячейки</th>
                                <th>Примечание</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class='success'></div></td>
                                <td>Данные в полном объёме</td>
                                <td>Файлы по всем заблаговременностям для одного выбранного домена расположены на сервере.</td>
                            </tr>
                            <tr>
                                <td><div class='warning'></div></td>
                                <td>Данные получены не полностью</td>
                                <td>
                                    Найдены не все заблаговременности для одного выбранного домена. Это может обозначать, что:
                                    <ol>
                                        <li>Для данного домена посчитаны не все заблаговременности (информацию об этом можно увидеть при нажатии на соответсвующую ячейку таблицы).</li>
                                        <li>Не найдено ни одной заблаговременности для домена, но папка, в которой должны хранится все прогнозы за выбранный срок, существует на сервере, она может быть пустой или в ней могут находится какие-то файлы (например, метеограммы).</li>
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td><div class='fail'></div></td>
                                <td>Данные отсутствуют</td>
                                <td>Отсутсвует папка, в которой должны хранится искомые прогнозы.</td>
                            </tr>
                            <tr>
                                <td><div class='size'></div></td>
                                <td>Размер файла меньше 30К</td>
                                <td>Все файлы найдены, но среди них есть файлы с маленьким объемом. Это может обозначать, что внутри файлов хранится только шаблон домена без прогнозов.</td>
                            </tr>
                            <tr>
                                <td><div class='success d-flex justify-content-center'>2019-10-21 10:05</div></td>
                                <td>Дата и время получения данных</td>
                                <td>Данная дата и время показывают, когда файл с последней заблаговременностью был выложен на ftp-сервер.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/details.js"></script>
    </body>
</html>
