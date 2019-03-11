<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("contract/index", "Go Back") }}</li>
            <li class="next">{{ link_to("contract/new", "Create ") }}</li>
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
            <th>Department</th>
            <th>Contract Of Number</th>
            <th>Date</th>
            <th>Theme</th>
            <th>Product Of Name</th>
            <th>Work Of сompletion</th>
            <th>Product Of Use Of Method</th>
            <th>Transfer Of Mony</th>
            <th>Pay Of Method</th>
            <th>Surcharge</th>
            <th>Surcharge Of сondition</th>
            <th>Fine</th>
            <th>Fine Of Conditions</th>
            <th>Start Of Date</th>
            <th>End Of Date</th>
            <th>Transfer Of Right</th>
            <th>Publication Of Rights</th>
            <th>Other Of Rights</th>
            <th>Trunsfer Of Profit Of Percent</th>
            <th>Contractor</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for contract in page.items %}
            <tr>
                <td>{{ contract.id }}</td>
            <td>{{ contract.department_id }}</td>
            <td>{{ contract.contract_number }}</td>
            <td>{{ contract.date }}</td>
            <td>{{ contract.theme }}</td>
            <td>{{ contract.product_name }}</td>
            <td>{{ contract.work_сompletion }}</td>
            <td>{{ contract.product_use_method }}</td>
            <td>{{ contract.transfer_mony }}</td>
            <td>{{ contract.pay_method }}</td>
            <td>{{ contract.surcharge }}</td>
            <td>{{ contract.surcharge_сondition }}</td>
            <td>{{ contract.fine }}</td>
            <td>{{ contract.fine_conditions }}</td>
            <td>{{ contract.start_date }}</td>
            <td>{{ contract.end_date }}</td>
            <td>{{ contract.transfer_right }}</td>
            <td>{{ contract.publication_rights }}</td>
            <td>{{ contract.other_rights }}</td>
            <td>{{ contract.trunsfer_profit_percent }}</td>
            <td>{{ contract.contractor_id }}</td>

                <td>{{ link_to("contract/edit/"~contract.id, "Edit") }}</td>
                <td>{{ link_to("contract/delete/"~contract.id, "Delete") }}</td>
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
                <li>{{ link_to("contract/search", "First") }}</li>
                <li>{{ link_to("contract/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("contract/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("contract/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
