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
            // var crudServiceBaseUrl = "{{ url('') }}",
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
                                title: { type: "string" },
                                description: { type: "string",nullable: true },
                                status: { field: "status", type: "string", defaultValue: "Enabled" }
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
                pageable: { refresh:true, pageSizes: true, buttonCount: 5 },
                navigatable: true,
                resizable: true,
                reorderable: true,
                columnMenu: true,
                filterable: true,
                sortable: { mode: "single", allowUnsort: false },
                pageable: { refresh:true, pageSizes: true, buttonCount: 5 },
                height: 550,
                toolbar: [
                    { name: "create", text: "Add New Article" }
                ],
                columns: [
                    { field:"title", title: "Title" },
                    { field: "description", title:"Description" },
                    { field: "status", title: "Status", values: statusDataSource },
                    { command: ["edit", "destroy"], title: "Action", menu: false }
                ],
                editable: { mode: "popup", window: { width: "600px" }, template: kendo.template($("#popup-editor-customer").html()) },

                edit: function (e) {
                  /*Customize popup title and button label*/
                  if (e.model.isNew()) {
                    e.container.data("kendoWindow").title('Add New Article');
                    $(".k-grid-update").html('<span class="k-icon k-i-check"></span>Save');
                  }
                  else {
                    e.container.data("kendoWindow").title('Edit Article');
                  }

                  /*Call function  init form control*/
                  initFormControl(); 
                }
            });
        });
         function initFormControl(){

         /*Initailize status dropdownlist*/
         initStatusDropDownList();

        }
    </script>
    <!-- Customize popup editor customer --> 
  <script type="text/x-kendo-template" id="popup-editor-customer">
    <div class="row-12">
        <div class="col-12">
          <label for="title">Title</label>
          <input type="text" class="k-textbox" name="title" placeholder="Enter title" data-bind="value:title" required data-required-msg="The title field is required" pattern=".{1,60}" validationMessage="The title may not be greater than 60 characters" style="width: 100%;"/>
        </div>
         <div class="col-12">
          <label for="description">Description</label>
          <textarea class="k-textbox" name="description" placeholder="Enter description" data-bind="value:description" maxlength="200" style="width: 100%; height: 97px;"></textarea> 
        </div>
        <div class="col-12">
            <label for="status">Status</label>
            <input id="status" data-bind="value:status"  style="width: 100%;" />
        </div>
    </div>
  </script>  

@endsection


    