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
        {{ link_to("contract/new", '<i class="fas fa-plus-square"></i> Добавить договор' ) }}
    </p>
</div>



{{ form("contract/index", "method":"post", "autocomplete" : "off", "class" : "form-inline pb-4") }}
    <div class="form-group">
        <label for="search" class="col-sm-2 control-label">поиск</label>
        {{ text_field("search", 'placeholder':'поиск', "class" : "form-control", "id" : "search") }}
        <div class="input-group-append">
            <div>
                {{ submit_button('Search','class': 'btn btn-info') }}
            </div>
        </div>
    </div>
{{ end_form() }}
{{ content() }}

{% if page.total_pages !=null %}
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
        {% for contract in page.items %}
            {% switch contract.status %}
                {% case 'unverified' %}
                    {% set tr_class="bg-warning text-white" %}
                    {% break %}
                {% case 'verified' %}
                    {% set tr_class="bg-success text-white" %}
                    {% break %}
                {% case 'active' %}
                    {% set tr_class="bg-light text-dark" %}
                    {% break %}
                {% case 'closed' %}
                    {% set tr_class="bg-dark text-white" %}
                    {% break %}
                {% default %}
                    {% set tr_class="bg-light text-dark"%}
            {% endswitch %}
            <tr class="{{ tr_class }}">
                <td>{{ contract.department.abbreviation }}</td>
                <td>{{ contract.contract_number }}</td>
                <td>{{ contract.date }}</td>
                <td>{{ contract.theme }}</td>
                <td>{{ contract.start_date }}</td>
                <td>{{ contract.end_date }}</td>
                <td>{{ contract.contractor.organization.name }}</td>
                <td>
                    {% if role != 'user' %}
                            {{ form("contract/setstatus", "method":"post",  "class" : "form-inline mr-0 p-0") }}
                             <div class="form-group mr-0 p-0">
                            {{ hidden_field("id","value":contract.id) }}
                            {% set options = ['unverified':'Не проверен',
                                              'verified':'Проверен',
                                              'active':'Активен',
                                              'closed':'Закрыт'] %}
                            <select name ='status' class="bg-light form-control">
                                {% for value,option in options %}
                                    {% if value == contract.status %}
                                        <option value="{{value}}" selected>
                                             {{option}}
                                        </option>                                   
                                    {% else %}
                                        <option value="{{value}}">
                                            {{option}}
                                        </option>
                                    {% endif %}
                                {% endfor %}

                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary ml-1">
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                        {{ end_form() }}
                    {%else%}
                        {{contract.status}}
                    {% endif %}


                    
                </td>
                <td class="text-center">
                    {{ link_to("#", '<i class="fas fa-file-alt"></i>', 
                                    'class':'text-primary get-template pr-1',
                                    'data-contract':contract.id,
                                    'data-toggle':"modal", 
                                    'data-target':'#templatesModal') }}
                    {{ link_to("contract/edit/"~contract.id, '<i class="fas fa-pencil-alt pr-1"></i>', 'class':'text-primary') }}
                    {{ link_to("contract/delete/"~contract.id, '<i class="fas fa-trash-alt"></i>', 'class':'text-danger') }}
                </td>
            </tr>
        {% endfor %}
       
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
 {% endif %}


