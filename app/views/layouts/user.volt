<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>


<div class="container flex-grow-1">
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
</script>