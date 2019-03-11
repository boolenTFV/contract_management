<div class="modal fade" id="auth_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Войти</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ form('session/auth', 'method': 'post') }}
            <div class="form-group">
              <label for='name'>email</label>
              {{ text_field('email', 'size': 32, 'class':'form-control') }}
            </div>
            <div class="form-group">
              <label for='type'>Пароль</label>
              {{ password_field('password', 'size':32, 'class':'form-control')}}
            </div>
            {{ submit_button('Войти', 'class':'btn btn-primary') }}

            {{ end_form() }}
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="reg_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Зарегистрироваться</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Содержимое модального окна
          </div>
      </div>
    </div>
</div>




<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
  {{ link_to("","ВПИ","class":"navbar-brand") }}
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <button type="button" class="btn btn-outline-primary ml-2" data-toggle="modal" data-target="#auth_modal">
          Войти
        </button>
      </li>
      <li class="nav-item">
        {{link_to("user/new","Зарегистрироваться", "class":"btn btn-outline-secondary ml-2")}}
      </li>
    </ul>
  </div>
</nav>