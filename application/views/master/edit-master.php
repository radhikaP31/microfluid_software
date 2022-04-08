<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('independent_mst/editMaster/' . $master['id']); ?>
            <div class="form-group row">
                <label for="type_id" class="col-sm-2 col-form-label">type_id</label>
                <div class="col-sm-10">
                    <select class="form-control select-default selectpicker" placeholder="" id="type_id" name="type_id">
                        <option value="">Select a Common Type</option>
                        <?php foreach ($common_types as $key => $type) { ?>
                            
                            <?php $selected = '';
                                if($master['type_id'] == $type['id']){
                                    $selected = 'selected';
                                } ?>
                            <option value="<?= $type['id'] ?>" <?= $selected; ?>><?= $type['title'] ?></option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" name="type_id" id="type_id" class="form-control" value="<?= $master['type_id']; ?>"> -->                    
                </div>
            </div>
            <div class="form-group row">
                <label for="mstr_cd" class="col-sm-2 col-form-label">Master Code</label>
                <div class="col-sm-10">
                    <input type="text" name="mstr_cd" id="mstr_cd" class="form-control" value="<?= $master['mstr_cd']; ?>">
                    <?= form_error('mstr_cd', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="mstr_nm" class="col-sm-2 col-form-label">Master Name</label>
                <div class="col-sm-10">
                    <input type="text" name="mstr_nm" id="mstr_nm" class="form-control" value="<?= $master['mstr_nm']; ?>">
                    <?= form_error('mstr_nm', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="mstr_desc" class="col-sm-2 col-form-label">Master Description</label>
                <div class="col-sm-10">
                    <input type="text" name="mstr_desc" id="mstr_desc" class="form-control" value="<?= $master['mstr_desc']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control select-default selectpicker" placeholder="" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="1" <?php if($master['status']==1){ echo "selected"; } ?>>Active</option>
                        <option value="0" <?php if($master['status']==0){ echo "selected"; } ?>>Pending</option>
                    </select>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->