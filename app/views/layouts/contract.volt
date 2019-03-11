<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

<div class="container-fluid flex-grow-1" style="padding-left: 90px; padding-right: 90px;">
    {{ content() }}
</div>

<script type="text/javascript">
	var department = $('#department');
	department.typeahead({
		source: function(query, result)
		{
			$.ajax({
				url:"{{url.get("department/get")}}",
				method:"POST",
				data:{search:query},
				dataType:"json",
				success:function(data)
				{	res=[];
					data.forEach(function(element) {
					  res.push({'id':element["id"],'name':element["name"]});
					});
					result(res);
				}
			})
		},
		showHintOnFocus: true,
		selectOnBlur: true,
		autoSelect: true,
		afterSelect: function(item){
			department.filter(":focus").prev().val(item["id"]);
		}
	});

	var contractor = $('#contractor');
	contractor.typeahead({
		source: function(query, result)
		{
			$.ajax({
				url:"{{url.get("contractor/get")}}",
				method:"POST",
				data:{search:query},
				dataType:"json",
				success:function(data)
				{	res=[];
					data.forEach(function(element) {
					  res.push({'id':element["id"],'name':element["surname"]+" "+element["organization"]});
					});
					result(res);
				}
			})
		},
		showHintOnFocus: true,
		selectOnBlur: true,
		autoSelect: true,
		afterSelect: function(item){
			department.filter(":focus").prev().val(item["id"]);
		}
	});

	$().load(function (){
		var getTemplateBtn = $('.get-template')
	})
</script>