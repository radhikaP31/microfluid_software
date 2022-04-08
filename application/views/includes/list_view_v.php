<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?php foreach( $tableActions as $tableAction ) { ?>
                 <div style="margin-right:10px;float:right">
                    <a href="<?php echo $tableAction['url'] ?>" onclick="<?php echo (empty($tableAction['click'])? '#': $tableAction['click'] ) ?>" tooltip="<?php echo $tableAction['title'] ?>" flow="down"><span style="margin: 2px;"></span> <i class="<?php echo $tableAction['icon'] ?>" aria-hidden="true"></i></a>
                </div>
                <?php } ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add New Menu</a>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php echo '<th>', implode( '</th><th>', $tableHeader ), '</th>'; ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    foreach($tableBody as $row) {
                        $newRow = array_values( $row );
                        $pkey = array_shift( $newRow );
                        $customUrl = $tableEditUrl;
                        if($tableEditUrl != '#') {
                            $customUrl = site_url( $tableEditUrl . '/' . $pkey);
                        } ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <?php 
                           // var_dump($pkey );die;
                            echo '<td>', implode( '</td><td>', $newRow ), '</td>'; ?>
                            <td>
                                <a href="<?php echo $customUrl;?>" class="fa fa-edit" title="Edit"></a>
                                <a href="<?php echo site_url( $tableDeleteUrl.'/'.$pkey);?>" class="fa fa-trash" data-toggle="modal" data-target="#deleteMenu" title="Delete"></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete <?= $m['menu']; ?> menu?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('menu/deletemenu/') . $m['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>