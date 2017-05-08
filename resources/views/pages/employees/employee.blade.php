@extends('layouts.app')

@section('after_styles')

@endsection

@section('header')
<section class="content-header">
	<h1>Employee</h1>
	<ol class="breadcrumb">
		<li class="active">{{ config('app.name') }}</li>
		<li class="active">Employee</li>
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
						<span class="glyphicon glyphicon-plus"></span>Add New Student
					</button>

					{{-- ===========include modal========== --}}
					@include('pages.employees.modalEmployee')

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
							<th class="text-center">First Name</th>
							<th class="text-center">Last Name</th>
							<th class="text-center">Gender</th>
							<th class="text-center">image</th>
							<th class="text-center">email</th>
							<th class="text-center">status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="employee-table" name="employee-table">
						@foreach($datas as $row)
						<tr id="employee{{$row->id}}">
							<td class="text-center">{{$row->firstName}}</td>
							<td class="text-center">{{$row->lastName}}</td>
							<td class="text-center">{{$row->gender}}</td>
							<td class="text-center">{{$row->image}}</td>
							<td class="text-center">{{$row->email}}</td>
							<td class="text-center">{{$row->status}}</td>
							<td class="text-center">
								<button class="edit_data btn btn-info open-modal" id="edit-modal" value="{{$row->id}}">
									<span class="glyphicon glyphicon-edit">edit</span>
								</button>
								<button class="btn btn-danger delete-employee" value="{{$row->id}}">
									<span class="glyphicon glyphicon-trash">delete</span>
								</button>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@stop

@section('after_scripts')

<script type="text/javascript">
	initStatusDropDownList();
	initGenderDropDownList();
	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	var url ="{{ url(''). "/employee"}}";
	// display modal
	$('#add-new').click(function(){
		$('.save').text("Save");
		$("#frmEmployee").attr('method', 'POST');
        $("#frmEmployee").attr('action', "{{ url(''). "/employee" }}" );
		$('#btn-save').val("add");
		$('#frmEmployee').trigger("reset");
		$('#myModal').modal('show');
	});
	
	//display modal form for product editing
	//// ==============Open modal with class==============
	$(document).on('click','.open-modal',function(){
		$('.save').text("Update");
		var employee_id = $(this).val();

        $("#frmEmployee").attr('method', 'POST');
        $("#frmEmployee").attr('action', url + '/' + employee_id );
        $.get(url + '/' + employee_id, function (data) {
            //success data
            console.log(data);
            $('#firstName').val(data.firstName);
            $('#lastName').val(data.lastName);
            $('#gender').val(data.gender);
            $('#phone').val(data.phone);
            $('#email').val(data.email);
            $('#address').val(data.address);
            $('#detial').val(data.detial);
            $('#status').val(data.status);
              
            $('#myModal').modal('show');
        });
	});
	// ==============Open modal with id==============
	// $('#edit-modal').click(function(){
	// 	$('.save').text("Update");
	// 	var employee_id = $(this).val();

 //        $("#frmEmployee").attr('method', 'PUT');
 //        $("#frmEmployee").attr('action', "{{ url('') }}" + "/employee/" + employee_id);
	// 	$.get(url + '/' + employee_id, function (data) {
 //            //success data
 //            // console.log(data);
 //            $('#firstName').val(data.firstName);
 //            $('#lastName').val(data.lastName);
 //            $('#gender').val(data.gender);
 //            $('#phone').val(data.phone);
 //            $('#email').val(data.email);
 //            $('#address').val(data.address);
 //            $('#detial').val(data.detial);
 //            $('#status').val(data.status);
              
 //            $('#myModal').modal('show');
 //        });

	// });
    //delete employee and remove it from list
    $(document).on('click','.delete-employee',function(){

    	if(confirm("Are you sure you want to delete this?")){
    		var employee_id = $(this).val();
    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    			}
    		})
    		$.ajax({
    			type: "DELETE",
    			url: url + '/' + employee_id,
    			success: function (data) {
    				console.log(data);
    				$("#employee" + employee_id).remove();
    			},
    			error: function (data) {
    				console.log('Error:', data);
    			}
    		});

    	}else{
    		return false;
    	}

    });

</script>

@stop