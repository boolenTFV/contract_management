<div class="page-header">
    <h1>
        Учет
    </h1>
</div>



{{ form("user/index", "method":"post", "class" : "form-inline") }}
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
<div class="pt-2 pb-2">
{{ content() }}
{{ sflash.output() }}
</div>


    <div class="row">
        <div>
            {{ form("record/save/"~id, "id":"editTable","method":"post") }}
            <table class="table table-bordered w-100">
                <tr>
                    <th>Подразделение</th>
                    <th>Номер</th>
                    <th width="30">Дата поступления</th>
                    <th >Предыдущий остаток</th>
                    <th>Поступления</th>
                    <th>Налог (%)</th>
                    <th>Зарплата</th>
                    <th>Дополнительные расходы</th>
                    <th style="min-width: 130px">Расход</th>
                    <th style="min-width: 130px">Доход</th>
                    <th style="min-width: 130px">Остаток</th>
                    
                    <th><a  class="btn btn-info w-100 submit-edit"><i class="far fa-save"></i></button></th>

                </tr>
                <tr class = "add-content">
                    <td></td>
                    <td>
                        <input type="hidden" name="contract_id"/>
                        <input type="text" class= "w-100 form-control border-success contract_number pl-1 pr-1" />
                    </td>
                    <td><input type="date" style="font-size: 10pt; width:150px" class= "form-control border-success pl-1" name="admission_date"/></td>
                    <td><input type="text" class= "w-100 form-control border-success calc reminder pl-1 pr-1" name="reminder"/></td>
                    <td><input type="text" class= "w-100 form-control border-success calc admission" name="admission"/></td>
                    <td><input type="text" class= "w-100 form-control border-success calc tax" name="tax" value="0.2" /></td>
                    <td><input type="text" class= "w-100 form-control border-success calc wage" name="wage" /></td>
                    <td><input type="text" class= "w-100 form-control border-success calc additional_expenses" name="additional_expenses"/></td>
                    <td><input type="text" class= "w-100 form-control border-success calc expenses pl-1 pr-1" /></td>
                    <td><input type="text" class= "w-100 form-control border-success calc income pl-1 pr-1" /></td>
                    <td><input type="text" class= "w-100 form-control border-success calc new_reminder pl-1 pr-1" /></td>
                    <td><a href ="#"  data-url ={{url.get("record/create/"~id)}} class="submit-add btn btn-success text-light w-100"><i class="fas fa-plus"></i></a></td>
                </tr>
            {% if page.total_pages!=null %}
            {% if page.items is defined %}
            {% for accountingRecord in page.items %}
            
                <tr class = "edit-content">
                    <td class="pt-1 pb-0">
                        {{ accountingRecord.contract.department.abbreviation }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ hidden_field(  "record["~accountingRecord.id~"][contract_id]",
                                    "value":accountingRecord.contract_id
                                    ) }}
                        {{ text_field(  "",
                                        "class":"w-100 form-control contract_number pl-1 pr-1",
                                        "value":accountingRecord.contract.contract_number
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ date_field(  "record["~accountingRecord.id~"][admission_date]",
                                        "style":"font-size: 10pt; width:150px",
                                        "class":"form-control pl-1 pr-1",
                                        "value":accountingRecord.admission_date
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ text_field(  "record["~accountingRecord.id~"][reminder]",
                                        "class":"w-100 form-control calc reminder pl-1 pr-1",
                                        "value":accountingRecord.reminder
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ text_field(  "record["~accountingRecord.id~"][admission]",
                                        "class":"w-100 form-control calc admission pl-1 pr-1",
                                        "value":accountingRecord.admission
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ text_field(  "record["~accountingRecord.id~"][tax]",
                                        "class":"w-100 form-control calc tax pl-1 pr-1",
                                        "value":accountingRecord.tax
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ text_field(  "record["~accountingRecord.id~"][wage]",
                                        "class":"w-100 form-control calc wage pl-1 pr-1",
                                        "value":accountingRecord.wage

                                        ) }}
                    </td>
                    <td class="pt-1 pb-0">
                        {{ text_field(  "record["~accountingRecord.id~"][additional_expenses]",
                                        "class":"w-100 form-control calc additional_expenses pl-1 pr-1",
                                        "value":accountingRecord.additional_expenses
                                        ) }}
                    </td>
                    <td class="pt-1 pb-0"><input type="text" class= "w-100 form-control expenses calc pl-1 pr-1"/></td>
                    <td class="pt-1 pb-0"><input type="text" class= "w-100 form-control income calc pl-1 pr-1"/></td>
                    <td class="pt-1 pb-0"><input type="text" class= "w-100 form-control new_reminder calc pl-1 pr-1"/></td>
                    <td class="pt-1 pb-0">
                        {{ link_to("record/delete/"~id~"/"~accountingRecord.id,
                                    '<i class="fas fa-backspace"></i>',
                                    "class":"btn btn-danger text-light w-100") }}
                    </td>
                </tr>

           
            {% endfor %}
                <tr>
                    <td colspan="12" class="text-center"><a href="#" class="btn btn-info w-50 submit-edit"><i class="far fa-save"></i> Сохранить</a></td>
                </tr>
            {% endif %}
            {% endif %}
            </table>
            {{ end_form() }}
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <?
        echo CustomTags::pagination([
                        'link' => 'record/index/"~id~"/?page=%d',
                        'current' => $page->current,
                        'next' => $page->next,
                        'before' => $page->before,
                        'count'   => $page->total_pages,
                    ]);
    ?>
</div>


