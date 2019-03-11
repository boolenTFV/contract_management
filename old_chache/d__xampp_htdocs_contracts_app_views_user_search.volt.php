<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['user/index', 'Go Back']) ?></li>
            <li class="next"><?= $this->tag->linkTo(['user/new', 'Create ']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?= $this->getContent() ?>
<?= $this->tag->form(['user/search', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline']) ?>

<div class="form-group pb-2">
    <label for="fieldId" class="col-sm-2 control-label">поиск</label>
        <?= $this->tag->textField(['search', 'class' => 'form-control', 'id' => 'search']) ?>
        <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-default']) ?>
</div>
</form>
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Patronymic</th>
            <th>Email</th>
            <th>Pass</th>
            <th>Type</th>
            <th>Department</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($page->items)) { ?>
        <?php foreach ($page->items as $user) { ?>
            <tr>
                <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->surname ?></td>
            <td><?= $user->patronymic ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->pass ?></td>
            <td><?= $user->type ?></td>
            <td><?= $user->department_id ?></td>

                <td><?= $this->tag->linkTo(['user/edit/' . $user->id, 'Edit']) ?></td>
                <td><?= $this->tag->linkTo(['user/delete/' . $user->id, 'Delete']) ?></td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?= $page->current . '/' . $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?= $this->tag->linkTo(['user/search', 'First']) ?></li>
                <li><?= $this->tag->linkTo(['user/search?page=' . $page->before, 'Previous']) ?></li>
                <li><?= $this->tag->linkTo(['user/search?page=' . $page->next, 'Next']) ?></li>
                <li><?= $this->tag->linkTo(['user/search?page=' . $page->last, 'Last']) ?></li>
            </ul>
        </nav>
    </div>
</div>
