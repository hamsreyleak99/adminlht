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
					<button type="button" id="add-new" name="add-new" class="btn btn-primary pull-left" >
						<span class="glyphicon glyphicon-plus"></span>Add New Employee
					</button>

					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Modal Header</h4>
								</div>
								<div class="modal-body">
									<form 
										method="POST" 
										id="frmEmployee" 
										name="frmEmployee" 
										enctype="multipart/form-data"
										action="{{ url(''). "/store" }}">
										{{ csrf_field() }}
										<label> First Name</label>
										<input type="text" name="firstName" id="firstName">
										<label>Image</label>
										<input type="file" name="image" id="image">
										<input type="submit" class="btn btn-primary" value="Save">
									
									</form> 
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
					{{-- Modal --}}

				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('after_scripts')

	<script type="text/javascript">
		$('#add-new').click(function(){
			$('#btn-save').val("add");
			$('#frmemployees').trigger("reset");
			$('#myModal').modal('show');
		});
		// submit form
		var form = $('form')[0]; 
		var request = new XMLHttpRequest();
		form.addEventListener('submit', function(e){
			e.preventDefault();

			var formData = new FormData(form);
			console.log(formData);
			request.open('post', 'submit');
			request.send(formData);
		});
	</script>
@stop