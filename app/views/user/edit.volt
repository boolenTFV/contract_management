  <div class="modal"  id="set_department">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Выбрать группу</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="departments" class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Название</th>
                                <th>Год</th>
                                <th>Форма обучения</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("user", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit user
    </h1>
</div>

{{ content() }}

{{ form("user/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSurname" class="col-sm-2 control-label">Surname</label>
    <div class="col-sm-10">
        {{ text_field("surname", "size" : 30, "class" : "form-control", "id" : "fieldSurname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPatronymic" class="col-sm-2 control-label">Patronymic</label>
    <div class="col-sm-10">
        {{ text_field("patronymic", "size" : 30, "class" : "form-control", "id" : "fieldPatronymic") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPass" class="col-sm-2 control-label">Pass</label>
    <div class="col-sm-10">
        {{ text_field("pass", "size" : 30, "class" : "form-control", "id" : "fieldPass") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldType" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-10">
       {{ select_static("type", ['admin':'сотрудник НИС', 'user':'сотрудник'], "class" : "form-control", "id" : "fieldType") }}
    </div>
</div>

<div class="form-group input-group-append col-sm-10">
    <label for="fieldDepartmentId" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        {{ hidden_field("department_id", "type" : "numeric", "class" : "form-control", "id" : "fieldDepartmentId") }}
        {{ text_field("department", "class" : "form-control", "id" : "department") }}
    </div>
 
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
