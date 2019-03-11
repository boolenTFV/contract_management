<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("organization/index", "Go Back") }}</li>
            <li class="next">{{ link_to("organization/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

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

                <td>{{ link_to("organization/edit/"~organization.id, "Edit") }}</td>
                <td>{{ link_to("organization/delete/"~organization.id, "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("organization/search", "First") }}</li>
                <li>{{ link_to("organization/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("organization/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("organization/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
