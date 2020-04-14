<script type="text/javascript">	
	$(function()
	{
		var keyword = <?= $keyword?> ;
		$( "#cari" ).autocomplete(
		{
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Kotak Pesan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Kotak Pesan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<?php $this->load->view('mailbox/menu_mailbox') ?>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url('mailbox/form') ?>" class="btn btn-social btn-flat btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tulis Pesan"><i class="fa fa-plus"></i> Tulis Pesan</a>
							<a href="#confirm-delete" title="Arsipkan Data" <?php if(!$filter_status) : ?>onclick="deleteAllBox('mainform','<?=site_url("mailbox/archive_all")?>')"<?php endif ?> class="btn btn-social btn-flat btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih" <?php $filter_status and print('disabled') ?>><i class='fa fa-file-archive-o'></i> Arsipkan Data Terpilih</a>
							<a href="<?= site_url("mailbox/clear/$kat/$p/$o") ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan Filter</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="row">
												<div class="col-sm-9">
													<div class="form-group">
														<select class="form-control input-sm select2-nik-ajax" id="nik" style="width:100%" name="nik" data-url="<?= site_url('mailbox/list_pendaftar_mandiri_ajax')?>" onchange="formAction('mainform', '<?=site_url("mailbox/filter_nik/$kat")?>')">
															<option value="">Semua Pendaftar Layanan Mandiri</option>
															<option value="<?= $individu['nik']?>" <?php selected($filter_nik, $individu['nik']); ?>><?= $individu['nik'] .' - '.$individu['nama']?></option>
														</select>
													</div>
													<div class="form-group">
														<select class="form-control input-sm " name="filter" onchange="formAction('mainform','<?=site_url("mailbox/filter/$kat")?>')">
															<option value="">Semua</option>
															<?php if($kat != 2) : ?>
															<option value="1" <?php selected($filter, 1); ?>>Sudah Dibaca</option>
															<option value="2" <?php selected($filter, 2); ?>>Belum Dibaca</option>
															<?php endif;?>
															<option value="3" <?php selected($filter, 3); ?>>Diarsipkan</option>
														</select>
													</div>						
												</div>
												<div class="col-sm-3">
													<div class="box-tools">
														<div class="input-group input-group-sm pull-right">
															<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action','<?=site_url("mailbox/search/$kat")?>');$('#'+'mainform').submit();endif;">
															<div class="input-group-btn">
																<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?=site_url("mailbox/search/$kat")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<table class="table table-bordered table-striped dataTable table-hover">
															<thead class="bg-gray disabled color-palette">
																<tr>
																	<th><input type="checkbox" id="checkall"/></th>
																	<th>No</th>
																	<th>Aksi</th>
																	<?php if($kat == 2) : ?>
																		<?php if ($o==2): ?>
																			<th><a href="<?= site_url("mailbox/index/$kat/$p/1")?>">Pengirim <i class='fa fa-sort-asc fa-sm'></i></a></th>
																		<?php elseif ($o==1): ?>
																			<th><a href="<?= site_url("mailbox/index/$kat/$p/2")?>">Pengirim <i class='fa fa-sort-desc fa-sm'></i></a></th>
																		<?php else: ?>
																			<th><a href="<?= site_url("mailbox/index/$kat/$p/1")?>">Pengirim <i class='fa fa-sort fa-sm'></i></a></th>
																		<?php endif; ?>
																	<?php endif; ?>
																	<?php if ($o==4): ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/3")?>"><?= $owner ?> <i class='fa fa-sort-asc fa-sm'></i></a></th>
																	<?php elseif ($o==3): ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/4")?>"><?= $owner ?> <i class='fa fa-sort-desc fa-sm'></i></a></th>
																	<?php else: ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/3")?>"><?= $owner ?> <i class='fa fa-sort fa-sm'></i></a></th>
																	<?php endif; ?>
																	<th>Subjek Pesan</th>
																	<?php if($kat != 2) : ?>
																		<?php if ($o==6): ?>
																			<th nowrap><a href="<?= site_url("mailbox/index/$kat/$p/5")?>">Status Pesan <i class='fa fa-sort-asc fa-sm'></i></a></th>
																		<?php elseif ($o==5): ?>
																			<th nowrap><a href="<?= site_url("mailbox/index/$kat/$p/6")?>">Status Pesan <i class='fa fa-sort-desc fa-sm'></i></a></th>
																		<?php else: ?>
																			<th nowrap><a href="<?= site_url("mailbox/index/$kat/$p/5")?>">Status Pesan <i class='fa fa-sort fa-sm'></i></a></th>
																		<?php endif; ?>
																	<?php endif; ?>
																	<?php if ($o==8): ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/7")?>">Dikirimkan Pada <i class='fa fa-sort-asc fa-sm'></i></a></th>
																	<?php elseif ($o==7): ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/8")?>">Dikirimkan Pada <i class='fa fa-sort-desc fa-sm'></i></a></th>
																	<?php else: ?>
																		<th><a href="<?= site_url("mailbox/index/$kat/$p/7")?>">Dikirimkan Pada <i class='fa fa-sort fa-sm'></i></a></th>
																	<?php endif; ?>
																</tr>
															</thead>
															<tbody>
															<?php foreach ($main as $data): ?>
																<tr <?php if ($data['baca']!=1 AND $kat !=2): ?>style='background-color:#ffeeaa;'<?php endif; ?>>
																	<td><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" /></td>
																	<td><?=$data['no']?></td>
																	<td nowrap>
																	<?php if($data['status'] == 0) : ?>
																		<a href="#" data-href="<?=site_url("mailbox/archive/$data[id]")?>" class="btn bg-maroon btn-flat btn-sm"  title="Arsipkan" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-file-archive-o"></i></a>
																	<?php endif ?>
																		<a href="<?=site_url("mailbox/baca_pesan/{$kat}/{$data['id']}")?>" class="btn bg-navy btn-flat btn-sm" title="Lihat detail pesan"><i class="fa fa-list">&nbsp;</i></a>
																	<?php if($kat != 2 AND $data['status'] == 0) : ?>
																		<?php if ($data['baca'] == 1): ?>
																			<a href="<?=site_url('mailbox/baca/'.$data['id'].'/2')?>" class="btn bg-navy btn-flat btn-sm" title="Tandai sebagai belum dibaca"><i class="fa fa-envelope-o"></i></a>
																		<?php else : ?>
																			<a href="<?=site_url('mailbox/baca/'.$data['id'].'/1')?>" class="btn bg-navy btn-flat btn-sm" title="Tandai sebagai sudah dibaca"><i class="fa fa-envelope-open-o"></i></a>
																		<?php endif; ?>
																	<?php endif ?>
																	</td>
																	<?php if($kat == 2 AND $_SESSION['grup'] == 1) : ?>
																		<td nowrap><?=$data['nama_user']?></td>
																	<?php endif ?>
																	<td nowrap>
																		<?=$data['nik']?> | 
																		<?php if($data['tipe'] == 1) : ?> 
																			<?=$data['nama']?>
																		<?php else : ?>
																			<?=$data['nama']?>
																		<?php endif ?>
																	</td>
																	<td width="40%"><?=$data['subjek']?></td>
																	<?php if($kat !=2) : ?> 
																	<td nowrap><?=$data['baca'] == 1 ? 'Sudah Dibaca' : 'Belum Dibaca' ?></td>
																	<?php endif ?>
																	<td nowrap><?=tgl_indo2($data['created_at'])?></td>
																</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</form>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="dataTables_length">
                          <form id="paging" action="<?= site_url("mailbox/index/$kat")?>" method="post" class="form-horizontal">
                            <label>
                              Tampilkan
                              <select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
                                <option value="20" <?php selected($per_page, 20); ?> >20</option>
                                <option value="50" <?php selected($per_page, 50); ?> >50</option>
                                <option value="100" <?php selected($per_page, 100); ?> >100</option>
                              </select>
                              Dari
                              <strong><?= $paging->num_rows?></strong>
                              Total Data
                            </label>
                          </form>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers">
                          <ul class="pagination">
                            <?php if ($paging->start_link): ?>
                              <li><a href="<?=site_url("mailbox/index/$kat/$paging->start_link/$o")?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
                            <?php endif; ?>
                            <?php if ($paging->prev): ?>
                              <li><a href="<?=site_url("mailbox/index/$kat/$paging->prev/$o")?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <?php endif; ?>
                            <?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
                              <li <?=jecho($p, $i, "class='active'")?>><a href="<?= site_url("mailbox/index/$i/$o")?>"><?= $i?></a></li>
                            <?php endfor; ?>
                            <?php if ($paging->next): ?>
                              <li><a href="<?=site_url("mailbox/index/$kat/$paging->next/$o")?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                            <?php endif; ?>
                            <?php if ($paging->end_link): ?>
                              <li><a href="<?=site_url("mailbox/index/$kat/$paging->end_link/$o")?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
                            <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
									</div>
								</div>
							</div>
							<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-dialog'>
									<div class='modal-content'>
										<div class='modal-header'>
											<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
											<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
										</div>
										<div class='modal-body btn-info'>
											Apakah Anda yakin ingin mengarsipkan data ini?
										</div>
										<div class='modal-footer'>
											<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
											<a class='btn-ok'>
												<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-file-archive-o'></i> Arsipkan</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>