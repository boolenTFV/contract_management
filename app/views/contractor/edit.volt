<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("contractor", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit contractor
    </h1>
</div>

{{ content() }}

{{ form("contractor/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

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
    <label for="fieldPosition" class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
        {{ text_field("position", "size" : 30, "class" : "form-control", "id" : "fieldPosition") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldOrganizationId" class="col-sm-2 control-label">Organization</label>
    <div class="col-sm-10">
        {{ hidden_field("organization_id", "type" : "numeric", "class" : "form-control", "id" : "fieldOrganizationId") }}
        {{ text_field("organization", "class" : "form-control", "id" : "organization") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
