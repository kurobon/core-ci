<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript" class="init">
	jQuery(document).ready(function() { 
		var TableAjax = function () {

			var handleRecords = function () {

				var grid = new Datatable();

				grid.init({
					src: $("#datatable_ajax"),
					onSuccess: function (grid) {
						// execute some code after table records loaded
					},
					onError: function (grid) {
						// execute some code on network or other general error  
					},
					onDataLoad: function(grid) {
						// execute some code on ajax data load
					},
					loadingMessage: 'Loading...',
					dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

						// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
						// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
						// So when dropdowns used the scrollable div should be removed. 
						//"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
						
						//"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
						"lengthMenu": [
							[10, 20, 50, 100, 150, -1],
							[10, 20, 50, 100, 150, "All"] // change per page values here
						],
						
						"pageLength": 10, // default record count per page
						"ajax": {
							"url": "<?php echo site_url( $module . '/ajax/datatables');?>", // ajax source
						},
						"order": [
							[1, "asc"]
						], // set first column as a default sort by asc
						"aoColumnDefs": [
								  {
									 bSortable: false,
									 aTargets: [ 0, -1 ]
								  }
								],
					}
				});

				// handle group actionsubmit button click
				grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
					e.preventDefault();
					var action = $(".table-group-action-input", grid.getTableWrapper());
					if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
						grid.setAjaxParam("customActionType", "group_action");
						grid.setAjaxParam("customActionName", action.val());
						grid.setAjaxParam("id", grid.getSelectedRows());
						grid.getDataTable().ajax.reload();
						grid.clearAjaxParams();
					} else if (action.val() == "") {
						Metronic.alert({
							type: 'danger',
							icon: 'warning',
							message: 'Silahkan pilih aksi',
							container: grid.getTableWrapper(),
							place: 'prepend'
						});
					} else if (grid.getSelectedRowsCount() === 0) {
						Metronic.alert({
							type: 'danger',
							icon: 'warning',
							message: 'Belum ada data yang dipilih',
							container: grid.getTableWrapper(),
							place: 'prepend'
						});
					}
				});
			}

			return {

				//main function to initiate the module
				init: function () {
					handleRecords();
				}

			};

		}();
		
		TableAjax.init();
		
		$(document.body).on("click", "#add-btn",function(event){
			window.location.replace("<?php echo site_url($module . '/add');?>");
		});
	} );
</script>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="widget-container-col">
				<div class="widget-box widget-color-blue">
					<div class="widget-header ">
						<h5 class="widget-title bigger lighter ">
							<i class="ace-icon fa fa-table"></i>
							<span class="hidden-sm hidden-xs">Daftar Data Pengguna</span>
							<span class="hidden-md hidden-lg">Pengguna</span>
						</h5>

						<div class="widget-toolbar no-border">
							<button class="btn btn-xs btn-info bigger" data-original-title="Tambah data unit kerja." data-rel="tooltip" data-placement="bottom" id="add-btn">
								<i class="ace-icon fa fa-pencil bigger-120"></i>
								Tambah Data
							</button>
						</div>
					</div>
				</div>
			</div>
			
		<div class="table-container">
				<div class="table-actions-wrapper">
					<span>
					</span>
					<select class="table-group-action-input form-control input-inline input-small input-sm">
						<option value="">-Pilihan Aksi -</option>
						<option value="Delete">Hapus</option>
					</select>
					<button class="btn btn-sm btn-warning table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
				</div>
				<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th width="15%">
						 Username
					</th>
					<th width="18%">
						 Email
					</th>
					<th width="20%">
						 Nama
					</th>
					<th width="5%">
						 Unit
					</th>
					<th width="5%">
						 Role
					</th>
					<th width="25%">
						 User Grup
					</th>
					<th width="5%">
						 Banned?
					</th>
					<th width="5%">
						 Action
					</th>
				</tr>
				<tr role="row" class="filter">
					<td></td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_userName">
					</td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_userEmail">
					</td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_UserRealName">
					</td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_unitUser">
					</td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_roleNama">
					</td>
					<td>
						<input type="text" class="form-control form-filter input-sm" name="search_GroupName">
					</td>
					<td>
						<select class="form-control form-filter input-sm" name="search_UserBanned">
							<option value=""></option>
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</td>
					<td>
						<div class="margin-bottom-5">
							<button class="btn btn-sm btn-info filter-submit margin-bottom"><i class="fa fa-search"></i> Search</button>
						</div>
						<button class="btn btn-sm btn-danger filter-cancel"><i class="fa fa-times"></i> Reset</button>
					</td>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
		<!-- End: life time stats -->
	</div>
</div>