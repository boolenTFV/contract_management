<div class="page-header">
    <h1>
        Организации
    </h1>
    <p>
        <?= $this->tag->linkTo(['organization/new', 'Create organization']) ?>
    </p>
</div>

<?= $this->tag->form(['organization/index', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline pb-4']) ?>
    <div class="form-group">
        <label for="search" class="col-sm-2 control-label">поиск</label>
        <?= $this->tag->textField(['search', 'placeholder' => 'поиск', 'class' => 'form-control', 'id' => 'search']) ?>
        <div class="input-group-append">
            <div>
                <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-info']) ?>
            </div>
        </div>
    </div>
<?= $this->tag->endForm() ?>

<?= $this->getContent() ?>

<?php if ($page->total_pages != null) { ?>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Name</th>
            <th>Index</th>
            <th>Bank Of Index</th>
            <th>Bank Of Account</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $organization) { ?>
            <tr>
                <td><?= $organization->id ?></td>
            <td><?= $organization->name ?></td>
            <td><?= $organization->index ?></td>
            <td><?= $organization->bank_index ?></td>
            <td><?= $organization->bank_account ?></td>

                <td><?= $this->tag->linkTo(['organization/edit/' . $organization->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?></td>
                <td><?= $this->tag->linkTo(['organization/delete/' . $organization->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?></td>
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
