<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Custom Search and Filter to DataTables Server-side Processing with PHP</title>
	<!--------------Toast message ------------->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

	<!--------------Select 2 Plugin------------->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!--------------Datatable Link------------->
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	 <!-- MDB -->
	<link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>
	 <!--------------JQUERY------------->
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
 	<style type="text/css">
 		div.dataTables_processing {
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    width: 200px;
		    margin-left: -100px;
		    margin-top: 147px;
		    text-align: center;
		    padding: 41px;
		    background: #f7f7f7;
		    color: white;
		}
 	</style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="card-title col-4 mt-1">Transaction List by Expense</h3>
                            <div class="col-6 nav justify-content-end">
	                        <div class="form-group mx-sm-3 mb-2">
	                           <button data-toggle="modal" data-target="#addModal" class="btn btn-primary">Add Product</button>
	                        </div>
                        </div>
                        <div class="col-6 nav justify-content-end" id="export_buttonscc"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
	                    <table id="load_data" class="table table-striped table-bordered responsive display no-wrap" style="width:100%">
						    <thead>
						        <tr>
						            <th>First name</th>
						            <th>Last name</th>
						            <th>Email</th>
						            <th>Gender</th>
						            <th>Country</th>
						            <th>Created</th>
						            <th>Status</th>
						        </tr>
						    </thead>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









 
 

<!--------------Toast message ------------->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!--------------Datatable Link------------->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!--------------Select 2 Plugin------------->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
	var table;
	$(document).ready(function(){
		 var status_filter = '<label style="margin-left: 10px;">: ';
	    status_filter += '<select class="gender_filter  form-control  select2">';
	    status_filter += '<option value="">--Select Gender--</option>';
	    status_filter += '<option value="Male">Male</option>';
	    status_filter += '<option value="Female">Female</option>';
	    status_filter += '</select></label>';

	     	setTimeout(() => {
		      $('.dataTables_length').append(status_filter);
		      $('.select2').select2();
		    }, 500);

			table=$('#load_data').DataTable( {
	            "searching": true,
	            "paging": true,
	            "info": false,
	            "lengthChange":true ,
	            "processing"		: true,
				"serverSide"		: true,
	            "zeroRecords":    "No matching records found",
	            "ajax"				: {
					url			: "fetchData.php",
					type		: 'GET',
				},
	            "buttons": [			
	        {
	            extend: 'copy',
	            text: '<i class="fas fa-copy"></i> Copy',
	            titleAttr: 'Copy',
	            exportOptions: { columns: ':visible' }
	        }, 
	        {
	            extend: 'excel',
	            text: '<i class="fas fa-file-excel"></i> Excel',
	            titleAttr: 'Excel',
	            exportOptions: { columns: ':visible' }
	        }, 
	        {
	            extend: 'csv',
	            text: '<i class="fas fa-file-csv"></i> CSV',
	            titleAttr: 'CSV',
	            exportOptions: { columns: ':visible' }
	        }, 
	        {
	            extend: 'pdf',
	            exportOptions: { columns: ':visible' },
	            orientation: 'landscape',
	            pageSize: "LEGAL",
	            text: '<i class="fas fa-file-pdf"></i> PDF',
	            titleAttr: 'PDF'
	        }, 
	        {
	            extend: 'print',
	            text: '<i class="fas fa-print"></i> Print',
	            titleAttr: 'Print',
	            exportOptions: { columns: ':visible' }
	        }, 
	        {
	            extend: 'colvis',
	            text: '<i class="fas fa-list"></i> Column Visibility',
	            titleAttr: 'Column Visibility'
	        }
	        ],
	    });
			table.buttons().container().appendTo($('#export_buttonscc'));	
	});


	/*--------------Filter Script------------------------------------*/
   
    // Product filter change event
    $(document).on('change','.gender_filter',function(){
      
        var gender_filter_result = $('.gender_filter').val() == null ? '' : $('.gender_filter').val();

        table.columns(3).search(gender_filter_result).draw();
        
    });
	
</script>

</body>
</html>