@extends('layouts.app')

@section('after_styles')
  <style>
    
  </style>

@endsection

@section('header')
  <section class="content-header">
    <h1>Setup Slider</h1>
    <ol class="breadcrumb">
      <li class="active">{{ config('app.name') }}</li>
      <li class="active">Setup Slider</li>
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
      /*Category data source*/
      var articleDataSource  =   <?php echo json_encode($article) ?>;
      articleDataSource      =   JSON.parse(articleDataSource);

        $(document).ready(function () {
            // var crudServiceBaseUrl = "{{ url(' ') }}",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url: crudBaseUrl + "/slider/get",
                            type:"GET",
                            dataType: "json"
                        },
                        update: {
                            url: crudBaseUrl + "/slider/update",
                            type:"POST",
                            dataType: "json"
                        },
                        destroy: {
                            url: crudBaseUrl + "/slider/destroy",
                            type:"POST",
                            dataType: "json"
                        },
                        create: {
                            url: crudBaseUrl + "/slider/store",
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
                                article_id: { type: "string" },
                                image: { type: "string",nullable: true },
                                name: { type: "string",nullable: true },
                                description: { type: "string",nullable: true },
                                status: { field: "status", type: "string", defaultValue: "Enabled" }
                            }
                        }
                    }
                });
            $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                navigatable: true,
                resizable: true,
                reorderable: true,
                columnMenu: true,
                filterable: true,
                sortable: { mode: "single", allowUnsort: false },
                pageable: { refresh:true, pageSizes: true, buttonCount: 5 },
                height: 550,
                toolbar: [
                    { name: "create", text: "Add New Slider" }
                ],
                columns: [
                    { field:"article_id", title: "Type", values: categoryDataSource },
                    { field: "image", title:"Image" },
                    { field: "name", title:"Name" },
                    { field: "description", title:"Description" },
                    { field: "status", title: "Status", values: statusDataSource },
                    { command: ["edit", "destroy"], title: "Action", menu: false }
                ],
                editable: { mode: "popup", window: { width: "600px" }, template: kendo.template($("#popup-editor-customer").html()) },

                edit: function (e) {
                  /*Customize popup title and button label*/
                  if (e.model.isNew()) {
                    e.container.data("kendoWindow").title('Add New Slider');
                    $(".k-grid-update").html('<span class="k-icon k-i-check"></span>Save');
                  }
                  else {
                    e.container.data("kendoWindow").title('Edit Slider');
                  }

                  /*Call function  init form control*/
                  initFormControl(); 
                }
            });
        });
         function initFormControl(){
          /*Initialize article type dropdownlist*/
          $("#type").kendoDropDownList({
            optionLabel: "Select Article type...",
            dataValueField: "value",
            dataTextField: "text",
            dataSource: {
              transport: {
                read: {
                  url: crudBaseUrl + "/article/list/filter",
                  type: "GET",
                  dataType: "json"
                }
              }
            }
          });

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
