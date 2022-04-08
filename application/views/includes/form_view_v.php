<?php $base_url = base_url();
if (!empty($action_mode)) {
	$actionMode = $action_mode;
}
?>
<!-- rich text editor library -->
<link href='<?php echo $base_url ?>css/jquery.cleditor.css' rel='stylesheet' media="none" onload="if(media!='all')media='all'">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open($action); ?>
            <?php echo implode( ' ', $controls ); ?>
			<?php if( ! empty($actionMode) AND strtolower($actionMode) == "edit" AND ! empty( $tableHeader ) ) { ?>
            	<div class="box-content edit">
					<br><br>
					<fieldset>
						<table class="table row-bordered hover datatable" id="dataEmployee" cellspacing="0" width="100%">
							<thead>
								<tr>
									<?php echo '<th>', implode( '</th><th>', $tableHeader ), '</th>'; ?>
									<th>Actions</th>
								</tr>
							</thead>
		
							<tbody>
								<?php foreach($tableBody as $row) :
									$newRow = array_values( $row );
									
									$pkey = array_shift( $newRow );
									$customUrl = $tableEditUrl;
									//$customUrl = site_url( $tableEditUrl . '/' . $pkey . '/' . $parentId);
									if($tableEditUrl != '#') {
										$customUrl = site_url( $tableEditUrl . '/' . $pkey . '/' . $parentId.'/'.$saveAddupdate);
									} ?>
								<tr style="cursor: pointer;" id="itemTable_<?php echo $pkey; ?>">
									<?php 
									echo '<td>', implode( '</td><td>', $newRow ), '</td>'; ?>
									<td>
										<a href="<?php echo $customUrl;?>" data-id="<?php echo $pkey; ?>" id="editChildItem">
											<span title="Edit" class="icon icon-color icon-edit"></span>  
										</a>
										<a  href="<?php echo site_url( $tableDeleteUrl . '/' . $pkey . '/' . $parentId);?>" data-id="<?php echo $pkey; ?>" id="deleteChildItem">
										   <span title="Delete" class="icon icon-color icon-trash"></span>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>						
							</tbody>
						</table>                                 
					</fieldset>   
				</div> 
            <!-- End of content -->
			<?php } ?>
			<input id="id" name="id" type="hidden" value="<?php if( ! empty( $id ) ) echo set_value('id', $id); ?>">
            <input id="site_url" name="site_url" type="hidden" value="<?php echo base_url(); ?>">

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                	<?php if( ! isset( $saveButton ) OR $saveButton !== false ) { ?>
		            	<button type="submit" id="main" class="btn btn-sm btn-primary saveButton">Save</button>
					<?php } ?>
					<?php if( ! isset( $saveAndAddButton ) OR $saveAndAddButton !== false ) { ?>
						<button type="submit" name="next" value="next" class="btn btn-sm btn-success saveAndAddButton">Save And Add</button>
					<?php } ?>
					
					<?php if( ! empty( $cancel_url ) ) {
						echo anchor( $cancel_url, 'Cancel', array('class'=>'btn btn-sm btn-primary cancelButton', 'role'=>'button'));
					} ?>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->