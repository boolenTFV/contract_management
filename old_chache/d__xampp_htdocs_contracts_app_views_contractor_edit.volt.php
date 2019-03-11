<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['contractor', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit contractor
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['contractor/save', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldName']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldSurename" class="col-sm-2 control-label">Surename</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surename', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurename']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPosition" class="col-sm-2 control-label">Position</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['position', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPosition']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldOrganizationId" class="col-sm-2 control-label">Organization</label>
    <div class="col-sm-10">
        <?= $this->tag->hiddenField(['organization_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldOrganizationId']) ?>
        <?= $this->tag->textField(['organization', 'class' => 'form-control', 'id' => 'organization']) ?>
    </div>
</div>


<?= $this->tag->hiddenField(['id']) ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Send', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
