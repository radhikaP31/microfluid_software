<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('title', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('title'); ?>
            <!--<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addInvoiceModal">Add New Invoice</a> -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Random Invoice ID</th>
                            <th>Order ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Subscription</th>
                            <th>Date</th>
                            <th>Next Due Date</th>
                          <!--  <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach ($invoices as $invoice) : ?>
                                <tr>
                                   <!-- <th scope="row"><?= $i; ?></th> -->
								   <td><?= $invoice['id'] ?></td>
                                    <td><?= $invoice['random_invoice_id'] ?></td>
                                    <td><?= $invoice['order_id'] ?></td>
                                    <td><?= $invoice['title'] ?></td>
                                    <td><?= $invoice['description'] ?></td>
                                    <td><?= $invoice['subscription'] ?></td>
                                    <td><?php echo date_format(date_create($invoice['date']),'Y-m-d'); ?></td>
                                    <td><?php echo date_format(date_create($invoice['next_due_date']),'Y-m-d'); ?></td>
                                   <!-- <td><?php if($invoice['status'] ==1){ echo 'Active' ; } else{ echo 'Pending' ; }  ?></td> -->
                                    <td>
                                        <a href="<?= base_url('invoices/editInvoice/' . $invoice['id']); ?>" class="fa fa-edit" title="Edit"></a>
                                        <a href="<?= base_url('invoices/deleteInvoice/' . $invoice['id']); ?>" data-id="<?php echo $invoice['id']; ?>"  class="fa fa-trash deleteitem" data-toggle="modal" data-target="#deleteInvoice" title="Delete"></a>
                                        <!-- <a href="<?= base_url('invoices/deleteInvoice/' . $invoice['id']); ?>" class="badge badge-danger" data-toggle="modal" data-target="#deleteInvoice">Delete</a> -->
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
<div class="modal fade" id="addInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Add New Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('invoices'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Invoice Title">
                    </div>
                    <div class="form-group">
                        <input type="textarea" class="form-control" id="description" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subscription" name="subscription" placeholder="Subscription">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" placeholder="date">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="next_due_date" name="next_due_date" placeholder="Next Due Date">
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
                    <button type="submit" class="btn btn-primary">Add Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteInvoice" tabindex="-1" role="dialog" aria-labelledby="deleteInvoiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteInvoiceLabel">Delete Invoice</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete <?= $invoice['title']; ?> invoice?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary deletebtn" href="<?= base_url('invoices/deleteInvoice/') . $invoice['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>