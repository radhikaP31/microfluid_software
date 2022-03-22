<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Settings</h1>



    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open('settings/index/' . $settings['id']); ?>
            <div class="form-group row">
                <label for="website_title" class="col-sm-2 col-form-label">Website Title</label>
                <div class="col-sm-10">
                    <input type="textarea" class="form-control" id="website_title" name="website_title" placeholder="Website Title" value="<?php echo $settings['website_title']; ?>">
                </div>
            </div>
			<!--
            <div class="form-group row">
                <label for="approved_client" class="col-sm-2 col-form-label">Approved Client</label>
                <div class="col-sm-10">
                    <input type="textarea" class="form-control" id="approved_client" name="approved_client" placeholder="Approved Client" value="<?php echo $settings['approved_client']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="approved_coach" class="col-sm-2 col-form-label">Approved Coach</label>
                <div class="col-sm-10">
                    <input type="textarea" class="form-control" id="approved_coach" name="approved_coach" placeholder="Approved Coach" value="<?php echo $settings['approved_coach']; ?>">
                </div>
            </div>  -->
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