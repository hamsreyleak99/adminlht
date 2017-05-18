@extends('layouts.app')

@section('after_styles')
  <style>
    .bootstrap-iso .formden_header h2, 
    .bootstrap-iso .formden_header p, 
    .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; 
      color: black}.bootstrap-iso form button, 
            .bootstrap-iso form button:hover{color: white !important;} 
            .asteriskField{color: red;}
  </style>
@endsection

@section('header')
  <section class="content-header">
    <h1>Article</h1>
    <ol class="breadcrumb">
      <li class="active">{{ config('app.name') }}</li>
      <li class="active">Article</li>
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
           {{--  <button class="btn btn-primary pull-left" id="add-new" name="add-new">
              <span class="glyphicon glyphicon-plus"></span>Add New Article
            </button> --}}
            {{-- ===========include modal========== --}}
            @include('pages.articles.modalarticle')

          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>              
                <th class="text-center">Name</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="article-table" name="article-table">
              @foreach($datas as $row)
              <tr id="article{{$row->id}}">
                <td class="text-center">{{$row->name}}</td>
                <td class="text-center">{{$row->status}}</td>
                <td class="text-center">
                  <button class="edit_data btn btn-info open-modal" id="edit-modal" value="{{$row->id}}">
                    <span class="glyphicon glyphicon-edit">edit</span>
                  </button>
                  <button class="btn btn-danger delete-article" value="{{$row->id}}">
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
  <meta name="_token" content="{!! csrf_token() !!}" />
@stop

@section('after_scripts')

  <script type="text/javascript">
   
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    })
    var url ="{{ url(''). "/article"}}";
    // display modal
    // $('#add-new').click(function(){
    //   $('.save').text("Save");
    //   $("#frmEmployee").attr('method', 'POST');
    //       $("#frmEmployee").attr('action', "{{ url(''). "/article" }}" );
    //   $('#btn-save').val("add");
    //   $('#frmEmployee').trigger("reset");
    //   $('#myModal').modal('show');
    // });
    
    //display modal form for product editing
    //// ==============Open modal with class==============
    $(document).on('click','.open-modal',function(){
      $('.save').text("Update");
      var id = $(this).val();
      console.log(id);

          $("#frmArticle").attr('method', 'POST');
          $("#frmArticle").attr('action', url + '/' + id );
          $.get(url + '/' + id, function (data) {
              //success data
              console.log(data);
              $('#name').val(data.name);
              $('#description').val(data.description);
              $('#status').val(data.status);
              $('#myModal').modal('show');
          });
    });
    // ==============Open modal with id==============
      //delete article and remove it from list
      $(document).on('click','.delete-article',function(){

        if(confirm("Are you sure you want to delete this?")){
          var id = $(this).val();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
          })
          $.ajax({
            type: "DELETE",
            url: url + '/' + id,
            success: function (data) {
              console.log(data);
              $("#article" + id).remove();
            },
            error: function (data) {
              console.log('Error:', data);
            }
          });

        }else{
          return false;
        }
      });
  </script>

@stop

    