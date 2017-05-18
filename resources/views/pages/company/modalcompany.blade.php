{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h2 class="modal-title" id="myModalLabel" style="color: blue;">Add New Group Company</h2>
			</div>
			<div class="modal-body">
				<form method="POST" 
					id="frmcompany" 
					name="frmcompany" 
					enctype="multipart/form-data"
					action="{{ url(''). "/company" }}">
					{{ csrf_field() }}
					<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
					<div class="bootstrap-iso">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<form method="POST" 
										id="frmcompany" 
										name="frmcompany" 
										enctype="multipart/form-data"
										action="{{ url(''). "/company" }}" >
										<div class="form-group ">
											<label class="control-label requiredField" for="company_name">
												Company Name
												<span class="asteriskField">
													*
												</span>
											</label>
											<input class="form-control" id="company_name" name="company_name" type="text"/>
										</div>
										<div class="form-group">
											<label class="control-label" for="image">Logo</label>
											<input class="form-control" type="file" name="image" id="image">
										</div>
										<div class="form-group ">
											<label class="control-label" for="description">
												Description
											</label>
											<textarea class="form-control" cols="40" id="description" name="description" rows="5"></textarea>
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