<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('common_type/editType/' . $common_type['id']); ?>
            <div class="form-group row">
                <label for="type_cd" class="col-sm-2 col-form-label">Type Code</label>
                <div class="col-sm-10">
                    <input type="text" name="type_cd" id="type_cd" class="form-control" value="<?= $common_type['type_cd']; ?>">
                    <?= form_error('type_cd', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $common_type['title']; ?>">
                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>

                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" name="description" id="description" class="form-control" value="<?= $common_type['description']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="parent_id" class="col-sm-2 col-form-label">Parent ID</label>
                <div class="col-sm-10">
                    <select class="form-control select-default selectpicker" placeholder="" id="parent_id" name="parent_id">
                            <option value="">Select a Parent Type</option>
                            <?php foreach ($common_types as $key => $type) { ?>
                                <?php $selected = '';
                                if($common_type['parent_id'] == $type['id']){
                                    $selected = 'selected';
                                } ?>
                                <option value="<?= $type['id'] ?>"><?= $type['title'] ?></option>
                            <?php } ?>
                        </select>
                    <!-- <input type="text" name="parent_id" id="parent_id" class="form-control" value="<?= $common_type['parent_id']; ?>"> -->
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