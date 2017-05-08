@extends('layouts.app')

@section('after_styles')

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
				@include('pages.careers.table')
				@include('pages.careers.form')
			</div>
		</div>
	</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('after_scripts')
<script type="text/javascript">

	$('#add-new').click(function() {
		$('#table').attr('style', 'display:none');
		$('#add-new').attr('style', 'display:none');
		$('#search').attr('style', 'display:none');
		$('#h1').toggleClass("show");
		$("#form").toggleClass("show");
		
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
    @stop