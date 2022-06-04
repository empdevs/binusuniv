<?php 
date_default_timezone_set('Asia/Jakarta');//set lokasi indonesia
    if(isset($_POST["filter"])){
        if(!empty($_POST["role_id"]) && !empty($_POST["user_id"]) && !empty($_POST["month"])){
            $user_id=$_POST["user_id"];
            $role_id=$_POST["role_id"];
            $month = $_POST["month"];

            $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id' AND employee_activity.role_id = '$role_id' AND DATE_FORMAT(employee_activity.date,'%Y-%m') = '$month'");//ambil data aktvitas karyawan
            
            
            $query="SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id' AND employee_activity.role_id = '$role_id' AND DATE_FORMAT(employee_activity.date,'%Y-%m') = '$month'";//kirim get ke laporan

            if(!empty($employee_activity)){
                foreach($employee_activity as $e){
                    $username = $e["username"];
                    $role = strtoupper($e["role"]);
                    $month = strftime('%B %Y',strtotime(date($e['date'])));//set time stamp
                }
                $employee_name="Karyawan $username, role $role - periode bulan $month";
            }else{
                $employee_name="";
            }
            
        }elseif(!empty($_POST["role_id"]) && !empty($_POST["user_id"])){

            $user_id=$_POST["user_id"];
            $role_id=$_POST["role_id"];

            $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id' AND employee_activity.role_id = '$role_id'");//ambil data aktvitas karyawan
            if(!empty($employee_activity)){
                foreach($employee_activity as $e){
                    $username = $e["username"];
                    $role = strtoupper($e["role"]);
                }
                $employee_name="Karyawan $username, role $role - all periode";
            }else{
                $employee_name="";
            }

            $query="SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id' AND employee_activity.role_id = '$role_id'";

        }elseif(!empty($_POST["user_id"]) && !empty($_POST["month"])){
            $user_id=$_POST["user_id"];
            $month = $_POST["month"];

            $employee_activity=data("SELECT * FROM employee_activity INNER JOIN user on employee_activity.user_id = user.user_id INNER JOIN role ON employee_activity.role_id = role.role_id WHERE employee_activity.user_id = '$user_id' AND DATE_FORMAT(employee_activity.date,'%Y-%m') = '$month'");//ambil data aktvitas karyawan

            
            $query = "SELECT * FROM employee_activity INNER JOIN user on employee_activity.user_id = user.user_id INNER JOIN role ON employee_activity.role_id = role.role_id WHERE employee_activity.user_id = '$user_id' AND DATE_FORMAT(employee_activity.date,'%Y-%m') = '$month'";

            if(!empty($employee_activity)){
                foreach($employee_activity as $e){
                    $username = $e["username"];
                    $month = strftime('%B %Y',strtotime(date($e['date'])));//set time stamp
                }
                $employee_name="Karyawan $username - periode bulan $month";
            }else{
                $employee_name="";
            }

        }elseif(!empty($_POST["user_id"])){

            $user_id=$_POST["user_id"];

            $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id'");

            if(!empty($employee_activity)){
                foreach($employee_activity as $e){
                    $employee_name="Karyawan"." ".$e["username"]." - "."All Periode";
                }
            }else{
                $employee_name="";
            }

            $query="SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user on employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id'";
        }else{
            $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id");
        
            $query="SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id";
    
            $employee_name = "Semua Karyawan - All Periode";
        }
    }else{
        $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id");
        
        $query="SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id";

        $employee_name = "Semua Karyawan - All Periode";
    }
    
    //info admin
    $employee_count = data("SELECT COUNT(user_id)
    FROM user");

    $employee_activity_this_day= data("SELECT COUNT(employee_activity_id) FROM employee_activity WHERE DATE(employee_activity.date) = DATE(NOW()) ");
    // var_dump($employee_activity_this_day);die;

    $employee_activity_this_month= data("SELECT COUNT(employee_activity_id) FROM employee_activity WHERE  DATE_FORMAT(employee_activity.date,'%m')= MONTH(NOW())");
    // var_dump($employee_activity_last_month);die;

    $employee_activity_this_year= data("SELECT COUNT(employee_activity_id) FROM employee_activity WHERE  DATE_FORMAT(employee_activity.date,'%Y-%m-%d') = YEAR(NOW())");
    // end info admin
    
    // end grafik
    
    // aktivitas
    $username =data("SELECT * FROM user"); 
    $role =data("SELECT * FROM role"); 
    // end aktifitas
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
<h3 class="text-center my-5">Smart Dashboard of Employees in Information Systems Department (SmartBe)<br>
BINUS Online Learning
</h3>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-header">
                <h4 class="text-white card-title m-0 fw-normal">Employee</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users text-white" style="width: 35px; height:35px;"></i>
                    <h4 class="mx-2 m-0 text-white">
                    <?php foreach($employee_count as $ec): ?>
                        <?=$ec["COUNT(user_id)"] - 1?>    
                    <?php endforeach;?>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-header">
                <h4 class="text-white card-title m-0 fw-normal">Today</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                <i class="fas fa-calendar-day text-white" style="width: 35px; height:35px;"></i>
                    <h4 class="mx-2 m-0 text-white">
                    <?php foreach($employee_activity_this_day as $ed): ?> 
                        <?=$ed["COUNT(employee_activity_id)"]?>
                    <?php endforeach; ?> Activity</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-header">
                <h4 class="text-white card-title m-0 fw-normal">This Month</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                <i class="fas fa-calendar-alt text-white" style="width: 35px; height:35px;"></i>
                    <h4 class="mx-2 m-0 text-white">
                    <?php foreach($employee_activity_this_month as $et): ?> 
                        <?=$et["COUNT(employee_activity_id)"]?>
                    <?php endforeach; ?> Activity</h4>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger">
                <div class="card-header">
                <h4 class="text-white card-title m-0 fw-normal">Year</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                <i class="fas fa-calendar-plus text-white" style="width: 35px; height:35px;"></i>
                    <h4 class="mx-2 m-0 text-white">
                    <?php foreach($employee_activity_this_year as $ey):?>
                        <?=$ey["COUNT(employee_activity_id)"]?>
                    <?php endforeach;?>Activity</h4>
                </div>
            </div>
        </div>
    </div>

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

    <div class="row my-3">
            <div class="col-md-4">
                <a href="laporanpdf.php?query=<?=$query?>&name_employee=<?=$employee_name?>" target="_blank" class="btn btn-success"><i class="fas fa-download"></i> Download PDF</a>
            </div>
            <div class="col-md-8">
                <div class="row justify-content-end">
                        <form action="" method="POST">
                            <div class="d-flex justify-content-end">
                                <div class="form-group mx-1">
                                    <select class="form-select" name="user_id" id="user_id">
                                    <option value="#" selected disabled>Choose Employee</option>
                                    <?php foreach($username as $user):?>
                                        <option value="<?=$user['user_id']?>"<?php if($user['user_id'] == '1'){echo "disabled";} ?> ><?=$user['username']?></option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group mx-1">
                                    <select class="form-select" name="role_id" id="role_id">
                                        <option value="#" selected disabled>Choose Role</option>
                                        <?php foreach($role as $r):?>
                                            <option class="text-uppercase" value="<?=$r['role_id']?>" <?php if($r['role_id'] == '1'){echo "disabled";} ?> ><?=$r['role']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mx-1">
                                    <input type="month" class="form-control" id="month" name="month">
                                </div>
                                <div class="form-group mx-1">
                                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-12">
        <div class="card">
                <div class="card-header">
                All Employee Activities
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Employee</th>
                                <th>Role</th>
                                <th>Activity</th>
                                <th>Day and Date</th>
                                <th>Related To</th>
                                <th>Invited By</th>
                                <th>Documentation</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>

                        <?php foreach($employee_activity as $ea): ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$ea['nama_lengkap']?></td>
                                <td class="text-uppercase"><?=$ea['role']?></td>
                                <td><?=$ea['activity']?></td>
                                <td>
                                    <?php $ea["date"] = strftime('%A, %d %B %Y',strtotime($ea["date"]));?>
                                    <?=$ea['date']?>
                                </td>
                                <td><?=$ea['related_with']?></td>
                                <td><?=$ea['invited_by']?></td>
                                <td class="text-center">
                                   <?php if(!$ea['documentation']):?>
                                        Tidak ada Gambar
                                   <?php else: ?>
                                       <img src="../../../binusuniv/employee/assets/upload/<?=$ea['documentation']?>" alt="" style="width: 50px; height:50px;">
                                   <?php endif; ?>
                                </td>
                                <td><?=$ea['note']?></td>
                            </tr>
                        <?php $no++; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    </div>
</div>