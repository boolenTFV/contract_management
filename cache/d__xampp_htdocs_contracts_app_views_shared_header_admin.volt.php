
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
  <?= $this->tag->linkTo(['', 'ВПИ', 'class' => 'navbar-brand']) ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Управление договорами
        </a>
        <div class="dropdown-menu">
          <?= $this->tag->linkTo(['contract', 'Журнал договоров', 'class' => 'dropdown-item']) ?>
          <?= $this->tag->linkTo(['accounting', 'Учет', 'class' => 'dropdown-item']) ?>
          <?= $this->tag->linkTo(['contractor', 'Контрагенты', 'class' => 'dropdown-item']) ?>
          <?= $this->tag->linkTo(['organization', 'Организации', 'class' => 'dropdown-item']) ?>
          <hr/>
          <?= $this->tag->linkTo(['document', 'Шаблоны документов', 'class' => 'dropdown-item']) ?>
        </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Администрирование
          </a>
        <div class="dropdown-menu">
          <?= $this->tag->linkTo(['user', 'Пользователи', 'class' => 'dropdown-item']) ?>
          <?= $this->tag->linkTo(['department', 'Подразделения', 'class' => 'dropdown-item']) ?>
        </div>
      </li>
      <li class="nav-item">
         <?= $this->tag->linkTo(['#', 'Настройки', 'class' => 'nav-link']) ?>
      </li>    
      <li class="nav-item">
         <?= $this->tag->linkTo(['session/logout', 'Выйти', 'class' => 'nav-link']) ?>
      </li>       
    </ul>
  </div>
</nav>