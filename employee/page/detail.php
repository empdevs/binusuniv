<?php
    $employee_popup = data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id=role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id WHERE employee_activity.employee_activity_id = '$employee_activity_id' ");
?>
<div id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="staticBackdropLabel">Your Activity Today</h5>
        <a href="index.php?page=dashboard" class="btn-close"></a>
      </div>
      <div class="modal-body">
       <?php foreach($employee_popup as $ea):?>
            <p class="d-inline fs-5 fw-bold">Nama Lengkap : </p>
                <p class=" d-inline fst-normal fs-5"><?=$ea["nama_lengkap"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Role : </p>
                <p class="d-inline fst-normal text-uppercase fs-5"><?=$ea["role"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Activity : </p>
                <p class=" d-inline fst-normal fs-5"><?=$ea["activity"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Date : </p>
                <p class=" d-inline fst-normal fs-5"><?php $ea["date"] = strftime('%A, %d %B %Y',strtotime($ea["date"])); ?><?=$ea["date"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Waktu : </p>
                <p class=" d-inline fst-normal fs-5"><?=$ea["waktu_mulai"]?> - <?=$ea["waktu_selesai"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Related With : </p>
                <p class=" d-inline fst-normal fs-5"><?=$ea["related_with"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Invited By : </p>
                <p class=" d-inline fst-normal fs-5"><?=$ea["invited_by"]?></p><br>
            <p class="d-inline fs-5 fw-bold">Status : </p>
                <p class=" d-inline fst-normal fs-5"><?= $status = $ea["status"] ? $ea["status"] : "-"; ?></p><br>
            <p class="d-inline fs-5 fw-bold">Place : </p>
                <p class=" d-inline fst-normal fs-5"><?= $place = $ea["place"] ? $ea["place"] : "-"; ?></p><br>
            <?php if($ea["dari_tanggal"] && $ea["sampai_tanggal"]):?>
            <p class="d-inline fs-5 fw-bold">Berkelanjutan : </p>
                <p class=" d-inline fst-normal fs-5">
                <?php $ea["dari_tanggal"] = strftime('%A, %d %B %Y',strtotime($ea["dari_tanggal"])); ?>
                <?php $ea["sampai_tanggal"] = strftime('%A, %d %B %Y',strtotime($ea["sampai_tanggal"])); ?>
                    <?=$ea["dari_tanggal"]?> - <?=$ea["sampai_tanggal"]?> 
                </p><br>
            <?php else: ?>
                <p class="d-inline fs-5 fw-bold">Berkelanjutan : </p>
                <p class=" d-inline fst-normal fs-5">
                    - 
                </p><br>
            <?php endif;?>
            <p class="d-inline fs-5 fw-bold">Note : </p>
                <p class=" d-inline fst-normal fs-5"><?=$note=$ea["note"]?$ea["note"]:"-";?></p><br>
            <p class="d-inline fs-5 fw-bold">Documentation : </p>
            <?php if($ea["documentation"]): ?>
               <img style="width:50px; height:50px;" src="../../../binusuniv/employee/assets/upload/<?=$ea["documentation"]?>" alt="gambar"><br>
            <?php else: ?>
                -
            <?php endif;?>
       <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>