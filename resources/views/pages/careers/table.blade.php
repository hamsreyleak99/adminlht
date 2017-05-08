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