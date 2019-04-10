<div class="modal" tabindex="-1" role="dialog" id='templatesModal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Выберете шаблон</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id='templatesTable' class='table'>
            <tr>
                <th>Шаблон</th>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="page-header">
    <h1>
        Журнал договоров
    </h1>
    <p>
        <?= $this->tag->linkTo(['contract/new', '<i class="fas fa-plus-square"></i> Добавить договор']) ?>
    </p>
</div>

<div id = 'alerts'>
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
                    <?= $contract->status ?>
                    <?php if ($role != 'user') { ?>

                             <div class="form-group mr-0 p-0">
                            <?php $options = ['unverified' => 'Не проверен', 'verified' => 'Проверен', 'active' => 'Активен', 'closed' => 'Закрыт']; ?>

                            <select name ='status' data-id = '<?= $contract->id ?>' class="bg-light form-control">

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
                        </div>
                    <?php } else { ?>
                        <?= $contract->status ?>
                    <?php } ?>


                    
                </td>
                <td class="text-center">
                    <?= $this->tag->linkTo(['#', '<i class="fas fa-file-alt"></i>', 'class' => 'text-primary get-template pr-1', 'data-contract' => $contract->id, 'data-toggle' => 'modal', 'data-target' => '#templatesModal']) ?>
                    <?= $this->tag->linkTo(['contract/edit/' . $contract->id, '<i class="fas fa-pencil-alt pr-1"></i>', 'class' => 'text-primary']) ?>
                    <?= $this->tag->linkTo(['contract/delete/' . $contract->id, '<i class="fas fa-trash-alt"></i>', 'class' => 'text-danger']) ?>
                </td>
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

 

