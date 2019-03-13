<div class="page-header">
    <h1>
        Search document
    </h1>
    <p>
        {{ link_to("document/new", "Create document") }}
    </p>
</div>

{{ content() }}

{{ form("document/search", "method":"post", "autocomplete" : "off", "class" : "form-inline") }}

<div class="form-group pb-3">
    <label for="fieldTemplate" class="control-label pr-3">Поиск</label>
    <div class="pr-1">
        {{ text_field("template", "size" : 30, "class" : "form-control", "id" : "fieldTemplate") }}
    </div>
    <div class="">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>
{{ end_form() }}

{% if page.total_pages !=null %}
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <!--<th>Id</th>-->
                <!--<th>Contract</th>-->
                <th>Template</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for document in page.items %}
            <tr>
                <!--<td>{{ document.id }}</td>-->
                <!--<td>{{ document.contract_id }}</td>-->
                <td>{{ document.template }}</td>

                <td class="text-right">
                    {{ link_to("document/generate/"~document.id, '<i class="fas fa-file-alt pr-2"></i>', 'class':'text-primary') }}
                    {{ link_to("document/edit/"~document.id, '<i class="fas fa-pencil-alt pr-2"></i>', 'class':'text-primary') }}
                    {{ link_to("document/delete/"~document.id, 
                        '<i class="fas fa-trash-alt"></i>', 'class':'text-danger') }}
                </td>
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

</form>
