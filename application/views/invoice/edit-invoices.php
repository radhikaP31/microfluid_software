<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('invoices/editInvoice/' . $invoice['id']); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" value="<?= $invoice['title']; ?>">
                    <?= form_error('title', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" name="description" id="description" class="form-control" value="<?= $invoice['description']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Subscription</label>
                <div class="col-sm-10">
                    <input type="text" name="subscription" id="subscription" class="form-control" value="<?= $invoice['subscription']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input type="date" name="date" id="date" class="form-control" value="<?= $invoice['date']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Next Due Date</label>
                <div class="col-sm-10">
                    <input type="date" name="next_due_date" id="next_due_date" class="form-control" value="<?= $invoice['next_due_date']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control select-default selectpicker" placeholder="" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="1" <?php if($invoice['status']==1){ echo "selected"; } ?>>Active</option>
                        <option value="0" <?php if($invoice['status']==0){ echo "selected"; } ?>>Pending</option>
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