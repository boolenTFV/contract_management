<div class="page-header">
    <h1>
        Search document
    </h1>
    <p>
        <?= $this->tag->linkTo(['document/new', 'Create document']) ?>
    </p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['document/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldId']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldContractId" class="col-sm-2 control-label">Contract</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['contract_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldContractId']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldTemplate" class="col-sm-2 control-label">Template</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['template', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTemplate']) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
    </div>
</div>

<?php if ($page->total_pages != null) { ?>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Contract</th>
                <th>Template</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $department) { ?>
            <tr>
                <td><?= $document->id ?></td>
                <td><?= $document->contract_id ?></td>
                <td><?= $document->template ?></td>

                <td><?= $this->tag->linkTo(['document/edit/' . $document->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?></td>
                <td>
                    <?= $this->tag->linkTo(['document/delete/' . $document->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?>
                </td>
                <td>
                    <?= $this->tag->linkTo(['department/edit/' . $department->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?>
                </td>
                <td>
                    <?= $this->tag->linkTo(['department/delete/' . $department->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'department/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>
<?php } ?>

</form>
