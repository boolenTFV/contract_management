<div class="page-header pb-4">
    <h1>
        Учет
    </h1>
    <h3>
        Выбрать страницу.
    </h3>

</div>

<div class="row align-items-end ">
    <div class="col-md-4 pb-1">
        <div class="card">
            <a href="#new_form" class="btn btn-light" data-toggle="collapse">         
                        <h5 class="card-title text-primary">
                            <i class="far fa-plus-square"></i> 
                            Создать страницу учета
                        </h5>
            </a>
            <div class="collapse " id="new_form" >
                <div class="card-body">
                    <?= $this->tag->form(['accounting/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal m-0 ']) ?>
                        <div class="form-group">
                            <label>Название страницы </label>
                            <?= $this->tag->textField(['name', 'placeholder' => 'Страница', 'class' => 'form-control']) ?>
                            </div>
                            <div class = "form-group">                                
                                <?= $this->tag->checkField(['is_add_contracts', 'id' => 'add_contracts_chek', 'class' => 'btn btn-info']) ?>
                                <label for="add_contracts_chek">добавить активные контракты</label>

                            </div>
                            <div class = "form-group"> 
                                <?= $this->tag->checkField(['is_fill', 'id' => 'fill_chek', 'class' => 'btn btn-info']) ?>
                                <label for="fill_chek">заполнить данными предыдущего листа</label>
                            </div>
                            <?= $this->tag->submitButton(['Создать', 'class' => 'btn btn-success w-100']) ?>

                    <?= $this->tag->endForm() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 pb-4">
    </div>
    <div class="col-md-4 pb-1 pr-0">
        <?= $this->tag->form(['accounting/index', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline justify-content-md-end justify-content-center ']) ?>
        <div class="form-group">
            <label for="search" class="col-sm-2 control-label">поиск</label>
           
            <div class="input-group-append">
                 <?= $this->tag->textField(['search', 'placeholder' => 'поиск', 'class' => 'form-control', 'id' => 'search']) ?>
                <div>
                    <?= $this->tag->submitButton(['Search', 'class' => 'btn btn-info']) ?>
                </div>
            </div>
        </div>
        <?= $this->tag->endForm() ?>
    </div>
</div>
<div class="pt-2 pb-2">
<?= $this->getContent() ?>
</div>


<?php if ($page->total_pages != null) { ?>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Название страницы</th>
                    <th>Время создания</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($page->items)) { ?>
            <?php foreach ($page->items as $accountingPage) { ?>
                <tr>
                    <td class="click-row csr-pointer" data-url=<?= $this->url->get('record/index/' . $accountingPage->id) ?>>
                        <?= $accountingPage->id ?>
                    </td>
                    <td class="click-row csr-pointer" data-url=<?= $this->url->get('record/index/' . $accountingPage->id) ?>>
                        <?= $accountingPage->name ?>
                    </td>
                    <td class="click-row csr-pointer" data-url=<?= $this->url->get('record/index/' . $accountingPage->id) ?>>
                        <?= $accountingPage->time ?>
                    </td>
                    <td>
                        <?= $this->tag->linkTo(['accounting/edit/' . $accountingPage->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?>
                    </td>
                    <td>
                        <?= $this->tag->linkTo(['accounting/delete/' . $accountingPage->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?>
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
                        'link' => 'accounting/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   =>$page->total_pages,
                    ]);
    ?>
</div>
<?php } ?>

