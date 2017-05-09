@extends('layouts.app')

@section('after_styles')
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
@endsection

@section('header')
<section class="content-header">
	<h1>Career</h1>
	<ol class="breadcrumb">
		<li class="active">{{ config('app.name') }}</li>
		<li class="active">Career</li>
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
						<span class="glyphicon glyphicon-plus"></span>Add New Career
					</button>

					@include('pages.careers.modalCareer')

					<h1 id="h1" style="display: none;">Add New Career</h1>
					<div class="title-left " id="search">
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
				{{-- table career --}}
				<div class="table" id="table">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Job Title</th>
								<th>Post Date</th>
								<th>Close Date</th>
								<th>status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($datas as $row)
							<tr>
								<td>{{ $row->job_title }}</td>
								<td>{{ $row->post_date }}</td>
								<td>{{ $row->close_date }}</td>
								<td>{{ $row->status }}</td>
								<td>
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
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('after_scripts')
<script type="text/javascript">

	// click button add new career
	$('#add-new').click(function() {
		$('#frmCareer').trigger("reset");
		$('#myModal').modal('show');
	});

   {{-- post_date datepicker --}}
   $(document).ready(function(){
     var date_input = $('input[name="post_date"]');//our date in put has the name "post_date"
     var container = $('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent():"body";
     date_input.datepicker({
     	format: "yyyy/mm/dd",
     	container: container,
     	todayHighlight: true,
     	autoclose: true
     });
  });
   {{-- close_date datepicker --}}

   $(document).ready(function(){
     var date_input = $('input[name="close_date"]');//our date in put has the name "post_date"
     var container = $('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent():"body";
     date_input.datepicker({
     	format: "yyyy/mm/dd",
     	container: container,
     	todayHighlight: true,
     	autoclose: true
     });
  });
</script>
<script type="text/javascript">
	// ======Editor job description and requirement==========
	var editor_config = {
		path_absolute : "/",
		selector: "textarea.my-editor",
		plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern"
		],
		toolbar: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
		// toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",

		relative_urls: false,
		file_browser_callback : function(field_name, url, type, win) {
			var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
			var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

			var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
			if (type == 'image') {
				cmsURL = cmsURL + "&type=Images";
			} else {
				cmsURL = cmsURL + "&type=Files";
			}

			tinyMCE.activeEditor.windowManager.open({
				file : cmsURL,
				title : 'Filemanager',
				width : x * 0.8,
				height : y * 0.8,
				resizable : "yes",
				close_previous : "no"
			});
		}
	};

	tinymce.init(editor_config);
   // ====================================
</script>
@stop