@extends('layouts.app')

@section('after_styles')
  <style>
    
  </style>

@endsection

@section('header')
  <section class="content-header">
    <h1>Employee</h1>
    <ol class="breadcrumb">
      <li class="active">{{ config('app.name') }}</li>
      <li class="active">Employee</li>
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
      var dataSource = new kendo.data.DataSource({
        transport: {
          read:  {
            url: crudServiceBaseUrl + "/employee/get",
            type: "GET",
            dataType: "json"
          },
          update: {
            url: crudServiceBaseUrl + "/employee/update",
            type: "Post",
            dataType: "json"
          },
          destroy: {
            url: crudServiceBaseUrl + "/employee/destroy",
            type: "Post",
            dataType: "json"
          },
          create: {
            url: crudServiceBaseUrl + "/employee/store",
            type: "Post",
            dataType: "json"
          },
          parameterMap: function(options, operation) {
            if (operation !== "read" && options.models) {
              return {employees: kendo.stringify(options.models)};
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
              firstName: { type: "string" },
              lastName: { type: "string" },
              image: { type: "string" },
              phone:{ type: "string" },
              
              description: { type: "string", nullable: true }, 
              status: { type: "string", defaultValue: "Enabled" }  
            }
          }
        }
      });

      $("#grid").kendoGrid({
        dataSource: dataSource,
        navigatable: true,
        reorderable: true,
        resizable: true,
        columnMenu: true,
        filterable: true,
        sortable: { mode: "single", allowUnsort: false },
        pageable: { refresh: true, pageSizes: true, buttonCount: 5 },
        height: 550,
        toolbar: [ 
          { name: "create", text: "Add New Employee Type" }, 
          { template: kendo.template($("#textbox-multi-search").html()) } 
        ],
        columns: [
            { field:"name", title: " Name" },
            { field: "description", title: " Description"},
            { field: "status", values: statusDataSource, title: "Status" },
            { command: ["edit", "destroy"], title: "&nbsp;Action", menu: false } 
        ],
        editable:{ mode: "popup", window: { width: "600px" }, template: kendo.template($("#popup-editor-type").html()) },
        edit: function (e) {
          //Customize popup title and button label 
          if (e.model.isNew()) {
            e.container.data("kendoWindow").title('Add New Employee Type');
            $(".k-grid-update").html('<span class="k-icon k-i-check"></span>Save');
          }
          else {
            e.container.data("kendoWindow").title('Edit Employee Type');
          }

          /*Initialize status dropdownlist*/
          // initStatusDropDownList();
        }   
      });

      // $("#txtMultiSearch").keyup(function(e){ 
      //   var q = $('#txtMultiSearch').val();
      //   $("#grid").data("kendoGrid").dataSource.filter({
      //     logic  : "or",
      //     filters: [
      //       { field: "name", operator: "contains", value: q },
      //       { field: "description", operator: "contains", value: q },
      //       { field: "status", operator: "eq", value: q }
      //     ]
      //   });  
      // });
      
    });
  </script>   
@endsection