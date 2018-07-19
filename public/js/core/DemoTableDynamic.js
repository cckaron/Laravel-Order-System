(function(namespace, $) {
	"use strict";

	var DemoTableDynamic = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoTableDynamic.prototype;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initDataTables();
	};

	// =========================================================================
	// DATATABLES
	// =========================================================================

	p._initDataTables = function() {
		if (!$.isFunction($.fn.dataTable)) {
			return;
		}

		// Init the demo DataTables
		this._createDataTable1();
		this._createDataTable2();
	};

	p._createDataTable1 = function() {
		$('#datatable1').DataTable({
			"dom": 'lCfrtip',
			"order": [],
			"colVis": {
				"buttonText": "顯示/隱藏欄位",
				"overlayFade": 0,
				"align": "right"
			},
			"language": {
				"lengthMenu": '_MENU_ entries per page',
				"search": '<i class="fa fa-search"></i>',
				"paginate": {
					"previous": '<i class="fa fa-angle-left"></i>',
					"next": '<i class="fa fa-angle-right"></i>'
				},
				"info": '顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項',
				"lengthMenu": '顯示 _MENU_ 項結果',
				"zeroRecords": '沒有符合的結果',
				"infoEmpty": '顯示第 0 至 0 項結果，共0項',
				"infoFiltered": '(從 _MAX_ 項結果中過濾)',
			}
		});

		$('#datatable1 tbody').on('click', 'tr', function() {
			$(this).toggleClass('selected');
		});
	};

	p._createDataTable2 = function() {
		var table = $('#datatable2').DataTable({
			"dom": 'T<"clear">lfrtip',
			"oTableTools": {
				"sSwfPath": "http://cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
			},
			"order": [[ 0, "desc" ]],
			"language": {
				"lengthMenu": '_MENU_ entries per page',
				"search": '<i class="fa fa-search"></i>',
				"paginate": {
					"previous": '<i class="fa fa-angle-left"></i>',
					"next": '<i class="fa fa-angle-right"></i>'
				},
				"info": '顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項',
				"lengthMenu": '顯示 _MENU_ 項結果',
				"zeroRecords": '沒有符合的結果',
				"infoEmpty": '顯示第 0 至 0 項結果，共0項',
				"infoFiltered": '(從 _MAX_ 項結果中過濾)',
			},
			buttons: ['print', 'copy', 'csv', 'excel']
		});
		
		//Add event listener for opening and closing details
		var o = this;
		$('#datatable2 tbody').on('click', 'td.details-control', function() {
			var tr = $(this).closest('tr');
			var row = table.row(tr);

			if (row.child.isShown()) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				// Open this row
				row.child(o._formatDetails(row.data())).show();
				tr.addClass('shown');
			}
		});
	};

	// =========================================================================
	// DETAILS
	// =========================================================================

	p._formatDetails = function(d) {
		// `d` is the original data object for the row
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
				'<tr>' +
				'<td>Full name:</td>' +
				'<td>' + d.name + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Extension number:</td>' +
				'<td>' + d.extn + '</td>' +
				'</tr>' +
				'<tr>' +
				'<td>Extra info:</td>' +
				'<td>And any further details here (images etc)...</td>' +
				'</tr>' +
				'</table>';
	};

	// =========================================================================
	namespace.DemoTableDynamic = new DemoTableDynamic;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
