<div class="page-header">
    <h1>
        Пользователи
    </h1>
    <p>
        <?= $this->tag->linkTo(['user/new', 'Create user']) ?>
    </p>
</div>



<?= $this->tag->form(['user/index', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline']) ?>
<div class="form-group">
    <label for="search" class="col-sm-2 control-label">поиск</label>
    <?= $this->tag->textField(['search', 'placeholder' => 'поиск', 'class' => 'form-control', 'id' => 'search']) ?>
    <div class="input-group-append">
        <div>
            <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-info']) ?>
        </div>
    </div>
</div>

</form>
<div class="pt-2 pb-2">
<?= $this->getContent() ?>
</div>
<?php if ($page->total_pages != null) { ?>
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                <th>ФИО</th>
                <th>Email</th>
                <th>Type</th>
                <th>Department</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($page->items)) { ?>
            <?php foreach ($page->items as $user) { ?>
                <tr>
                    <td><?= $user->id ?></td>
                <td><?= $user->surname . ' ' . $user->name . ' ' . $user->patronymic ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->type ?></td>
                <td>
                    <?php if ((isset($user->department_id))) { ?>
                        <?= $user->department->abbreviation ?>
                    <?php } ?>
                </td>
                    <?php if ($user->is_active) { ?>
                        <td><?= $this->tag->linkTo(['user/active/' . $user->id, '<i class="fas fa-unlock"></i>', 'class' => 'text-success']) ?></td>
                    <?php } else { ?>
                        <td><?= $this->tag->linkTo(['user/active/' . $user->id, '<i class="fas fa-lock"></i>', 'class' => 'text-danger']) ?></td>
                    <?php } ?>
                    <td><?= $this->tag->linkTo(['user/edit/' . $user->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?></td>
                    <td><?= $this->tag->linkTo(['user/delete/' . $user->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-primary']) ?></td>
                </tr>
            <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'user/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>
<?php } ?>

