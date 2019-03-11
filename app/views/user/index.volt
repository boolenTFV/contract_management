<div class="page-header">
    <h1>
        Пользователи
    </h1>
    <p>
        {{ link_to("user/new", "Create user") }}
    </p>
</div>



{{ form("user/index", "method":"post", "autocomplete" : "off", "class" : "form-inline") }}
<div class="form-group">
    <label for="search" class="col-sm-2 control-label">поиск</label>
    {{ text_field("search", 'placeholder':'поиск', "class" : "form-control", "id" : "search") }}
    <div class="input-group-append">
        <div>
            {{ submit_button('Search','class': 'btn btn-info') }}
        </div>
    </div>
</div>

</form>
<div class="pt-2 pb-2">
{{ content() }}
</div>
{% if page.total_pages!=null %}
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                <th>ФИО</th>
                <th>Email</th>
                <th>Type</th>
                <th>Department</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            {% if page.items is defined %}
            {% for user in page.items %}
                <tr>
                    <td>{{ user.id }}</td>
                <td>{{ user.surname~" "~user.name~" "~user.patronymic }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.type }}</td>
                <td>
                    {% if(user.department_id is defined) %}
                        {{ user.department.abbreviation }}
                    {% endif %}
                </td>
                    {% if user.is_active %}
                        <td>{{ link_to("user/active/"~user.id, '<i class="fas fa-unlock"></i>', 'class':'text-success') }}</td>
                    {% else %}
                        <td>{{ link_to("user/active/"~user.id, '<i class="fas fa-lock"></i>', 'class':'text-danger') }}</td>
                    {% endif %}
                    <td>{{ link_to("user/edit/"~user.id, '<i class="fas fa-pencil-alt "></i>', 'class':'text-primary') }}</td>
                    <td>{{ link_to("user/delete/"~user.id, '<i class="fas fa-trash-alt"></i>', 'class':'text-primary') }}</td>
                </tr>
            {% endfor %}
            {% endif %}
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'user/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>
{% endif %}

