
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
  {{ link_to("","ВПИ","class":"navbar-brand") }}
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
          {{ link_to("contract","Журнал договоров","class":"dropdown-item") }}
          {{ link_to("accounting","Учет","class":"dropdown-item") }}
          {{ link_to("contractor","Контрагенты","class":"dropdown-item") }}
          {{ link_to("organization","Организации","class":"dropdown-item") }}
          <hr/>
          {{ link_to("document","Шаблоны документов","class":"dropdown-item") }}
        </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Администрирование
          </a>
        <div class="dropdown-menu">
          {{ link_to("user","Пользователи","class":"dropdown-item") }}
          {{ link_to("department","Подразделения","class":"dropdown-item") }}
        </div>
      </li>
      <li class="nav-item">
         {{ link_to("#","Настройки","class":"nav-link") }}
      </li>    
      <li class="nav-item">
         {{ link_to("session/logout","Выйти","class":"nav-link") }}
      </li>       
    </ul>
  </div>
</nav>