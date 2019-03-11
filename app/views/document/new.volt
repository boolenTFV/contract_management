<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("document", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create document
    </h1>
</div>

{{ content() }}

{{ form("document/create", "method":"post",
        'enctype':"multipart/form-data", 
        "autocomplete" : "off", 
        "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldContractId" class="col-sm-2 control-label">Contract</label>
    <div class="col-sm-10">
        {{ hidden_field("contract_id", "type" : "numeric", "class" : "form-control", "id" : "fieldContractId") }}
        {{ text_field("contract", "class" : "form-control", "id" : "contract") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTemplate" class="col-sm-2 control-label">Название шаблона</label>
    <div class="col-sm-10">
        {{ text_field("template", "size" : 30, "class" : "form-control", "id" : "fieldTemplate") }}
    </div>
</div>
<div class="form-group">
    <label for="templateFileId" class="col-sm-2 control-label">Загрузить шаблон</label>
    <div class="col-sm-10 text-center">
        {{ file_field("template_file","class" : "form-control", "id" : "templateFileId") }}
    </div>
</div>

{{ hidden_field("id") }}

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Send', 'class': 'btn btn-default') }}
    </div>
</div>

{{end_form()}}
