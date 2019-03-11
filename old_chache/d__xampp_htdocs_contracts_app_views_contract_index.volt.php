<div class="page-header">
    <h1>
        Журнал договоров
    </h1>
    <p>
        <?= $this->tag->linkTo(['contract/new', '<i class="fas fa-plus-square"></i> Добавить договор']) ?>
    </p>
</div>



<?= $this->tag->form(['contract/index', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-inline pb-4']) ?>
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
                <th>Подразделение</th>
                <th>Номер договора</th>
                <th>Дата</th>
                <th>Тема</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Заказчик</th>
                <th>Статус</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $contract) { ?>
            <?php switch ($contract->status): ?>
<?php case 'unverified': ?>
<?php $tr_class = 'bg-warning text-white'; ?>
<?php break; ?>
<?php case 'verified': ?>
<?php $tr_class = 'bg-success text-white'; ?>
<?php break; ?>
<?php case 'active': ?>
<?php $tr_class = 'bg-light text-dark'; ?>
<?php break; ?>
<?php case 'closed': ?>
<?php $tr_class = 'bg-dark text-white'; ?>
<?php break; ?>
<?php default: ?>
<?php $tr_class = 'bg-light text-dark'; ?>
<?php endswitch ?>
            <tr class="<?= $tr_class ?>">
                <td><?= $contract->department->abbreviation ?></td>
                <td><?= $contract->contract_number ?></td>
                <td><?= $contract->date ?></td>
                <td><?= $contract->theme ?></td>
                <td><?= $contract->start_date ?></td>
                <td><?= $contract->end_date ?></td>
                <td><?= $contract->contractor->organization->name ?></td>
                <td>
                    <?php if ($role != 'user') { ?>
                            <?= $this->tag->form(['contract/setstatus', 'method' => 'post', 'class' => 'form-inline mr-0 p-0']) ?>
                             <div class="form-group mr-0 p-0">
                            <?= $this->tag->hiddenField(['id', 'value' => $contract->id]) ?>
                            <?php $options = ['unverified' => 'Не проверен', 'verified' => 'Проверен', 'active' => 'Активен', 'closed' => 'Закрыт']; ?>
                            <select name ='status' class="bg-light form-control">
                                <?php foreach ($options as $value => $option) { ?>
                                    <?php if ($value == $contract->status) { ?>
                                        <option value="<?= $value ?>" selected>
                                             <?= $option ?>
                                        </option>                                   
                                    <?php } else { ?>
                                        <option value="<?= $value ?>">
                                            <?= $option ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary ml-1">
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                        <?= $this->tag->endForm() ?>
                    <?php } else { ?>
                        <?= $contract->status ?>
                    <?php } ?>


                    
                </td>
                <td><?= $this->tag->linkTo(['contract/edit/' . $contract->id, '<i class="fas fa-pencil-alt "></i>', 'class' => 'text-primary']) ?></td>
                <td><?= $this->tag->linkTo(['contract/delete/' . $contract->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?></td>
            </tr>
        <?php } ?>
       
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'contract/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>
 <?php } ?>


