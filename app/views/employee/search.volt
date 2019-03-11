<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("employee/index", "Go Back") }}</li>
            <li class="next">{{ link_to("employee/new", "Create ") }}</li>
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
            <th>Surename</th>
            <th>Patronymic</th>
            <th>Position</th>
            <th>Department</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for employee in page.items %}
            <tr>
                <td>{{ employee.id }}</td>
            <td>{{ employee.name }}</td>
            <td>{{ employee.surename }}</td>
            <td>{{ employee.patronymic }}</td>
            <td>{{ employee.position }}</td>
            <td>{{ employee.department_id }}</td>

                <td>{{ link_to("employee/edit/"~employee.id, "Edit") }}</td>
                <td>{{ link_to("employee/delete/"~employee.id, "Delete") }}</td>
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
                <li>{{ link_to("employee/search", "First") }}</li>
                <li>{{ link_to("employee/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("employee/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("employee/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
