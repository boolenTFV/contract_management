<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['document/index', 'Go Back']) ?></li>
            <li class="next"><?= $this->tag->linkTo(['document/new', 'Create ']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?= $this->getContent() ?>

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
        <?php foreach ($page->items as $document) { ?>
            <tr>
                <td><?= $document->id ?></td>
                <td><?= $document->contract_id ?></td>
                <td><?= $document->template ?></td>

                <td><?= $this->tag->linkTo(['document/edit/' . $document->id, 'Edit']) ?></td>
                <td><?= $this->tag->linkTo(['document/delete/' . $document->id, 'Delete']) ?></td>
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
                <li><?= $this->tag->linkTo(['document/search', 'First']) ?></li>
                <li><?= $this->tag->linkTo(['document/search?page=' . $page->before, 'Previous']) ?></li>
                <li><?= $this->tag->linkTo(['document/search?page=' . $page->next, 'Next']) ?></li>
                <li><?= $this->tag->linkTo(['document/search?page=' . $page->last, 'Last']) ?></li>
            </ul>
        </nav>
    </div>
</div>
