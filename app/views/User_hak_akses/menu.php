<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" id="checkAll" class="form-check-input"> <strong>Check / Not All</strong>
                </label>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <?php $menu = getResultArray('z_menu', array('stdel' => '0'))?>
    <?php foreach ($menu as $row): ?>
        <?php $check = getResultArray('z_userpermissiondetail', array('idpermission' => $id, 'menuid' => $row['id']))?>
        <div class="col-md-3">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" name="menu[]" value="<?php echo $row['id'] ?>" class="form-check-input menu" <?php echo ($check) ? 'checked=""' : '' ?> > <?php echo $row['name'] ?>
                    </label>
                </div>
            </div>
        </div>
    <?php endforeach?>
</div>
