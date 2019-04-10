<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("contract", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit contract
    </h1>
</div>

{{ content() }}

{{ form("contract/save", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-row form-group">
    <div class="col-3">
        <label for="fieldDepartmentId" class="col-sm-2 control-label">Подразделение/Department</label>
    </div>
    <div>
        <div class="col-sm-10">
            {{ hidden_field("department_id", "type" : "numeric", "class" : "form-control", "id" : "fieldDepartmentId") }}
            {{ text_field("department", "class" : "form-control", "id" : "department") }}
        </div>
    </div>
</div>
<div class="form-group">
    <label for="fieldDepartmentId" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        {{ hidden_field("department_id", "type" : "numeric", "class" : "form-control", "id" : "fieldDepartmentId") }}
        {{ text_field("department", "class" : "form-control", "id" : "department") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldContractNumber" class="col-sm-2 control-label">Contract Of Number</label>
    <div class="col-sm-10">
        {{ text_field("contract_number", "size" : 30, "class" : "form-control", "id" : "fieldContractNumber") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldDate" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-10">
        {{ text_field("date", "type" : "date", "class" : "form-control", "id" : "fieldDate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTheme" class="col-sm-2 control-label">Theme</label>
    <div class="col-sm-10">
        {{ text_field("theme", "size" : 30, "class" : "form-control", "id" : "fieldTheme") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldProductName" class="col-sm-2 control-label">Product Of Name</label>
    <div class="col-sm-10">
        {{ text_field("product_name", "size" : 30, "class" : "form-control", "id" : "fieldProductName") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldWorkcompletion" class="col-sm-2 control-label">Work Of completion</label>
    <div class="col-sm-10">
        {{ text_field("work_completion", "type" : "date", "class" : "form-control", "id" : "fieldWorkcompletion") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldProductUseMethod" class="col-sm-2 control-label">Product Of Use Of Method</label>
    <div class="col-sm-10">
        {{ text_field("product_use_method", "size" : 30, "class" : "form-control", "id" : "fieldProductUseMethod") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTransferMony" class="col-sm-2 control-label">Transfer Of Mony</label>
    <div class="col-sm-10">
        {{ text_field("transfer_mony", "size" : 30, "class" : "form-control", "id" : "fieldTransferMony") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPayMethod" class="col-sm-2 control-label">Pay Of Method</label>
    <div class="col-sm-10">
        {{ text_field("pay_method", "size" : 30, "class" : "form-control", "id" : "fieldPayMethod") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSurcharge" class="col-sm-2 control-label">Surcharge</label>
    <div class="col-sm-10">
        {{ text_field("surcharge", "size" : 30, "class" : "form-control", "id" : "fieldSurcharge") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldSurchargecondition" class="col-sm-2 control-label">Surcharge Of condition</label>
    <div class="col-sm-10">
        {{ text_field("surcharge_condition", "size" : 30, "class" : "form-control", "id" : "fieldSurchargecondition") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFine" class="col-sm-2 control-label">Fine</label>
    <div class="col-sm-10">
        {{ text_field("fine", "size" : 30, "class" : "form-control", "id" : "fieldFine") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFineConditions" class="col-sm-2 control-label">Fine Of Conditions</label>
    <div class="col-sm-10">
        {{ text_field("fine_conditions", "size" : 30, "class" : "form-control", "id" : "fieldFineConditions") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldStartDate" class="col-sm-2 control-label">Start Of Date</label>
    <div class="col-sm-10">
        {{ text_field("start_date", "type" : "date", "class" : "form-control", "id" : "fieldStartDate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEndDate" class="col-sm-2 control-label">End Of Date</label>
    <div class="col-sm-10">
        {{ text_field("end_date", "type" : "date", "class" : "form-control", "id" : "fieldEndDate") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTransferRight" class="col-sm-2 control-label">Transfer Of Right</label>
    <div class="col-sm-10">
        {{ select_static("transfer_right", ['исполнителю':'исполнителю', 'заказчику':'заказчику'], "class" : "form-control", "id" : "fieldTransferRight") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPublicationRights" class="col-sm-2 control-label">Publication Of Rights</label>
    <div class="col-sm-10">
        {{ text_field("publication_rights", "size" : 30, "class" : "form-control", "id" : "fieldPublicationRights") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldOtherRights" class="col-sm-2 control-label">Other Of Rights</label>
    <div class="col-sm-10">
        {{ text_field("other_rights", "size" : 30, "class" : "form-control", "id" : "fieldOtherRights") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTrunsferProfitPercent" class="col-sm-2 control-label">Trunsfer Of Profit Of Percent</label>
    <div class="col-sm-10">
        {{ text_field("trunsfer_profit_percent", "type" : "numeric", "class" : "form-control", "id" : "fieldTrunsferProfitPercent") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldContractorId" class="col-sm-2 control-label">Contractor</label>
    <div class="col-sm-10">
        {{ hidden_field("contractor_id", "type" : "numeric", "class" : "form-control", "id" : "fieldContractorId") }}
        {{ text_field("contractor", "class" : "form-control", "id" : "contractor") }}
    </div>
</div>


{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

{{link_to('document/new','Добавить шаблон')}}

</form>
