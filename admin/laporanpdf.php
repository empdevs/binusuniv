<?php 
    require_once ("../function/function.php");
    require_once ("../vendor/autoload.php");
    $mpdf = new \Mpdf\Mpdf();
?>

<!-- Data -->
<?php
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    $query = $_GET["query"];//ambil query
    $name_employee = $_GET["name_employee"];//set nama karyawan

    date_default_timezone_set('Asia/Jakarta');//set lokasi indonesia
    $waktu = strftime('%A, %d %B %Y %H:%M',strtotime(date("l, Y-m-d H:i")));//set time stamp
    

    $employee_activity=data($query);//query data
    
    $html ='
    <head>
    
    <style>
        .kop{
            
        position:absolute;
        top:0;
        left:0;
        }
        .keterangan{
            position:absolute;
            top : 175px;
            left:80px;
        }
         .judul{
            
            position:absolute;
            top:95px;
            left:50px;
            right:50px;
            
        }
        .container{
            
            position:absolute;
            top:200px;
            right:10px;
            
        }
        h3{
            text-align:center;
        }
    </style>
</head>
    <div class="kop">
    <img src="assets/img/kop.png">
    </div>
    <div class="judul">
        <h3>Smart Dashboard of Employees in Information Systems Department (SmartBe) BINUS Online Learning</h3>
     </div>
    <div class="keterangan">
        <i><small>'.$name_employee.'</small></i>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
            <div class="card">
                    <div class="card-body">
                        <table  border="1"; width="90%"; cellpadding="7" cellspacing="0"; class="table table-striped table-bordered">
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
                            <tbody>';
                $no=1;
                foreach($employee_activity as $ea){
                    $ea["date"] = strftime('%A, %d %B %Y',strtotime($ea["date"]));
                $html.='<tr>
                            <td>'. $no++ .'</td>
                            <td>'. $ea["nama_lengkap"] .'</td>
                            <td>'. strtoupper($ea["role"]) .'</td>
                            <td>'. $ea["activity"] .'</td>
                            <td>'. $ea["date"] .'</td>
                            <td>'. $ea["related_with"] .'</td>
                            <td>'. $ea["invited_by"] .'</td>
                            <td>';
                                if($ea['documentation']){
                                    $html.='<img src="../employee/assets/upload/'.$ea["documentation"].'" style="width=50px; height:50px" />';
                                }else{
                                    $html.='Tidak ada gambar';
                                }
                        $html.='</td>
                            <td>'. $ea["note"] .'</td>
                        </tr>';
                }

                   $html.='</tbody>
                    </table><br>
                    <i><small>Dicetak pada '.$waktu.'</small></i>
                </div>
            </div>
        </div>
    </div>
</div>';
     $mpdf->WriteHTML($html);
     $mpdf->Output("Data-Laporan.pdf","I");
     exit;
?>