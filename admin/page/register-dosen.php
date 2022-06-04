<?php $alert = isset($_GET["alert"])?$_GET["alert"] : false; ?>
                  <?php
                  if(isset($_POST["simpan"])){
                      if(tambah($_POST) > 0){
                          $alert = $_GET["alert"] = "success";
                      }else{
                        $alert = $_GET["alert"];
                      }
                }


            if($action){
                if($action == "hapus"){
                    if(hapus($user_id,$page) > 0){
                        $alert = $_GET["alert"] = "hapus";
                    }
                }elseif($action == "edit"){
                   if(isset($_POST["edit"])){
                        if(edit($_POST) > 0){
                            $alert = $_GET["alert"] = "edit";
                        }
                   }
                }
            }
            $user = data("SELECT * FROM user");
            $role = data("SELECT * FROM role");
                  ?>
<?php if($action == "edit"):?>
<?php $user = data("SELECT * FROM user WHERE user_id='$user_id'"); ?>
<?php $role = data("SELECT * FROM role INNER JOIN role_user WHERE role_user.user_id = $user_id AND role_user.role_id = role.role_id "); ?>
<?php   $all_role = data("SELECT * FROM role");?>

    <div class="container">
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Account</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                    <?php foreach($user as $u):?>
                                        <input type="hidden" name="page" value="<?=$page?>">
                                        <input type="hidden" name="user_id" value="<?=$u['user_id']?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="username" required value="<?=$u["username"]?>"/>
                                                        <label for="inputLastName">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="nama_lengkap" required value="<?=$u['nama_lengkap']?>"/>
                                                        <label for="inputLastName">Nama Lengkap</label>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="password" type="password" placeholder="Masukkan password" name="password"/>
                                                        <label for="nama_lengkap">Masukkan password baru</label>
                                                    </div>
                                                </div>
                                           </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="formFileLg" class="form-label mb-1">Previous</label> <img src="assets/upload/<?=$u['profile']?>" class="img-fluid rounded-circle mb-1" alt="profile" style="width: 30px; height:30px;">
                                                    <input class="form-control form-control-sm" id="formFileLg" type="file" name="gambar">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label>Previous</label>
                                                    (<?php foreach($role as $r): ?>
                                                      <small class="text-uppercase">
                                                         <?=$r["role"];?>,
                                                      </small>
                                                    <?php endforeach; ?>)
                                                    <div class="form-floating">
                                                    <select class="form-select" id="demo" multiple="multiple" name="role[]">
                                                        <?php foreach($all_role as $ar):?>
                                                            <option value="<?=strtoupper($ar['role_id']);?>"><?=$ar['role']?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                            <div class="mt-4 mb-0">
                                               <button class="btn btn-primary" type="submit" name="edit">Edit Account</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.html">View Dosen</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php else:?>
                   <div class="container">
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-7">
                            <?php if($alert == 'username'):?>
                                 <div class="alert alert-danger" role="alert">
                                        Username sudah digunakan!
                                    </div>
                            <?php elseif($alert == 'nama_lengkap'): ?>
                                    <div class="alert alert-danger" role="alert">
                                       Nama Lengkap sudah digunakan!
                                    </div>
                            <?php elseif($alert == 'hapus'): ?>
                                     <div class="alert alert-danger" role="alert">
                                       Data berhasil dihapus!
                                    </div>
                            <?php elseif($alert == 'ukuran'): ?>
                                     <div class="alert alert-danger" role="alert">
                                       Ukuran file terlalu besar!
                                    </div>
                            <?php elseif($alert == 'ekstensi'): ?>
                                     <div class="alert alert-danger" role="alert">
                                      Yang anda masukkan bukan gambar!
                                    </div>
                            <?php elseif($alert == 'success'): ?>
                                    <div class="alert alert-success" role="alert">
                                       Data berhasil disimpan
                                    </div>
                            <?php elseif($alert == 'edit'): ?>
                                    <div class="alert alert-success" role="alert">
                                       Data berhasil diubah
                                    </div>
                            <?php endif;?>
                                <div class="card shadow-lg border-0 rounded-lg mt-2">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="page" value="<?=$page?>">
                                            <div class="row mb-2">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="username" required/>
                                                        <label for="inputLastName">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="nama_lengkap" type="text" placeholder="nama_lengkap" name="nama_lengkap" required/>
                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" name="password" required/>
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="formFileLg" class="form-label mb-1">Foto profil <small>( jpg, png, jpeg )</small></label>
                                                    <input class="form-control form-control-sm" id="formFileLg" type="file" name="gambar">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Pick Role</label>
                                                    <div class="form-floating">
                                                        <select class="form-select" id="demo" multiple="multiple" name="role[]" required>
                                                        <?php foreach($role as $r): ?>
                                                            <option value="<?=strtoupper($r['role_id']);?>"><?=$r['role']?></option>
                                                        <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                               <button class="btn btn-primary" type="submit" name="simpan">Create Account</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.html">View Dosen</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
<?php endif; ?>
            <br>
                <div class="container">
                    <div class="card mb-4">
                            <div class="card-body">
                                You can add New Employee, and view Existing Employee in the table below
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Your All Employee
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($user as $u): ?>
                                <?php $role_user_id=$u['user_id']?>
                                <?php $roles=data("SELECT * FROM role INNER JOIN role_user ON role_user.user_id = $role_user_id AND role_user.role_id = role.role_id");?>
                                        <tr>
                                            <td><?=$no;?></td>
                                            <td><?=$u['username'];?></td>
                                            <td><?=$u['nama_lengkap'];?></td>
                                            <td class="text-uppercase text-center">
                                            <?php foreach($roles as $r): ?>
                                               <?=$r['role'];?>,
                                            <?php endforeach; ?>
                                            </td>
                                            <td class="text-center">
                                               <a class="btn btn-success btn-sm" href="index.php?page=register-dosen&action=edit&id=<?=$u['user_id']?>"><i class="fas fa-edit"></i> Edit</a>
                                               <a class="btn btn-danger btn-sm" href="index.php?page=register-dosen&action=hapus&id=<?=$u['user_id']?>"><i class="fas fa-trash"></i></i> Hapus</a>
                                            </td>
                                        </tr>
                                <?php $no++; ?>
                                <?php endforeach;?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>