<div class="page-header">
    <h1>
        Сотрудники
    </h1>
    <p>
        {{ link_to("employee/new", "Create employee") }}
    </p>
</div>

{{ content() }}

{{ form("employee/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
    <label for="fieldSurename" class="col-sm-2 control-label">Surename</label>
    <div class="col-sm-10">
        {{ text_field("surename", "size" : 30, "class" : "form-control", "id" : "fieldSurename") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPatronymic" class="col-sm-2 control-label">Patronymic</label>
    <div class="col-sm-10">
        {{ text_field("patronymic", "size" : 30, "class" : "form-control", "id" : "fieldPatronymic") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPosition" class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
        {{ text_field("position", "size" : 30, "class" : "form-control", "id" : "fieldPosition") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldDepartmentId" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        {{ text_field("department_id", "type" : "numeric", "class" : "form-control", "id" : "fieldDepartmentId") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
