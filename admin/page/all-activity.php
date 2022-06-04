<?php
      $employee_activity=data("SELECT * FROM employee_activity INNER JOIN role ON employee_activity.role_id = role.role_id INNER JOIN user ON employee_activity.user_id = user.user_id");
?>
<h3 class="text-center my-5">All Employee Activities</h3>
<div class="container">
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