<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['contract', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Новый договор
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['contract/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal pl-2']) ?>

<h4 class ="py-4">Основные сведения</h4>
<div class="form-row">
    <div class="form-group col-md-2">
        <label for="fieldContractNumber" >Номер договора</label>
        <?= $this->tag->textField(['contract_number', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldContractNumber']) ?>
    </div>
    <div class="form-group col-md-2">
        <label for="fieldDate" class="control-label">Дата составления договора</label>
        <?= $this->tag->dateField(['date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldDate']) ?>
    </div>
    <div class="form-group col-md-2">
        <label for="fieldDepartmentId" >Подразделение</label>
        <?= $this->tag->hiddenField(['department_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldDepartmentId']) ?>
        <?= $this->tag->textField(['department', 'class' => 'form-control', 'id' => 'department']) ?>
    </div>
    <div class="form-group col-md-4">
        <label for="fieldTheme" class="control-label">Тема договора</label>
        <?= $this->tag->textField(['theme', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTheme']) ?>
    </div>
    <div class="form-group col-md-2">
        <label for="fieldContractorId" class=" control-label">Контрагент</label>
        <?= $this->tag->hiddenField(['contractor_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldContractorId']) ?>
        <?= $this->tag->textField(['contractor', 'class' => 'form-control', 'id' => 'contractor']) ?>
    </div>
</div>
<div class="form-row">
    <!-- Включить в БД -->
    <div class="form-group col-md-4">
        <label for="fieldSubject" class="control-label">Предмет договора</label>
        <?= $this->tag->textField(['Subject', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSubject']) ?>
    </div>
    <!-- Включить в БД -->
    <div class="form-group col-md-4">
        <label for="fieldBase" class="control-label">Основание договора</label>
        <?= $this->tag->textField(['base', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldBase']) ?>
    </div>
    <!-- Включить в БД -->
    <div class="form-group col-md-2">
        <label for="fieldDeadline" class="control-label">Срок сдачи договора</label>
        <?= $this->tag->dateField(['deadline', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldDeadline']) ?>
    </div>
    <!-- Включить в БД -->
    <div class="form-group col-md-2">
        <label for="fieldSum" class="control-label">Сумма договора</label>
        <?= $this->tag->dateField(['sum', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldSum']) ?>
    </div>
</div>

<h4>О продукте</h4>
<div class="form-group">
    <label for="fieldProductName" class="col-sm-2 control-label">Название продукта</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['product_name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldProductName']) ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldProductUseMethod" class="control-label">Способ использования продукта</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['product_use_method', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldProductUseMethod']) ?>
    </div>
</div>
<h4>Условия оплаты</h4>

<div class="form-group">
    <label for="fieldPayMethod" class="col-sm-2 control-label">Способ оплаты</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['pay_method', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPayMethod']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTransferMony" class="col-sm-2 control-label">Transfer Of Mony</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['transfer_mony', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTransferMony']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldWorkcompletion" class="col-sm-2 control-label">Work Of completion</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['work_completion', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldWorkcompletion']) ?>
    </div>
</div>

<h4>Доплата и штрафы</h4>
<div class="form-group">
    <label for="fieldSurcharge" class="col-sm-2 control-label">Сумма доплаты</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surcharge', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurcharge']) ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldSurchargecondition" class="col-sm-2 control-label">Условия доплаты</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surcharge_condition', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurchargecondition']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFine" class="col-sm-2 control-label">Штраф</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fine', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFine']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldFineConditions" class="col-sm-2 control-label">Условия штрафа</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['fine_conditions', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldFineConditions']) ?>
    </div>
</div>

<h4>Даты</h4>
<div class="form-group">
    <label for="fieldStartDate" class="col-sm-2 control-label">Дата начала</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['start_date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldStartDate']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEndDate" class="col-sm-2 control-label">Дата окончания</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['end_date', 'type' => 'date', 'class' => 'form-control', 'id' => 'fieldEndDate']) ?>
    </div>
</div>


<h4>Права</h4>
<div class="form-group">
    <label for="fieldTransferRight" class="col-sm-2 control-label">Кому принадлежат права на передачу</label>
    <div class="col-sm-10">
        <?= $this->tag->selectStatic(['transfer_right', ['исполнителю' => 'исполнителю', 'заказчику' => 'заказчику'], 'class' => 'form-control', 'id' => 'fieldTransferRight']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPublicationRights" class="col-sm-2 control-label">Кому пренадлежат права на публикацию</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['publication_rights', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPublicationRights']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldOtherRights" class="col-sm-2 control-label">Другие права</label>
    <div class="col-sm-10">
        <?= $this->tag->textArea(['other_rights', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldOtherRights']) ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldTrunsferProfitPercent" class="col-sm-2 control-label">Распределение выгоды от передачи продукта</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['trunsfer_profit_percent', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldTrunsferProfitPercent']) ?>
    </div>
</div>




<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
