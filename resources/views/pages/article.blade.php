@extends('layouts.app')

@section('after_styles')
  <style>
    
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
        <div class="box-body">
          <div id="grid"></div>
        </div>
      </div>
    </div>
  </div>   
@endsection
@section('after_scripts') 
    <script>
        $(document).ready(function () {
            var crudServiceBaseUrl = "{{ url('') }}",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url: crudServiceBaseUrl + "/article/get",
                            type: "GET",
                            dataType: "json"
                        },
                        update: {
                            url: crudServiceBaseUrl + "/article/update",
                            type: "POST",
                            dataType: "json"
                        },
                        destroy: {
                            url: crudServiceBaseUrl + "/article/destroy",
                            type: "POST",
                            dataType: "json"
                        },
                        create: {
                            url: crudServiceBaseUrl + "/article/store",
                            type: "POST",
                            dataType: "json"
                        },
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                return {article: kendo.stringify(options.models)};
                            }
                        }
                    },
                    batch: true,
                    pageSize: 20,
                    schema: {
                        model: {
                            id: "ID",
                            fields: {
                              id: { editable: false, nullable: true },
                              title: { type: "string" },
                              description: { type: "string" },
                              status: { field: "status", type: "string", defaultValue: "Enabled" }
                            }
                        }
                    }
                });
            $("#grid").kendoGrid({
                dataSource: gridDataSource,
                navigatable: true,
                resizable: true,
                reorderable: true,
                columnMenu: true,
                filterable: true,
                sortable: { mode: "single", allowUnsort: false },
                pageable: { refresh:true, pageSizes: true, buttonCount: 5 },
                height: 550,
                toolbar: [ 
                  { name: "create", text: "Add New Customer" },
                  { template: kendo.template($("#textbox-multi-search").html()) } 
                ],
                toolbar: ["create"],
                columns: [
                   { field:"title", title: "Title" },
                  { field: "description", title: "Description"},
                   { field: "Discontinued", width: "120px" },
                   { field: "status", title: "Status", values: statusDataSource, hidden: true },
                   { command: ["edit", "destroy"], title: "Action", menu: false }
            });
        });

    </script>
@endsection


    