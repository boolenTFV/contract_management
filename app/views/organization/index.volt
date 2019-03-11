<div class="page-header">
    <h1>
        Организации
    </h1>
    <p>
        {{ link_to("organization/new", "Create organization") }}
    </p>
</div>

{{ form("organization/index", "method":"post", "autocomplete" : "off", "class" : "form-inline pb-4") }}
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
                <th>Id</th>
            <th>Name</th>
            <th>Index</th>
            <th>Bank Of Index</th>
            <th>Bank Of Account</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for organization in page.items %}
            <tr>
                <td>{{ organization.id }}</td>
            <td>{{ organization.name }}</td>
            <td>{{ organization.index }}</td>
            <td>{{ organization.bank_index }}</td>
            <td>{{ organization.bank_account }}</td>

                <td>{{ link_to("organization/edit/"~organization.id, '<i class="fas fa-pencil-alt "></i>', 'class':'text-primary') }}</td>
                <td>{{ link_to("organization/delete/"~organization.id, '<i class="fas fa-trash-alt"></i>', 'class':'text-danger') }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'department/index/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>
{% endif %}
