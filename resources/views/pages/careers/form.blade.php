@section('after-styles')
	<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

@stop

<div class="container" id="form" style="display: none;>
	<form class="frmCareerr" method="POST" action="{{ url(''). '/career' }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="bootstrap-iso">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="image">Image</label>
							<input type="file" class="form-control" name="image" id="image" style="border-radius: 5px">
						</div>
						<div class="form-group ">
							<label class="control-label requiredField" for="job_title">
								Job Title
								<span class="asteriskField">
									*
								</span>
							</label>
							<input class="form-control" id="job_title" name="job_title" type="text"/>
						</div>
						<div class="form-group ">
							<label class="control-label requiredField" for="job_des_and_req">
								Job Description and Job Requirement
							</label>
							<textarea name="job_des_and_req" id="job_des_and_req" class="form-control my-editor"></textarea>
						</div>
						<div class="form-group ">
							<label class="control-label requiredField" for="post_date">
								Post Date
								<span class="asteriskField">
									*
								</span>
							</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="post_date" name="post_date" placeholder="YYYY/MM/DD" type="text"/>
							</div>
						</div>
						<div class="form-group ">
							<label class="control-label requiredField" for="close_date">
								Close Date
								<span class="asteriskField">
									*
								</span>
							</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="close_date" name="close_date" placeholder="YYYY/MM/DD" type="text"/>
							</div>
						</div>
						<div class="form-group ">
							<label class="control-label " for="status">
								Status
							</label>
							<select class="select form-control" id="status" name="status">
								<option value="Enabled">
									Enabled
								</option>
								<option value="Disabled">
									Disabled
								</option>
							</select>
						</div>
						<div class="form-group">
							<div>
						       <button class="btn btn-primary " name="submit" type="submit">
						        Submit
						       </button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
