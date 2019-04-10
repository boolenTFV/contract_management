<div class="page-header">
    <h1>
        Search document
    </h1>
    <p>
        <?= $this->tag->linkTo(['document/new', 'Create document']) ?>
    </p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['document/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline']) ?>

<div class="form-group pb-3">
    <label for="fieldTemplate" class="control-label pr-3">Поиск</label>
    <div class="pr-1">
        <?= $this->tag->textField(['template', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldTemplate']) ?>
    </div>
    <div class="">
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
    </div>
</di
<?= $this->tag->endForm() ?>

<?php if ($page->total_pages != null) { ?>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <!--<th>Id</th>-->
                <!--<th>Contract</th>
                <th>Template</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $document) { ?>
            <tr>
                <!-- <td><?= $document->id ?></td> -->
                <!-- <td><?= $document->contract_id ?></td> -->
                <td><?= $document->template ?></td>

                <td class="text-right">
                    <?= $this->tag->linkTo(['document/generate/' . $document->id, '<i class="fas fa-file-alt pr-2"></i>', 'class' => 'text-primary']) ?>
                    <?= $this->tag->linkTo(['document/edit/' . $document->id, '<i class="fas fa-pencil-alt pr-2"></i>', 'class' => 'text-primary']) ?>
                    <?= $this->tag->linkTo(['document/delete/' . $document->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?>
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
