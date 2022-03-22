<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('type_cd', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('type_cd'); ?>
            <?= form_error('title', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('title'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addTypeModal">Add New Common Type</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type Code</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Parent Id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($common_types as $common_type) : ?>
                                <tr>
                                    <td><?= $common_type['id'] ?></td>
                                    <td><a href="<?php echo base_url('independent_mst/index/' . $common_type['id']); ?>"><?= $common_type['type_cd'] ?></a></td>
                                    <td><?= $common_type['title'] ?></td>
                                    <td><?= $common_type['description'] ?></td>
                                    <td><?= $common_type['parent_id'] ?></td>
                                    <td>
                                        <a href="<?= base_url('common_type/editType/' . $common_type['id']); ?>" class="badge badge-success">Edit</a>
                                        <a href="<?= base_url('common_type/deleteType/' . $common_type['id']); ?>" data-id="<?php echo $common_type['id']; ?>" class="badge badge-danger deleteitem" data-toggle="modal" data-target="#deleteType">Delete</a>
                                    </td>
                                </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeModalLabel">Add New Master</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('common_type'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="type_cd" name="type_cd" placeholder="Type Code">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <select class="form-control select-default selectpicker" placeholder="" id="parent_id" name="parent_id">
                            <option value="">Select a Parent Type</option>
                            <?php foreach ($common_types as $key => $type) { ?>
                                <option value="<?= $type['id'] ?>"><?= $type['title'] ?></option>
                            <?php } ?>
                        </select>
                        <!-- <input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="Parent ID"> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Type</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteType" tabindex="-1" role="dialog" aria-labelledby="deleteTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTypeLabel">Delete Type</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete <?= $common_type['title']; ?> common_type?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary deletebtn" href="<?= base_url('common_type/deleteType/') . $common_type['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>