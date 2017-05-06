{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Employee</h4>
			</div>
			<div class="modal-body">
				<form method="POST" 
					id="frmEmployee" 
					name="frmEmployee" 
					enctype="multipart/form-data"
					action="{{ url(''). "/employee" }}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-12">
							<div class="form-group error">
								
				            <label for="firstName">First Name</label>
				            <input type="text" class="k-textbox" id="firstName" name="firstName" placeholder="Enter city" data-bind="value:firstName" pattern=".{0,30}" validationMessage="The postal code may not be greater than 30 characters" style="width: 100%;"/>
						        
							<label for="lastName">Last Name</label>
				            <input type="text" class="k-textbox" id="lastName" name="lastName" placeholder="Enter city" data-bind="value:lastName" pattern=".{0,30}" validationMessage="The postal code may not be greater than 30 characters" style="width: 100%;"/>

							<label for="gender">Gender</label>
          					<input id="gender" name="gender" data-bind="value:gender" required data-required-msg="The gender field is required" style="width: 100%;" />
							
					        <label for="image">Image</label>
							<input type="file" class="form-control" name="image" id="image" style="border-radius: 5px">

							<label for="phone">Phone</label>
								<input type="tel" class="k-textbox" id="phone" name="phone" data-bind="value:phone" required data-required-msg="The phone field is required"  placeholder="Enter phone number" validationMessage="Phone number format is not valid" style="width: 100%;"/>

							<label for="email">Email</label>
								<input type="email" class="k-textbox" id="email" name="email" placeholder="e.g. myname@example.net" data-bind="value:email" data-email-msg="Email format is not valid" pattern=".{0,60}" validationMessage="The email may not be greater than 60 characters" style="width: 100%;"/>

							<label for="address">Address</label>
							<textarea class="k-textbox" name="address" id="address" placeholder="Enter address" data-bind="value:address" maxlength="200" style="width: 100%; height: 97px;"/></textarea> 

							<label for="detial">Detial</label>
								<textarea class="k-textbox" name="detial" id="detial" placeholder="Enter detial" data-bind="value:detial" maxlength="200" style="width: 100%; height: 97px;"/></textarea> 

							<label for="status">Status</label>
          					<input id="status" name="status" data-bind="value:status" required data-required-msg="The status field is required" style="width: 100%;" />

						    <hr/>
							<div class="form-group">
								<button type="submit" class="btn btn-primary save" id="btn-add" value="add">Save</button>
								<input type="hidden" id="employee_id" name="employee_id" value="0">
							</div>
							</div>
						</div>
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
</div>