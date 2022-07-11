<!DOCTYPE HTML>
<?php
    include('controller/main.php');
    $main = new main\MainController();
    $main->get_xml();
?>
<html>
    <head>
        <script src="static/js/jquery.min.js"></script>
        <link rel="stylesheet" href="static/css/bootstrap.min.css" >
        <script src="static/js/bootstrap.min.js"></script>

        <script>
            var file = 'books.json';
            $(document).ready(function () {
                insert_data();
                download_file();
            });

            function insert_data() {
                $.get(file, function(data) {
                    $.each(data, function (i, item) {
                        $('#tbody').append('<tr>' + '<td>' + item.ident + '</td>' + '<td>' + item.tytul + '</td>' + '<td>' + item.liczba_stron + '</td>' + '<td>' + item.data_wydania + '</td>' + '</tr>')
                    });
                });
            }

            function download_file() {
                $("#download").click(function (e) {
                    e.preventDefault();
                    window.location.href = file;
                });
            }

        </script>
    </head>
    <body>
        <a id="download" href="#">
            Download this file
        </a>
        <table class="table table-striped" id="sortTable">
            <thead>
            <tr>
                <th>Ident</th>
                <th>Tytuł</th>
                <th>Liczba stron</th>
                <th>Data wydania</th>
            </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </body>
</html>


