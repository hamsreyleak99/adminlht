
@extends('layouts.app')
@section('after_styles')
  <style>
    .bgColor {
      max-width: 440px;
      height:150px;
      background-color: #fff4be;
      border-radius: 4px;
    }
    .bgColor label{
      font-weight: bold;
      color: #A0A0A0;
    }
    #targetLayer{
      float:left;
      width:150px;
      height:150px;
      text-align:center;
      line-height:150px;
      font-weight: bold;
      color: #C0C0C0;
      background-color: #F0E8E0;
      border-bottom-left-radius: 4px;
      border-top-left-radius: 4px;
    }
    #uploadFormLayer{
      float:left;
      padding: 20px;
    }
    .btnSubmit {
      background-color: #696969;
      padding: 5px 30px;
      border: #696969 1px solid;
      border-radius: 4px;
      color: #FFFFFF;
      margin-top: 10px;
    }
    .inputFile {
      padding: 5px;
      background-color: #FFFFFF;
      border:#F0E8E0 1px solid;
      border-radius: 4px;
    }
    .image-preview {  
      width:150px;
      height:150px;
      border-bottom-left-radius: 4px;
      border-top-left-radius: 4px;
    }
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
      var articleDataSource  =   <?php echo json_encode($articles) ?>;
      articleDataSource      =   JSON.parse(articleDataSource);

        $(document).ready(function () {
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
                                return {slider: kendo.stringify(options.models)};
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
                    { field:"article_id", title: "Article", values: articleDataSource },
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
          
        // Initialize article dropdownlist
        initialArticleDropDownList();

        // Initailize status dropdownlist
        initStatusDropDownList();

        };

        $(document).ready(function (e) {
          $("#uploadForm").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
              url: crudBaseUrl + "/upload",
              type: "POST",
              data:  new FormData(this),
              contentType: false,
                  cache: false,
              processData:false,
              success: function(data)
                {
              $("#targetLayer").html(data);
                },
                error: function() 
                {
                }           
             });
          }));
        });        
       
    </script>
    <!-- Customize popup editor customer --> 
  <script type="text/x-kendo-template" id="popup-editor-customer">
    <div class="row-12">
        <div class="col-12">
          <label for="article_id">Article</label>
          <input class="k-textbox" id="article" data-bind="value: article_id"  style="width: 100%;" />
        </div>

        <div class="col-12">
          <label for="name">Name</label>
          <input type="text" class="k-textbox" name="name" placeholder="Enter name" data-bind="value:name" required data-required-msg="The name field is required" pattern=".{1,60}" validationMessage="The name may not be greater than 60 characters" style="width: 100%;"/>
        </div>

        <div class="col-12">
          <div class="bgColor">
            <form id="uploadForm" action="{{ '/upload' }}" method="post">
              <div id="targetLayer">Image</div>
                <div id="uploadFormLayer">
                  <input name="image" type="file" class="inputFile" /><br/>
                  <input type="submit" value="Submit" class="btnSubmit" />
                </div>
            </form>
          </div>

          <!-- <label for="image">Image</label>
           <input type="file" class="k-textbox" name="image" placeholder="Enter image" data-bind="value:image" style="width: 100%;"/> -->
           
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

