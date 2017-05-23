@extends('layouts.app')

@section('after_styles')

	<style>
	    .bootstrap-iso .formden_header h2, 
	    .bootstrap-iso .formden_header p, 
	    .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; 
	      color: black}.bootstrap-iso form button, 
	    .bootstrap-iso form button:hover{color: white !important;} 
	    .asteriskField{color: red;}
  	</style>

@endsection

@section('header')
<section class="content-header">
	<h1>Setup Group Company</h1>
	<ol class="breadcrumb">
		<li class="active">{{ config('app.name') }}</li>
		<li class="active">Setup Group Company</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<div class="box-title">
					{{-- add button --}}
					<button class="btn btn-primary pull-left" id="add-new" name="add-new">
						<span class="glyphicon glyphicon-plus"></span>Add New Company
					</button>
					{{-- ===========include modal========== --}}
					@include('pages.company.modalcompany')

					<div class="title-left">
						<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
							<div class="input-group">
								<input type="text"  style="border-radius: 5px;" class="form-control" placeholder="Search for...">
								<span class="input-group-btn">
									<button class="btn btn-default" id="search" name="search"><span class="glyphicon glyphicon-search"></span></button>
								</span>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>							
							<th class="text-center">Company Name</th>
							<th class="text-center">Logo</th>
							<th class="text-center">description</th>
							<th class="text-center">status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="company-table" name="company-table">
						@foreach($datas as $row)
						<tr id="company{{$row->id}}" class="company{{ $row->id_table }}">
							<td class="text-center">{{$row->company_name}}</td>
							<td class="text-center"><img src="{{url("/uploads/images/",$row->image)}}" style="height: 50; width: 50px;"></td>
							<td class="text-center">{{$row->description}}</td>
							<td class="text-center">{{$row->status}}</td>
							<td class="text-center">
								<button class="edit_data btn btn-info open-modal" id="edit-modal" value="{{$row->id}}">
									<span class="glyphicon glyphicon-edit">edit</span>
								</button>
								<button class="btn btn-danger delete-company" value="{{$row->id_table}}">
									<span class="glyphicon glyphicon-trash">delete</span>
								</button>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>

		{{ $datas->links() }}
	</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@stop

@section('after_scripts')

<script type="text/javascript">
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	var url ="{{ url(''). "/company"}}";
	// display modal
	$('#add-new').click(function(){
		$('.modal-title').text("Add New Company");
		$('.save').text("Save");
		$("#frmcompany").attr('method', 'POST');
        $("#frmcompany").attr('action', "{{ url(''). "/company" }}" );
		$('#btn-save').val("add");
		$('#frmcompany').trigger("reset");
		$('#myModal').modal('show');
	});
	
	//display modal form for product editing
	//// ==============Open modal with class==============
	$(document).on('click','.open-modal',function(){
		$('.modal-title').text('Update Company');
		$('.save').text("Update");
		var id = $(this).val();
		console.log(id);
        $("#frmcompany").attr('method', 'POST');
        $("#frmcompany").attr('action', url + '/' + id );
        $.get(url + '/' + id, function (data) {
            //success data
            console.log(data);
            $('#article_id').val(data.article_id);
            $('#company_name').val(data.company_name);
            $('#description').val(data.description);
            $('#status').val(data.status);
              
            $('#myModal').modal('show');
        });
	});
	
    //delete company and remove it from list
    $(document).on('click','.delete-company',function(){

    	if(confirm("Are you sure you want to delete this?")){
    		var id = $(this).val();
    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    			}
    		})
    		$.ajax({
    			type: "DELETE",
    			url: url + '/' + id,
    			success: function (data) {
    				console.log(data);
    				$(".company" + id).remove();
    			},
    			error: function (data) {
    				console.log('Error:', data);
    			}
    		});

    	}else{
    		return false;
    	}

    });

    // form validation
    
    $(document).ready(function(){
    	$('#frmcompany').formValidation({
    		framework: 'bootstrap',
    		excluded: 'disabled',
    		fields: {
    			company_name: {
    				validators: {
    					notEmpty: {
    						message: 'The company name is required'
    					}
    				}
    			}
    		}
    	});
    });

</script>

@stop