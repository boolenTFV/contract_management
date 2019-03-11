<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['document', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create document
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['document/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldContractId" class="col-sm-2 control-label">Contract</label>
    <div class="col-sm-10">
        <?= $this->tag->hiddenField(['contract_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldContractId']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTemplate" class="col-sm-2 control-label">Название шаблона</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['template', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTemplate']) ?>
    </div>
</div>
<div class="form-group">
    <label for="templateFileId" class="col-sm-2 control-label">Загрузить шаблон</label>
    <div class="col-sm-10 text-center">
        <?= $this->tag->fileField(['template_file', 'class' => 'form-control', 'id' => 'templateFileId']) ?>
    </div>
</div>

<?= $this->tag->hiddenField(['id']) ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Send', 'class' => 'btn btn-default']) ?>
    </div>
</div>

<?= $this->tag->endForm() ?>
