<?php 
    $alert=isset($_GET["alert"])?$_GET["alert"]:false;
    if(isset($_POST["simpan"])){
        if(tambah($_POST) > 0){
            $alert = $_GET["alert"] = "success";
                echo "<script>
                         document.location.href='index.php?page=dashboard&alert=$alert';
                    </script>";
        }else{
            $alert = $_GET["alert"] = "error";
            echo "<script>
                    document.location.href='index.php?page=dashboard&alert=$alert';
            </script>";
            
        }
    } 

    if($action == "hapus"){
        if(hapus($employee_activity_id,$page) > 0){
            $alert = $_GET["alert"] = 'hapus';
            echo "<script>
                    document.location.href='index.php?page=dashboard&alert=$alert';
            </script>";
        }
    }elseif($action == 'edit'){
        if(isset($_POST["edit"])){
            if(edit($_POST) > 0){
                $alert = $_GET["alert"] = "edit";
                echo "<script>
                    document.location.href='index.php?page=dashboard&alert=$alert';
                 </script>";
            }else{
                $alert = $_GET["alert"];
                echo "<script>
                    document.location.href='index.php?page=dashboard&alert=$alert';
                </script>";
            }
        }
    }

    $employee = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id WHERE employee_activity.user_id = '$user_id'");
    
    $role = data("SELECT * FROM role INNER JOIN role_user ON role_user.role_id = role.role_id WHERE role_user.user_id = '$user_id'");
 
    // var_dump($role);die;
?>
<?php  if($action == 'edit'):?>
<?php $edit = data("SELECT * FROM employee_activity WHERE employee_activity_id='$employee_activity_id'");?>

