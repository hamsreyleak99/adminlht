{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h2 class="modal-title" id="myModalLabel" style="color: blue;">Add New Employee</h2>
			</div>
			<div class="modal-body">
				<form method="POST" 
					id="frmEmployee" 
					name="frmEmployee" 
					enctype="multipart/form-data"
					action="{{ url(''). "/employee" }}">
					{{ csrf_field() }}
					<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
					<div class="bootstrap-iso">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<form method="post">
										<div class="form-group ">
											<label class="control-label requiredField" for="firstName">
												First Name
												<span class="asteriskField">
													*
												</span>
											</label>
											<input class="form-control" id="firstName" name="firstName" type="text"/>
										</div>
										<div class="form-group ">
											<label class="control-label requiredField" for="lastName">
												Last Name
												<span class="asteriskField">
													*
												</span>
											</label>
											<input class="form-control" id="lastName" name="lastName" type="text"/>
										</div>
										<div class="form-group">
											<label class="control-label" for="image">Image</label>
											<input class="form-control" type="file" name="image" id="image">
										</div>
										<div class="form-group ">
											<label class="control-label requiredField" for="gender">
												Gender
												<span class="asteriskField">
													*
												</span>
											</label>
											<select class="select form-control" id="gender" name="gender">
												<option selected="selected" value="">
												</option>
												<option value="Male">
													Male
												</option>
												<option value="Female">
													Female
												</option>
											</select>
										</div>
										<div class="form-group ">
											<label class="control-label " for="phone">
												Telephone #
											</label>
											<input class="form-control" id="phone" name="phone" type="text"/>
										</div>
										<div class="form-group ">
											<label class="control-label " for="email">
												Email
											</label>
											<input class="form-control" id="email" name="email" type="text"/>
										</div>
										<div class="form-group ">
											<label class="control-label " for="address">
												Address
											</label>
											<textarea class="form-control" cols="40" id="address" name="address" rows="5"></textarea>
										</div>
										<div class="form-group ">
											<label class="control-label requiredField" for="detial">
												Description
												<span class="asteriskField">
													*
												</span>
											</label>
											<textarea class="form-control" cols="40" id="detial" name="detial" rows="5"></textarea>
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
												<button type="submit" class="btn btn-primary save" id="btn-add" value="add">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
</div>