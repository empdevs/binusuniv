<?php 
    $koneksi=mysqli_connect("localhost","serversf_binus","Alafgani97","serversf_binus");

    function data($query){
        global $koneksi;
        $data=mysqli_query($koneksi,$query);
        $rows = [];
        while($row=mysqli_fetch_assoc($data)){
            $rows[]= $row;
        }
        // var_dump($rows);die;
        return $rows;
    }

    function tambah($data){
        global $koneksi;
        //var_dump($data);die;
       $page = $data["page"];
       if($page == "new-activity"){
            $user_id = ($data["user_id"]);
            $id = htmlspecialchars($data["id"]);
            $activity = htmlspecialchars($data["activity"]);
            $tanggal = htmlspecialchars($data["tanggal"]);
            $waktu = htmlspecialchars($data["waktu"]);
            $waktu2 = htmlspecialchars($data["waktu2"]);
            $place = htmlspecialchars($data["place"]);
            $link = htmlspecialchars($data["link"]);

            mysqli_query($koneksi,"INSERT INTO activity VALUES ('','$user_id','$id','$activity','$tanggal','$waktu','$waktu2','$place','$link')");
   
        }elseif($page == "employee-activity"){
            $user_id = htmlspecialchars($data["user_id"]);
            if(empty($data["role_id"])){
                $alert = $_GET["alert"] = "role_id";
                echo "<script>
                    document.location.href='?page=employee-activity&alert=$alert';
                </script>";
                exit;
            }else{
                $role_id = htmlspecialchars($data["role_id"]);
            }
            $activity = htmlspecialchars($data["activity"]);
            $tanggal = htmlspecialchars($data["tanggal"]);
            $waktu_mulai=htmlspecialchars($data["waktu_mulai"]);
            $waktu_selesai=htmlspecialchars($data["waktu_selesai"]);
            $related_with=htmlspecialchars($data["related_with"]);
            $invby = htmlspecialchars($data["invby"]);
            $status = htmlspecialchars($data["status"]);
            $place = htmlspecialchars($data["place"]);
            $dari_tanggal = htmlspecialchars($data["dari_tanggal"]);
            $sampai_tanggal = htmlspecialchars($data["sampai_tanggal"]);
            $note = htmlspecialchars($data["note"]);

            // setlocale(LC_ALL, 'id-ID', 'id_ID');//set lokasi INDONESIA (id-ID, untuk di windows, id_ID untuk di linux)
            // $tanggal = strftime('%A, %d %B %Y',strtotime($tanggal));

            $nama_gambar = $_FILES["documentation"]["name"];
            $size = $_FILES["documentation"]["size"];
            $tmp_name = $_FILES["documentation"]["tmp_name"];
            $error = $_FILES["documentation"]["error"];

            if($error > 0){
                $gambar = "";
                mysqli_query($koneksi,"INSERT INTO employee_activity VALUES('','$user_id','$role_id','$activity','$tanggal','$waktu_mulai','$waktu_selesai','$related_with','$invby','$status','$place','$dari_tanggal','$sampai_tanggal','$gambar','$note')");
            }else{
               
                $ekstensi_gambar_valid = ["pdf","jpeg","png"];
                $ekstensi_gambar = explode(".",$nama_gambar);
                $ekstensi_gambar = strtolower(end($ekstensi_gambar));

                if(!in_array($ekstensi_gambar,$ekstensi_gambar_valid)){
                    $alert = $_GET["alert"] = "ekstensi";
                    echo "<script>
                            document.location.href='?page=employee-activity&alert=$alert';
                        </script>";
                    exit;
                }
                $nama_gambar_baru = uniqid();
                $nama_gambar_baru =$nama_gambar_baru.".".$ekstensi_gambar;
            
                move_uploaded_file($tmp_name,"assets/upload/".$nama_gambar_baru);

                mysqli_query($koneksi,"INSERT INTO employee_activity VALUES('','$user_id','$role_id','$activity','$tanggal','$waktu_mulai','$waktu_selesai','$related_with','$invby','$status','$place','$dari_tanggal','$sampai_tanggal','$nama_gambar_baru','$note')");
            
               
            }

        }elseif($page == "register-dosen"){
            $username = htmlspecialchars($data["username"]);
            $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
            $password = htmlspecialchars($data["password"]);
            $role =$data["role"];

            $nama_gambar = $_FILES["gambar"]["name"];
            $size = $_FILES["gambar"]["size"];
            $tmp_name = $_FILES["gambar"]["tmp_name"];
            $error = $_FILES["gambar"]["error"];

            
            $nama_username= data("SELECT * FROM user");
            foreach($nama_username as $nu){
                $username_db=$nu["username"];
                $nama_lengkap_db=$nu["nama_lengkap"];

                if($username_db == $username){
                    $alert = $_GET["alert"] = "username";
                    echo "<script>
                                document.location.href='?page=register-dosen&alert=$alert';
                            </script>";
                        exit;
                }

                if($nama_lengkap_db == $nama_lengkap){
                    $alert = $_GET["alert"] = "email";
                    echo "<script>
                                document.location.href='?page=register-dosen&alert=$alert';
                            </script>";
                        exit;
                }

            }
                if($size > 2000000){
                    $alert = $_GET["alert"] = "size";
                    echo "<script>
                                document.location.href='?page=register-dosen&alert=$alert';
                            </script>";
                        exit;
                }
                $ekstensi_gambar_valid = ["jpg","jpeg","png"];
                $ekstensi_gambar = explode(".",$nama_gambar);
                $ekstensi_gambar = strtolower(end($ekstensi_gambar));

                if(!in_array($ekstensi_gambar,$ekstensi_gambar_valid)){
                    $alert = $_GET["alert"] = "ekstensi";
                    echo "<script>
                            document.location.href='?page=register-dosen&alert=$alert';
                        </script>";
                    exit;
                }

                $nama_gambar_baru = uniqid();
                $nama_gambar_baru =$nama_gambar_baru.".".$ekstensi_gambar;
                move_uploaded_file($tmp_name,"assets/upload/".$nama_gambar_baru);

                $password = password_hash($password,PASSWORD_DEFAULT);

            mysqli_query($koneksi,"INSERT INTO user VALUES('','$username','$nama_lengkap','$nama_gambar_baru','$password')");

            //query user_id
            $user = data("SELECT user_id FROM user WHERE username ='$username'");
            foreach($user as $u){
                $user_id=$u["user_id"];
            }

            for($i=0; $i < count($role); $i++){
                $roles=$role[$i];
                mysqli_query($koneksi,"INSERT INTO role_user VALUES ('$user_id','$roles')" );
            }

        }elseif($page == "role"){
            $role = strtolower($_POST["role"]);
            mysqli_query($koneksi,"INSERT INTO role VALUES('','$role')");
        }


        return mysqli_affected_rows($koneksi);

    }

    function hapus($id,$page){
        global $koneksi;

        if($page == "new-activity"){
            mysqli_query($koneksi,"DELETE FROM activity WHERE activity_id = '$id'");
        }elseif($page == "employee-activity"){
            $gambar = data("SELECT * FROM employee_activity WHERE employee_activity_id='$id' ");
            foreach($gambar as $g){
                $g["documentation"];
            }
            if(empty($g["documentation"])){
                mysqli_query($koneksi,"DELETE FROM employee_activity WHERE employee_activity_id='$id'");
            }else{
                foreach($gambar as $g){
                $hapus=unlink("assets/upload/".$g['documentation']);
                    if($hapus){
                        mysqli_query($koneksi,"DELETE FROM employee_activity WHERE employee_activity_id='$id'");
                    }
                }
            }
        }elseif($page == "register-dosen"){
            $data_gambar = data("SELECT profile FROM user WHERE user_id = '$id'");//query gambar

            if($data_gambar){
                foreach($data_gambar as $dg){
                    unlink("assets/upload/".$dg['profile']);//hapus gambar lama dalam folder
                }
            }
            mysqli_query($koneksi,"DELETE FROM user WHERE user_id = '$id'");//hapus data
            mysqli_query($koneksi,"DELETE FROM role_user WHERE user_id = '$id'");//hapus data
        }elseif($page == "role"){
            mysqli_query($koneksi,"DELETE FROM role WHERE role_id = '$id'");
        }

        return mysqli_affected_rows($koneksi);

    }
    function edit($data){
        global $koneksi;

        $page = $data["page"];

        // var_dump($data);die;
        if($page == "new-activity"){
            
            $activity_id = $data["activity_id"];
            $id = htmlspecialchars($data["id"]);
            $activity = htmlspecialchars($data["activity"]);
            $tanggal = htmlspecialchars($data["tanggal"]);
            $waktu = htmlspecialchars($data["waktu"]);
            $waktu2 = htmlspecialchars($data["waktu2"]);
            $place = htmlspecialchars($data["place"]);
            $link = htmlspecialchars($data["link"]);
            
            mysqli_query($koneksi,"UPDATE activity SET id='$id', activity='$activity', date='$tanggal',waktu='$waktu', waktu2='$waktu2', place='$place', link='$link' WHERE activity_id = '$activity_id'");
        }elseif($page == "employee-activity"){

            $employee_activity_id = htmlspecialchars($data["employee_activity_id"]);
            $user_id = htmlspecialchars($data["user_id"]);
            $role_id = htmlspecialchars($data["role_id"]);
            $activity = htmlspecialchars($data["activity"]);
            $tanggal = htmlspecialchars($data["tanggal"]);
            $waktu_mulai=htmlspecialchars($data["waktu_mulai"]);
            $waktu_selesai=htmlspecialchars($data["waktu_selesai"]);
            $related_with=htmlspecialchars($data["related_with"]);
            $invby = htmlspecialchars($data["invby"]);
            $status = htmlspecialchars($data["status"]);
            $place = htmlspecialchars($data["place"]);
            $dari_tanggal = htmlspecialchars($data["dari_tanggal"]);
            $sampai_tanggal = htmlspecialchars($data["sampai_tanggal"]);
            $note = htmlspecialchars($data["note"]);

            // setlocale(LC_ALL, 'id-ID', 'id_ID');//set lokasi INDONESIA (id-ID, untuk di windows, id_ID untuk di linux)
            // $tanggal = strftime('%A, %d %B %Y',strtotime($tanggal));

            $nama_gambar = $_FILES["documentation"]["name"];
            $size = $_FILES["documentation"]["size"];
            $tmp_name = $_FILES["documentation"]["tmp_name"];
            $error = $_FILES["documentation"]["error"];


            if($error > 0){
                $data = data("SELECT documentation FROM employee_activity WHERE employee_activity_id = '$employee_activity_id'");

                foreach($data as $d){
                   $gambar_lama = $d["documentation"];
                }
                mysqli_query($koneksi,"UPDATE employee_activity SET role_id='$role_id', activity='$activity',date='$tanggal',waktu_mulai='$waktu_mulai',waktu_selesai='$waktu_selesai',related_with='$related_with', invited_by ='$invby',status='$status',place='$place',dari_tanggal='$dari_tanggal',sampai_tanggal='$sampai_tanggal', documentation='$gambar_lama',note='$note' WHERE employee_activity_id='$employee_activity_id'");    

            }else{
            

                $ekstensi_gambar_valid = ["pdf","png","jpeg"];
                $ekstensi_gambar = explode(".",$nama_gambar);
                $ekstensi_gambar = strtolower(end($ekstensi_gambar));

                if(!in_array($ekstensi_gambar,$ekstensi_gambar_valid)){
                    $alert = $_GET["alert"] = "ekstensi";
                    echo "<script>
                            document.location.href='?page=employee-activity&action=edit&employee_activity_id=$employee_activity_id&alert=$alert';
                        </script>";
                    exit;
                }
                
                $nama_gambar_baru = uniqid();
                $nama_gambar_baru =$nama_gambar_baru.".".$ekstensi_gambar;

                $gambar_lama = data("SELECT documentation FROM employee_activity WHERE employee_activity_id = '$employee_activity_id'");
                
                if(empty($gambar_lama)){
                    $nama_gambar_baru=$nama_gambar_baru;
                }else{
                    foreach($gambar_lama as $g){
                       unlink("assets/upload/".$g['documentation']);
                    }

                }
                move_uploaded_file($tmp_name,"assets/upload/$nama_gambar_baru");

                mysqli_query($koneksi,"UPDATE employee_activity SET role_id='$role_id', activity='$activity',date='$tanggal',waktu_mulai='$waktu_mulai',waktu_selesai='$waktu_selesai',related_with='$related_with', invited_by ='$invby',status='$status',place='$place',dari_tanggal='$dari_tanggal',sampai_tanggal='$sampai_tanggal', documentation='$nama_gambar_baru',note='$note' WHERE employee_activity_id='$employee_activity_id'");  

        }
           
        }elseif($page == "register-dosen"){
            $user_id = htmlspecialchars($data["user_id"]);
            $username = htmlspecialchars($data["username"]);
            $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
            $password = $data["password"];
            $role = !empty($data["role"]) ? $data["role"] : null;

            $nama_gambar = $_FILES["gambar"]["name"];
            $size = $_FILES["gambar"]["size"];
            $tmp_name = $_FILES["gambar"]["tmp_name"];
            $error = $_FILES["gambar"]["error"];

            if(!empty($role)){  
                mysqli_query($koneksi,"DELETE FROM role_user WHERE user_id = '$user_id'");//hapus data
                
                for($i=0; $i<count($role); $i++){
                    $roles = $role[$i];
                    mysqli_query($koneksi,"INSERT INTO role_user VALUES('$user_id','$roles')");
                }
            }

            if(!empty($password)){//ketika dimasukkan password baru
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    
            }else{
                    $password_hash = data("SELECT password FROM user WHERE user_id = '$user_id'");
                    foreach($password_hash as $pw){
                            $password = $pw["password"];
                    }
            }
            
            if($error === 0){//ketika ada yang di upload
                if($size > 2000000){
                    $alert = $_GET["alert"] = "size";
                    echo "<script>
                                document.location.href='?page=register-dosen&alert=$alert';
                                </script>";
                        exit;
                    }
                    
                $ekstensi_gambar_valid = ["jpg","jpeg","png"];
                $ekstensi_gambar = explode(".",$nama_gambar);
                $ekstensi_gambar = strtolower(end($ekstensi_gambar));

                if(!in_array($ekstensi_gambar,$ekstensi_gambar_valid)){
                    $alert = $_GET["alert"] = "ekstensi";
                    echo "<script>
                            document.location.href='?page=register-dosen&alert=$alert';
                            </script>";
                            exit;
                }

                $gambar_lama = data("SELECT profile FROM user WHERE user_id = '$user_id'");
                if($gambar_lama){
                    foreach($gambar_lama as $gl){
                        unlink("assets/upload/".$gl['profile']);
                    }
                }
                
                $nama_gambar_baru = uniqid();
                $nama_gambar_baru =$nama_gambar_baru.".".$ekstensi_gambar;
                move_uploaded_file($tmp_name,"assets/upload/".$nama_gambar_baru);
            }else{
                $gambar_lama = data("SELECT profile FROM user WHERE user_id='$user_id'");//padahalma gambar lama wkkwkw, males ganti var 
                foreach($gambar_lama as $gl){
                    $nama_gambar_baru = $gl["profile"];//padahalma gambar lama
                }
            }
            

            mysqli_query($koneksi,"UPDATE user SET username='$username',nama_lengkap='$nama_lengkap',profile='$nama_gambar_baru', password='$password' WHERE user_id ='$user_id'");
            
            $alert = $_GET["alert"] = "edit";
            echo "<script>
                    document.location.href='?page=register-dosen&alert=$alert';
                </script>";
            return mysqli_affected_rows($koneksi);

    }elseif($page == "role"){
            $role_id = $data["role_id"];
            $role = strtolower($data["role"]);

            mysqli_query($koneksi,"UPDATE role SET role='$role' WHERE role_id='$role_id'");
        }
        return mysqli_affected_rows($koneksi);
    }
?>