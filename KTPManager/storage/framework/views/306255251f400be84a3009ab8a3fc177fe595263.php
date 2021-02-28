<?php $__env->startSection('content'); ?>
<div class="container" style="max-width:100vw">
	<div class="row justify-content-center">
		<div class="col-md-11">
			<div class="card">
				<div class="card-header">
					Dashboard
					<?php $user = Auth::user(); if ($user->access_type == 1) { ?> 
					<a href="<?php echo e(url('/newKTP')); ?>"><button class="btn btn-lg float-right btn-primary">NEW ENTRY</button></a>
					<?php } ?>
				</div>
				
				<div class="card-body">
					<?php $user = Auth::user(); if ($user->access_type == 1) { ?> 
					<a class="btn btn-lg float-right btn-default" href="<?php echo e(asset(Storage::url('/template/export_template.csv'))); ?>" download>TEMPLATE CSV</a>
					<form action="<?php echo e(url('/ie/icsv')); ?>" id="formImportCSV" method="POST"  enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
						<label for="CSVImport" class="btn btn-lg float-right btn-secondary">IMPORT CSV</label> &nbsp;
						<input type="file" name="csvimport" id="CSVImport" accept=".csv" hidden>
					</form>
					
					<?php } ?>
					<a href="<?php echo e(url('/ie/epdf')); ?>" class="btn btn-lg float-left btn-danger" target='_blank'>DOWNLOAD PDF</a>
					<a href="<?php echo e(url('/ie/ecsv')); ?>" class="btn btn-lg float-left btn-success" target='_blank'>DOWNLOAD CSV</a>
					<br><br><br>
					<table class="datatableNull">
						<thead>
							<tr>
								<th>NO</th>
								<th>NIK</th>
								<th>NAMA</th>
								<th>ALAMAT</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php $num=0; foreach ($ktpData as $key => $kd) { $num++;?>
							<tr>
								<td><?= $num ?></td>
								<td><?= sprintf("%016d",$kd->id) ?></td>
								<td><?= $kd->nama ?></td>
								<td><?= $kd->alamat ?></td>
								<td>
									<a href="<?php echo e(url('/detailKTP/'.$kd->id)); ?>" target="_blank" class="btn btn-sm btn-secondary btnMonitorUser" title="DETAIL KTP">&#9783;</a>
									<?php $user = Auth::user(); if ($user->access_type == 1) { ?> 
									<a href="<?php echo e(url('/editKTP/'.$kd->id)); ?>" class="btn btn-sm btn-info btnMonitorUser" title="EDIT KTP">&#9998;</a>
									<button kid="<?= $kd->id ?>" knm="<?= $kd->nama ?>" class="btn btn-sm btn-danger btnDeleteKtp" title="DELETE KTP">&#9949;</button>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<br>
					<div class="float-right"><?php echo e($ktpData->links()); ?></div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo e(asset('js/ktp.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>