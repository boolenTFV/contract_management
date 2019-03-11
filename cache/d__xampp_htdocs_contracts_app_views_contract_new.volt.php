<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['contract', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create contract
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['contract/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldDepartmentId" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-10">
        <?= $this->tag->hiddenField(['department_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldDepartmentId']) ?>
        <?= $this->tag->textField(['department', 'class' => 'form-control', 'id' => 'department']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldContractNumber" class="col-sm-2 control-label">Contract Of Number</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['contract_number', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldContractNumber']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDate" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldDate']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTheme" class="col-sm-2 control-label">Theme</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['theme', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTheme']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldProductName" class="col-sm-2 control-label">Product Of Name</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['product_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldProductName']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldWorkcompletion" class="col-sm-2 control-label">Work Of completion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['work_completion', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldWorkcompletion']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldProductUseMethod" class="col-sm-2 control-label">Product Of Use Of Method</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['product_use_method', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldProductUseMethod']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTransferMony" class="col-sm-2 control-label">Transfer Of Mony</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['transfer_mony', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTransferMony']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPayMethod" class="col-sm-2 control-label">Pay Of Method</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['pay_method', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPayMethod']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldSurcharge" class="col-sm-2 control-label">Surcharge</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surcharge', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurcharge']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldSurchargecondition" class="col-sm-2 control-label">Surcharge Of condition</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surcharge_condition', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurchargecondition']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFine" class="col-sm-2 control-label">Fine</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fine', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFine']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFineConditions" class="col-sm-2 control-label">Fine Of Conditions</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fine_conditions', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFineConditions']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldStartDate" class="col-sm-2 control-label">Start Of Date</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['start_date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldStartDate']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEndDate" class="col-sm-2 control-label">End Of Date</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['end_date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldEndDate']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTransferRight" class="col-sm-2 control-label">Transfer Of Right</label>
    <div class="col-sm-10">
        <?= $this->tag->selectStatic(['transfer_right', ['исполнителю' => 'исполнителю', 'заказчику' => 'заказчику'], 'class' => 'form-control', 'id' => 'fieldTransferRight']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPublicationRights" class="col-sm-2 control-label">Publication Of Rights</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['publication_rights', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPublicationRights']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldOtherRights" class="col-sm-2 control-label">Other Of Rights</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['other_rights', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldOtherRights']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTrunsferProfitPercent" class="col-sm-2 control-label">Trunsfer Of Profit Of Percent</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['trunsfer_profit_percent', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldTrunsferProfitPercent']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldContractorId" class="col-sm-2 control-label">Contractor</label>
    <div class="col-sm-10">
        <?= $this->tag->hiddenField(['contractor_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldContractorId']) ?>
        <?= $this->tag->textField(['contractor', 'class' => 'form-control', 'id' => 'contractor']) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
