<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('mstr_cd', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('mstr_cd'); ?>
            <?= form_error('mstr_name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('mstr_name'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMasterModal">Add New Master</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Master Code</th>
                            <th>Master Name</th>
                            <th>Description</th>
                            <th>Type ID</th>
                            <th>Type code</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($masters as $master) : ?>
                                <tr>
                                    <!-- <th scope="row"><?= $i; ?></th> -->
									<td><?= $master['id'] ?></td>
                                    <td><?= $master['mstr_cd'] ?></td>
                                    <td><?= $master['mstr_nm'] ?></td>
                                    <td><?= $master['mstr_description'] ?></td>
                                    <td><?= $master['type_id'] ?></td>
                                    <td><?= $master['type_cd'] ?></td>
                                  <!-- <td><?php if($master['status'] ==1){ echo 'Active' ; }else{ echo 'Pending' ; } ?></td> -->
                                    <td>
                                        <a href="<?= base_url('independent_mst/editMaster/' . $master['id']); ?>" class="badge badge-success">Edit</a>
                                        <a href="<?= base_url('independent_mst/deleteMaster/' . $master['id']); ?>" data-id="<?php echo $master['id']; ?>"  class="badge badge-danger deleteitem" data-toggle="modal" data-target="#deleteMaster">Delete</a>
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
<div class="modal fade" id="addMasterModal" tabindex="-1" role="dialog" aria-labelledby="addMasterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMasterModalLabel">Add New Master</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('independent_mst'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control select-default selectpicker" placeholder="" id="type_id" name="type_id">
                            <option value="">Select a Common Type</option>
                            <?php foreach ($common_types as $key => $type) { ?>
                                <option value="<?= $type['id'] ?>"><?= $type['title'] ?></option>
                            <?php } ?>
                        </select>
                        <!-- <input type="text" class="form-control" id="type_id" name="type_id" placeholder="Type ID"> -->
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mstr_cd" name="mstr_cd" placeholder="Master Code">
                    </div>
                    <div class="form-group">
                        <input type="textarea" class="form-control" id="mstr_nm" name="mstr_nm" placeholder="Master Name">
                    </div>
                    <div class="form-group">
                        <input type="textarea" class="form-control" id="mstr_description" name="mstr_description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <select class="form-control select-default selectpicker" placeholder="" id="status" name="status">
                            <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Master</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMaster" tabindex="-1" role="dialog" aria-labelledby="deleteMasterLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMasterLabel">Delete Master</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete <?= $master['mstr_nm']; ?> master?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary deletebtn" href="<?= base_url('independent_mst/deleteMaster/') . $master['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>