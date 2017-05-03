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
    /*article data source*/
    var articleDataSource  =   <?php echo json_encode($articles) ?>;
    articleDataSource      =   JSON.parse(articleDataSource);
    console.log(articleDataSource);

        $(document).ready(function () {
            // var crudServiceBaseUrl = "{{ url('') }}",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url: crudBaseUrl + "/employee/get",
                            type:"GET",
                            dataType: "json"
                        },
                        update: {
                            url: crudBaseUrl + "/employee/update",
                            type:"POST",
                            dataType: "json"
                        },
                        destroy: {
                            url: crudBaseUrl + "/employee/destroy",
                            type:"POST",
                            dataType: "json"
                        },
                        create: {
                            url: crudBaseUrl + "/employee/store",
                            type:"POST",
                            dataType: "json"
                        },
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                return {employee: kendo.stringify(options.models)};
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
                                article_id: { type: "number", nullable: true },
                                firstName: { type: "string" },
                                lastName: { type: "string" },
                                // image: { type: "string" },
                                phone: { type: "string", nullable: true },
                                email: { type: "string", nullable: true },
                                address: { type: "string", nullable: true },
                                detial: { type: "string", nullable: true },
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
                    { name: "create", text: "Add New employee" }
                ],
                columns: [
                    { field:"article_id", title: "Article_ID", values: articleDataSource },
                    { field: "firstName", title: "First Name" },
                    { field: "lastName", title: "Last Name" },
                    // { field: "image", title:"Image" },
                    { field: "phone", title: "Phone" },
                    { field: "email", title: "Email" },
                    { field: "address", title: "Address", hidden: true },
                    { field: "detial", title: "Detial", hidden: true },
                    { field: "status", title: "Status", values: statusDataSource },
                    { command: ["edit", "destroy"], title: "Action", menu: false }
                ],
                editable: { mode: "popup", window: { width: "600px" }, template: kendo.template($("#popup-editor-employee").html()) },

                edit: function (e) {
                  /*Customize popup title and button label*/
                  if (e.model.isNew()) {
                    e.container.data("kendoWindow").title('Add New employee');
                    $(".k-grid-update").html('<span class="k-icon k-i-check"></span>Save');
                  }
                  else {
                    e.container.data("kendoWindow").title('Edit employee');
                  }

                  /*Call function  init form control*/
                  initFormControl(); 
                }
            });
        });
         function initFormControl(){

         /*Initailize status dropdownlist*/
         initStatusDropDownList();
         /*Initailize article dropdownlist*/
         initialArticleDropDownList()

        }
    </script>
    <!-- Customize popup editor employee --> 
    <script type="text/x-kendo-template" id="popup-editor-employee">
      
      <div class="row-12">
        <div class="row-6">

          <div class="col-12">
              <label for="article_id">Article_ID</label>
              <input class="k-textbox" id="article" data-bind="value: article_id"  style="width: 100%;" />
          </div>  

          <div class="col-12">
            <label for="firstName">First Name</label>
            <input type="text" class="k-textbox" name="firstName" placeholder="Enter first name" data-bind="value:firstName" required data-required-msg="The first name field is required" pattern=".{1,30}" validationMessage="The first name may not be greater than 30 characters" style="width: 100%;"/>
          </div>

          <div class="col-12">
            <label for="lastName">Last Name</label>
            <input type="text" class="k-textbox" name="lastName" placeholder="Enter last name" data-bind="value:lastName" required data-required-msg="The last name field is required" pattern=".{1,30}" validationMessage="The last name may not be greater than 30 characters" style="width: 100%;"/>
          </div>

          <div class="col-12">
            <label for="phone">Phone</label>
            <input type="tel" class="k-textbox" name="phone" data-bind="value:phone" placeholder="Enter phone number" required data-required-msg="The phone field is required" pattern="^[0-9\ \]{9,13}$" placeholder="Enter phone number" validationMessage="Phone number format is not valid" style="width: 100%;"/>
          </div>

          <div class="col-12">
            <label for="email">Email</label>
            <input type="email" class="k-textbox" name="Email" placeholder="e.g. myname@example.net" data-bind="value:email" data-email-msg="Email format is not valid" pattern=".{0,60}" validationMessage="The email may not be greater than 60 characters" style="width: 100%;"/>
          </div> 
        </div>


        <div class="row-6">  
          <div class="col-12">
            <label for="address">Address</label>
            <textarea class="k-textbox" name="address" placeholder="Enter address" data-bind="value:address" maxlength="200" style="width: 100%; height: 97px;"/></textarea> 
          </div>
          
          <div class="col-12">
            <label for="detial">Detial</label>
            <textarea class="k-textbox" name="detial" placeholder="Enter detial" data-bind="value:detial" maxlength="200" style="width: 100%; height: 97px;"/></textarea> 
          </div>
          
          <div class="col-12">
              <label for="status">Status</label>
              <input id="status" data-bind="value:status" style="width: 100%;" />
          </div>
        </div>
      </div>

    </script>  

@endsection