<?php $role = data("SELECT * FROM role INNER JOIN employee_activity ON employee_activity.role_id = role.role_id WHERE employee_activity.user_id='$user_id' AND employee_activity_id='$employee_activity_id'") ;?>
<?php $roles = data("SELECT * FROM role INNER JOIN role_user ON role.role_id=role_user.role_id WHERE role_user.user_id = '$user_id' "); ?>
<div class="container-fluid px-4">
        <h1 class="mt-4">Edit Employee Activity</h1>
           <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <?php if($alert == 'size'):?>
                                    <div class="alert alert-danger" role="alert">
                                       Ukuran gambar terlalu besar
                                    </div>
                                <?php elseif($alert == "ekstensi"):?>
                                    <div class="alert alert-danger" role="alert">
                                       Yang anda upload bukan gambar
                                    </div>
                                <?php elseif($alert == "edit"):?>
                                    <div class="alert alert-success" role="alert">
                                       Data berhasil diubah
                                    </div>
                                <?php elseif($alert == "hapus"): ?>
                                    <div class="alert alert-danger" role="alert">
                                      Data berhasil dihapus
                                    </div>
                                <?php endif;?>
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data" >
                                            <input type="hidden" name="user_id" value="<?=$user_id?>">
                                            <input type="hidden" name="page" value="<?=$page?>">
                                            <input type="hidden" name="employee_activity_id" value="<?=$employee_activity_id?>">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <?php foreach($role as $r): ?>
                                                        <small class="text-danger">Previous <span class="text-uppercase"><?= $r["role"]?></span></small>
                                                    <?php endforeach;?>
                                                <div class="form-floating">
                                                    <select name="role_id" class="form-select text-uppercase" id="floatingSelect" aria-label="Floating label select example">
                                                        <option disabled>Select Role</option>
                                                        <?php foreach($roles as $r):?>
                                                            <option class="text-uppercase" value="<?=$r['role_id']?>"><?=$r['role']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label for="floatingSelect">Choose Role</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php foreach($edit as $e): ?>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="activity" type="text" placeholder="activity" name="activity" value="<?=$e["activity"]?>" required/>
                                                        <label for="inputFirstName">Activity</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="tanggal" type="date" placeholder="Enter your date" name="tanggal" value="<?=$e["date"]?>" required/>
                                                        <label for="inputLastName">Day and Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="time1" type="time" placeholder="Time" name="waktu_mulai" value="<?=$e["waktu_mulai"]?>" required/>
                                                        <label for="time1">Waktu Mulai</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="time1" type="time" placeholder="Time" name="waktu_selesai" value="<?=$e["waktu_selesai"]?>" required/>
                                                        <label for="time2">Waktu Selesai</label>
                                                    </div>
                                                </div>
                                            </div>
                                         
                                            <div class="row mb-3">
                                               <div class="col-md-6">
                                               <div class="form-floating">
                                                        <input class="form-control" id="related_with" type="text" placeholder="Related With" name="related_with" value="<?=$e["related_with"]?>" required/>
                                                        <label for="inputLastName">Related With</label>
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="invby" type="text" placeholder="Invited By" name="invby" value="<?=$e["invited_by"]?>" required/>
                                                        <label for="inputLastName">Invited By</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                               <div class="col-md-6">
                                               <div class="form-floating">
                                                        <input class="form-control" id="status" type="text" placeholder="status" name="status" value="<?=$e['status']?>"/>
                                                        <label for="inputLastName">Status</label>
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="place" type="text" placeholder="Place" name="place" value="<?=$e['place']?>"/>
                                                        <label for="inputLastName">Place</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                            <small class="text-center my-2">Berkelanjutan</small>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="dari" type="date" placeholder="Dari" name="dari_tanggal" value="<?=$e["dari_tanggal"]?>"/>
                                                        <label for="inputLastName">Dari Tanggal</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="sampai" type="date" placeholder="sampai" name="sampai_tanggal" value="<?=$e["sampai_tanggal"]?>"/>
                                                        <label for="inputLastName">Sampai Tanggal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                             <small class="text-primary mb-2"> Format file pdf/jpeg/png</small>
                                                <div class="col-md-12">
                                                    <div>
                                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="documentation">
                                                        <small><?=$e["documentation"]?></small>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <textarea name="note" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?=$e["note"]?></textarea>
                                                        <label for="floatingTextarea2">Note</label>
                                                    </div>
                                                </div>
                                            </div>        
                                            <?php endforeach ?>                                
                                            <div class="mt-4 mb-0">
                                               <button type="submit" class="btn btn-primary" name="edit">Edit Activity</button>
                                            </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
<?php else: ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Employee Activity</h1>
           <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <?php  if($alert == 'error'):?>
                                    <div class="alert alert-danger" role="alert">
                                        Upload gambar terlebih dahulu
                                    </div>
                                <?php  elseif($alert == 'size'):?>
                                    <div class="alert alert-danger" role="alert">
                                       Ukuran gambar terlalu besar
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
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data" >
                                            <input type="hidden" name="user_id" value="<?=$user_id?>">
                                            <input type="hidden" name="page" value="<?=$page?>">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                <div class="form-floating">
                                                    <select name="role_id" class="form-select text-uppercase" id="floatingSelect" aria-label="Floating label select example">
                                                        <option selected disabled>Select Role</option>
                                                        <?php foreach($role as $r): ?>
                                                          <option class="text-uppercase" value="<?=$r['role_id']?>"><?=$r['role']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <label for="floatingSelect">Choose Role</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="activity" type="text" placeholder="activity" name="activity" required/>
                                                        <label for="inputFirstName">Activity</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="tanggal" type="date" placeholder="Enter your date" name="tanggal" required/>
                                                        <label for="inputLastName">Day and Date</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="time1" type="time" placeholder="Time" name="waktu_mulai" required/>
                                                        <label for="time1">Waktu Mulai</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="time1" type="time" placeholder="Time" name="waktu_selesai" required/>
                                                        <label for="time2">Waktu Selesai</label>
                                                    </div>
                                                </div>
                                            </div>
                                         
                                            <div class="row mb-3">
                                               <div class="col-md-6">
                                               <div class="form-floating">
                                                        <input class="form-control" id="related_with" type="text" placeholder="related_with" name="related_with" required/>
                                                        <label for="inputLastName">Related With</label>
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="invby" type="text" placeholder="Invited By" name="invby" required/>
                                                        <label for="inputLastName">Invited By</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                               <div class="col-md-6">
                                               <div class="form-floating">
                                                        <input class="form-control" id="status" type="text" placeholder="status" name="status"/>
                                                        <label for="inputLastName">Status</label>

                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="place" type="text" placeholder="Place" name="place"/>
                                                        <label for="inputLastName">Place</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                            <small class="text-center my-2">Berkelanjutan</small>
                                               <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="dari" type="date" placeholder="Dari" name="dari_tanggal"/>
                                                        <label for="inputLastName">Dari Tanggal</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="sampai" type="date" placeholder="sampai" name="sampai_tanggal"/>
                                                        <label for="inputLastName">Sampai Tanggal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                    <small class="text-primary mb-2"> Format file pdf/jpeg/png</small>
                                                <div class="col-md-12">
                                                    <div>
                                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="documentation">
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-floating">
                                                        <textarea name="note" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                        <label for="floatingTextarea2">Note</label>
                                                    </div>
                                                </div>
                                            </div>                                        
                                            <div class="mt-4 mb-0">
                                               <button type="submit" class="btn btn-primary" name="simpan">Create Activity</button>
                                            </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
