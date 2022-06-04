<?php
    $alert=isset($_GET["alert"])?$_GET["alert"]:false;
    
     $employee_now = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.user_id = '$user_id' AND DATE(employee_activity.date) = DATE(NOW()) ");

    if(isset($_POST["filter"])){
        if(!empty($_POST["date"])){ 
            $date = $_POST["date"];
            $employee = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id WHERE employee_activity.user_id = '$user_id' AND employee_activity.date='$date'");
        }elseif(!empty($_POST["month"])){
            $month = $_POST["month"];
            $employee = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id WHERE employee_activity.user_id = '$user_id' AND DATE_FORMAT(employee_activity.date,'%Y-%m') = '$month'");
        }
    }else{
        $employee = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id WHERE employee_activity.user_id = '$user_id' ORDER BY employee_activity.date DESC");
    }
     ?>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mt-5">Smart Dashboard of Employees in Information Systems Department (SmartBe)<br>
BINUS Online Learning</h3>
                <!-- <div class="alert alert-primary" role="alert"> -->
            <h3 class="text-center text-primary mb-3">Selamat Datang <?=$nama_lengkap?></h3>
                <!-- </div> -->
        </div>
    </div>
                <div class="row">
                        <div class="col-4">
                                    <?php  if($alert == 'error'):?>
                                        <div class="alert alert-danger" role="alert">
                                            Upload gambar terlebih dahulu
                                        </div>
                                    <?php  elseif($alert == 'size'):?>
                                        <div class="alert alert-danger" role="alert">
                                        Ukuran gambar terlalu besar
                                        </div>
                                    <?php  elseif($alert == 'edit'):?>
                                        <div class="alert alert-success" role="alert">
                                        Data berhasil diubah
                                        </div>
                                    <?php elseif($alert == "ekstensi"):?>
                                        <div class="alert alert-danger" role="alert">
                                        Yang anda upload bukan gambar
                                        </div>
                                    <?php elseif($alert == "success"):?>
                                        <div class="alert alert-success" role="alert">
                                        Data telah disimpan
                                        </div>
                                    <?php elseif($alert == "role_id"):?>
                                        <div class="alert alert-danger" role="alert">
                                        Pilih role terlebih dahulu
                                        </div>
                                    <?php elseif($alert == "hapus"): ?>
                                        <div class="alert alert-danger" role="alert">
                                        Data berhasil dihapus
                                        </div>
                                    <?php endif;?>
                        </div>
                </div>
    
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Your Activity Today</h5>
                </div>
                <div class="card-body">
                    <table id="table_id" class="table table-striped table-bordered data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Activity</th>
                                <th class="text-center">Waktu</th>
                                <th>Place</th>
                                <th>By</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $no=1; ?>
                    <?php foreach($employee_now as $ea): ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$ea['activity'];?></td>
                                <td class="text-center"><?=$ea['waktu_mulai'];?> - <?=$ea['waktu_selesai'];?></td>
                                <td><?=$ea['place']?></td>
                                <td><?=$ea['invited_by']?></td>
                                <td class="text-center">
                                <?php if( empty($ea["status"]) || empty($ea["place"]) || empty($ea["dari_tanggal"]) || empty($ea["sampai_tanggal"]) || empty($ea["documentation"]) || empty($ea["note"])):?>
                                    <button id="myButton" class="btn btn-info btn-sm text-white rounded-circle"><i class="fas fa-info-circle"></i></button>
                                <?php endif; ?>
                                    <a href="index.php?page=detail&employee_activity_id=<?=$ea['employee_activity_id']?>" class="btn btn-primary btn-sm">View</a>
                                    <a href="index.php?page=employee-activity&action=edit&employee_activity_id=<?=$ea['employee_activity_id']?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="index.php?page=employee-activity&action=hapus&employee_activity_id=<?=$ea['employee_activity_id']?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                    <?php $no++; ?>
                    <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
            <?php if(!$employee_now):?>
                <div class="row justify-content-end my-3">
                    <div class="col-5">
                        <div class="alert alert-success" role="alert">
                        Welcome to e-SmartBe, Silahkan isi aktivitas anda hari ini.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    
    <div class="row justify-content-end my-3">
        <div class="col-6">
            <div class="row justify-content-end">
                    <form action="" method="POST">
                        <div class="d-flex justify-content-end">
                            <div class="form-group mx-1">
                                <input type="month" class="form-control" id="month" name="month">
                            </div>
                            <div class="form-group mx-1">
                                <input type="date" class="form-control" id="date" name="date"> 
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
                    <h5 class="m-0">Your All Activity</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Activity</th>
                                <th class="text-center">Day And Date</th>
                                <th class="text-center">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $no=1; ?>
                    <?php foreach($employee as $e): ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$e['activity'];?></td>
                                <td class="text-center">
                                    <?php $e["date"] = strftime('%A, %d %B %Y',strtotime($e["date"]));?>
                                    <?=$e['date']?>
                                </td>
                                <td class="text-center"><?=$e['waktu_mulai'];?> - <?=$e['waktu_selesai'];?></td>
                            </tr>
                    <?php $no++; ?>
                    <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
           
</div>