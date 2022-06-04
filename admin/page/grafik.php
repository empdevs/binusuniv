<?php 
     $dina_id = 2;
     $titan_id = 3;
     $gg_id = 4;
     $suci_id = 5;
     $sandy_id = 6;
     // grafik month now
 
     $dina = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$dina_id' AND DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW()) ");
 
     $titan = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$titan_id' AND DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW()) ");
 
     $gg = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$gg_id' AND DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW()) ");
 
     $suci = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$suci_id' AND DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW()) ");
 
     $sandy = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$sandy_id' AND DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW()) ");
     // end grafik
 
     // grafik today
     $dina_today = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$dina_id' AND DATE(employee_activity.date) = DATE(NOW()) ");
     $titan_today = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$titan_id' AND DATE(employee_activity.date) = DATE(NOW()) ");
     $gg_today = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$gg_id' AND DATE(employee_activity.date) = DATE(NOW()) ");
     $suci_today = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$suci_id' AND DATE(employee_activity.date) = DATE(NOW()) ");
     $sandy_today = data("SELECT COUNT(employee_activity_id) FROM employee_activity INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$sandy_id' AND DATE(employee_activity.date) = DATE(NOW()) ");
     
     // end today
?>
<h3 class="text-center my-5">Grafik Aktivitas Karyawan</h3>
<div class="container">
<div class="row">
            <div class="col-md-6">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Element", "Aktivitas", { role: "style" } ],
                            ["Dina",
                                <?php foreach($dina_today as $dt): ?>
                                    <?= $dt["COUNT(employee_activity_id)"]; ?>
                                <?php endforeach;?>
                            , "#77ff73"],
                            ["Titan",
                                <?php foreach($titan_today as $tt): ?>
                                    <?= $tt["COUNT(employee_activity_id)"];?>
                                <?php endforeach;?>
                            , "#73b4ff"],
                            ["GG", 
                                <?php foreach($gg_today as $gt): ?>
                                    <?=$gt["COUNT(employee_activity_id)"];?>
                                <?php endforeach;?>
                            , "#fff673"],
                            ["Succiana",
                                <?php foreach($suci_today as $st): ?>
                                    <?=$st["COUNT(employee_activity_id)"];?>
                                <?php endforeach;?>
                            , "#ffad73"],
                            ["Teguh",
                                <?php foreach($sandy_today as $sy): ?>
                                    <?=$sy["COUNT(employee_activity_id)"];?>
                                <?php endforeach;?>
                            , "#b8b8b8"]
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                                        { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                        2]);

                        var options = {
                            title: "Aktivitas Karyawan Hari Ini",
                            width: 500,
                            height: 500,
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                    }
                </script>
                    <div id="columnchart_values" style="width: 500px; height: 500px; margin:auto;"></div>
            </div>
        <div class="col-md-6">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {packages:['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ["Element", "Aktivitas", { role: "style" } ],
                        ["Dina",
                            <?php foreach($dina as $d): ?>
                                <?=$d["COUNT(employee_activity_id)"];?>
                            <?php endforeach;?>
                        , "#77ff73"],
                        ["Titan",
                            <?php foreach($titan as $t): ?>
                                <?=$t["COUNT(employee_activity_id)"];?>
                            <?php endforeach;?>
                        , "#73b4ff"],
                        ["GG", 
                            <?php foreach($gg as $g): ?>
                                <?=$g["COUNT(employee_activity_id)"];?>
                            <?php endforeach;?>
                        , "#fff673"],
                        ["Succiana",
                            <?php foreach($suci as $sc): ?>
                                <?=$sc["COUNT(employee_activity_id)"];?>
                            <?php endforeach;?>
                        , "#ffad73"],
                        ["Teguh",
                            <?php foreach($sandy as $sy): ?>
                                <?=$sy["COUNT(employee_activity_id)"];?>
                            <?php endforeach;?>
                        , "#b8b8b8"]
                    ]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                                    { calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation" },
                                    2]);

                    var options = {
                        title: "Aktivitas Karyawan Bulan Ini",
                        width: 500,
                        height: 500,
                        bar: {groupWidth: "95%"},
                        legend: { position: "none" },
                    };
                    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values_day"));
                    chart.draw(view, options);
                }
                </script>
                <div id="columnchart_values_day" style="width: 500px; height: 500px; margin:auto;"></div>
        </div>
    </div>
</div>