<?php endif; ?>
                 <br>
                        
                        <!-- <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                See Data
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Role</th>
                                            <th>Activity</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Related With</th>
                                            <th>Invited By</th>
                                            <th>Status</th>
                                            <th>Berkelanjutan</th>
                                            <!-- <th>Note</th> -->
                                            <!-- <th class="text-center">Documentation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1;?>
                                    <?php foreach($employee as $e):?>
                                        <tr>
                                            <td><?=$no;?></td>
                                            <td class="text-uppercase"><?=$e["role"]?></td>
                                            <td><?=$e["activity"]?></td>
                                            <td>
                                                <?php $e["date"] = strftime('%A, %d %B %Y',strtotime($e["date"]));?>
                                                <?=$e["date"];?>
                                            </td>
                                            <td><?=$e["waktu_mulai"]?> - <?=$e["waktu_selesai"]?></td>
                                            <td><?=$e["related_with"]?></td>
                                            <td><?=$e["invited_by"]?></td>
                                            <td>
                                                <?php if(!$e["status"]): ?>
                                                    <small>Tidak ada status</small>
                                                <?php else: ?>
                                                    <?= $e["status"]?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(!$e["dari_tanggal"] || !$e["sampai_tanggal"]): ?>
                                                    <small>Tidak berkelanjutan</small>
                                                <?php else: ?>
                                                    <?=$e["dari_tanggal"]?> sd <?=$e["sampai_tanggal"]?>
                                                <?php endif; ?>
                                            </td>
                                            <!-- <td>
                                                <?php if(!$e["note"]): ?>
                                                    <small>Tidak ada note</small>
                                                <?php else:?>
                                                    <?=$e["note"]?>
                                                <?php endif; ?>
                                            </td> -->
                                            <!-- <td class="text-center">
                                                <?php if(!$e['documentation']):?>
                                                <small>Tidak ada gambar</small>
                                                <?php else: ?>
                                                <img src="assets/upload/<?=$e['documentation']?>" alt="#" style="width:50px; height:50px;">
                                                <?php endif;?>   
                                            </td>
                                            <td>
                                                <a href="index.php?page=employee-activity&action=edit&employee_activity_id=<?=$e['employee_activity_id']?>" class="btn btn-success">Edit</a>
                                                <a href="index.php?page=employee-activity&action=hapus&employee_activity_id=<?=$e['employee_activity_id']?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php $no++; ?>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                    <!-- </div> --> 