{{-- modal add new career --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h2 class="modal-title" id="myModalLabel" style="color: blue;">Add New Career</h2>
			</div>
			<div class="modal-body">
				<form method="POST" id="frmCareer" name="frmCareer" enctype="multipart/form-data" action="{{ url(''). "/career" }}">
				{{ csrf_field() }}
				<div class="bootstrap-iso">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
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
										<button class="btn btn-primary " name="submit" id="submit" type="submit">
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
		</div>
	</div>
</div>
