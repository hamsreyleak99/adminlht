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
            // var crudServiceBaseUrl = "{{ url(' ') }}",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url: crudBaseUrl + "/article/get",
                            type:"GET",
                            dataType: "json"
                        },
                        update: {
                            url: crudBaseUrl + "/article/update",
                            type:"POST",
                            dataType: "json"
                        },
                        destroy: {
                            url: crudBaseUrl + "/article/destroy",
                            type:"POST",
                            dataType: "json"
                        },
                        create: {
                            url: crudBaseUrl + "/article/store",
                            type:"POST",
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
                        id: "id",
                        fields: {
                          id: { editable: false, nullable: true },
                          name: { type: "string" },  
                          description: { type: "string", nullable: true },
                          status: { type: "string", defaultValue: "Enabled" }                      
                        }
                      }
                    }
                  });

      $("#grid").kendoGrid({
        dataSource: dataSource,
        navigatable: true,
        resizable: true,
        reorderable: true,
        columnMenu: true,
        filterable: true,
        sortable: { mode: "single", allowUnsort: false },
        pageable: { refresh: true, pageSizes: true, buttonCount: 5 },
        height: 550,
        toolbar: [ 
          { name: "create", text: "Add New Article" }, 
        ],
        columns: [
          { field: "name", title: " Name" },
          { field: "description", title: " Description" },
          { field: "status", title: "Status", values: statusDataSource },
          { command: ["edit", "destroy"], title: "&nbsp;Action", menu: false }
        ],
        // editable:{ mode: "popup", window: { width: "600px" }, template: kendo.template($("#popup-editor-type").html()) },
        edit: function (e) {
          //Customize popup title and button label 
          if (e.model.isNew()) {
            e.container.data("kendoWindow").title('Add New Article');
            $(".k-grid-update").html('<span class="k-icon k-i-check"></span>Save');
          }
          else {
            e.container.data("kendoWindow").title('Edit Article');
          }
          /*Initialize status dropdownlist*/
          initStatusDropDownList();
        }  
      });

    });
  </script>   

@endsection


    