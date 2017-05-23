@extends('layouts.app')

@section('after_styles')
	
	<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
@endsection

@section('header')
<section class="content-header">
	<h1>Event</h1>
	<ol class="breadcrumb">
		<li class="active">{{ config('app.name') }}</li>
		<li class="active">Event</li>
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
						<span class="glyphicon glyphicon-plus"></span>Add New Event
					</button>

					{{-- ===========include modal========== --}}
					@include('pages.events.modalEvent')

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
							
							<th class="text-center">Event Title</th>
							<th class="text-center">Image</th>
							<th class="text-center">Description</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody >
						@foreach($datas as $row)
						<tr id="event{{$row->id}}" class="event{{ $row->id_table }}">
							
							<td class="text-center">{{$row->title}}</td>
							<td class="text-center">{{$row->image}}</td>
							<td class="text-center">{{$row->description}}</td>
							<td class="text-center">{{$row->status}}</td>
							<td class="text-center">
								<button class="edit_data btn btn-info open-modal" id="edit-modal" value="{{$row->id}}">
									<span class="glyphicon glyphicon-edit">edit</span>
								</button>
								<button class="btn btn-danger delete-event" value="{{$row->id_table}}">
									<span class="glyphicon glyphicon-trash">delete</span>
								</button>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
		{{ $datas->links() }} <!--pagination-->
	</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

@stop
@section('after_scripts')
	<script type="text/javascript">
		// display modal, reset form and change attribute form
		$('#add-new').click(function() {
			$('.save').text('Save');
			$('#frmEvent').trigger("reset");
			$("#frmEvent").attr('method', 'POST');
	      	$("#frmEvent").attr('action', "{{ url(''). "/event" }}" );
			$('#myModal').modal('show');
		});

		//display modal form for product editing
		var url = "{{ url(''). "/event" }}";
		$(document).on('click','.open-modal',function(){
			$('.save').text("Update");
			var event_id = $(this).val();

			// change url and method to route update
	        $("#frmEvent").attr('method', 'POST');
	        $("#frmEvent").attr('action', url + '/' + event_id );

	        // get data to show in modal
	        $.get(url + '/' + event_id, function (data) {
	            //success data
	            console.log(data);
	            $('#title').val(data.title);	   
	            $('#description').val(data.description);	            
	            $('#status').val(data.status);
	              
	            // show modal
        		$('#myModal').modal('show');
	        });
		});

		//delete employee and remove it from list
	    $(document).on('click','.delete-event',function(){

	    	if(confirm("Are you sure you want to delete this?")){
	    		var event_id = $(this).val();
	    		$.ajaxSetup({
	    			headers: {
	    				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	    			}
	    		})
	    		$.ajax({
	    			type: "DELETE",
	    			url: url + '/' + event_id,
	    			success: function (data) {
	    				console.log(data);
	    				$(".event" + event_id).remove();
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
	    $(document).ready(function() {
	    	$('#frmEvent').formValidation({
	    		framework: 'bootstrap',
	    		excluded: ':disabled',
	    		fields: {
	    			title: {
	    				validators: {
	    					notEmpty: {
	    						message: 'The title is required'
	    					},
	    				}
	    			},
	    			
	    		}
	    	});
	    });
	</script>

@stop