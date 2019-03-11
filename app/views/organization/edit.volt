<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("organization", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit organization
    </h1>
</div>

{{ content() }}

{{ form("organization/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ hidden_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        {{ text_field("name", "size" : 30, "class" : "form-control", "id" : "fieldName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldIndex" class="col-sm-2 control-label">Index</label>
    <div class="col-sm-10">
        {{ text_field("index", "size" : 30, "class" : "form-control", "id" : "fieldIndex") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldBankIndex" class="col-sm-2 control-label">Bank Of Index</label>
    <div class="col-sm-10">
        {{ text_field("bank_index", "size" : 30, "class" : "form-control", "id" : "fieldBankIndex") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldBankAccount" class="col-sm-2 control-label">Bank Of Account</label>
    <div class="col-sm-10">
        {{ text_field("bank_account", "size" : 30, "class" : "form-control", "id" : "fieldBankAccount") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
