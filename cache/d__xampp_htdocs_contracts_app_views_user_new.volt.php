<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?= $this->tag->linkTo(['user', 'Go Back']) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create user
    </h1>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['user/create', 'method' => 'post', 'autocomplete' => 'off', 'class' => 'form-horizontal']) ?>

<div class="form-group">
    <label for="fieldSurname" class="col-sm-2 control-label">Фамилия</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['surname', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldSurname']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Имя</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['name', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldName']) ?>
    </div>
</div>



<div class="form-group">
    <label for="fieldPatronymic" class="col-sm-2 control-label">Отчество</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['patronymic', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPatronymic']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Почта</label>
    <div class="col-sm-10">
        <?= $this->tag->textField(['email', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldEmail']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPass" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
        <?= $this->tag->passwordField(['pass', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPass']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPass" class="col-sm-2 control-label">Повторите пароль</label>
    <div class="col-sm-10">
        <?= $this->tag->passwordField(['pass2', 'size' => 30, 'class' => 'form-control', 'id' => 'fieldPass']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldType" class="col-sm-2 control-label">Тип пользователя</label>
    <div class="col-sm-10">
        <?= $this->tag->selectStatic(['type', ['admin' => 'сотрудник НИС', 'user' => 'сотрудник'], 'class' => 'form-control', 'id' => 'fieldType']) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDepartmentId" class="col-sm-2 control-label">Подразделение</label>
    <div class="col-sm-10">
        <?= $this->tag->hiddenField(['department_id', 'type' => 'numeric', 'class' => 'form-control', 'id' => 'fieldDepartmentId']) ?>
        <?= $this->tag->textField(['department', 'class' => 'form-control', 'id' => 'department']) ?>
    </div>
</div>




<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?= $this->tag->submitButton(['Save', 'class' => 'btn btn-default']) ?>
    </div>
</div>

</form>
