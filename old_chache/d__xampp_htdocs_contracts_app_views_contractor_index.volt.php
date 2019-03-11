<div class="page-header">
    <h1>
        Контрагенты
    </h1>
    <p>
        <?= $this->tag->linkTo(['contractor/new', 'Create contractor']) ?>
    </p>
</div>

<?= $this->tag->form(['contractor/index', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline pb-4']) ?>
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
            <th>Surename</th>
            <th>Position</th>
            <th>Organization</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $contractor) { ?>
            <tr>
                <td><?= $contractor->id ?></td>
            <td><?= $contractor->name ?></td>
            <td><?= $contractor->surename ?></td>
            <td><?= $contractor->position ?></td>
            <td><?= $contractor->organization->name ?></td>

                <td><?= $this->tag->linkTo(['contractor/edit/' . $contractor->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?></td>
                <td><?= $this->tag->linkTo(['contractor/delete/' . $contractor->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?></td>
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