<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('privacy_policy/index/' . $privacy_policy['id']); ?>
            <div class="form-group row">
                <label for="privacy_policy" class="col-sm-2 col-form-label">Privacy Policy</label>
                <div class="col-sm-10">
                    <textarea name="privacy_policy" id="privacy_policy" class="form-control"><?= $privacy_policy['privacy_policy']; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="terms_condition" class="col-sm-2 col-form-label">Terms & Condition</label>
                <div class="col-sm-10">
                    <textarea name="terms_condition" id="terms_condition" class="form-control"><?= $privacy_policy['terms_condition']; ?></textarea>
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