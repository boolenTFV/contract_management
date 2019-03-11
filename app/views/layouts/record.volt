{{ javascript_include('js/custom_plugins.js') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>  

<div class="container-fluid flex-grow-1" style="padding-left: 80px; padding-right: 80px;">
    {{ content() }}
</div>


<script type="text/javascript">

	EditTable("#editTable");
	contractInput = $('.contract_number');
	contractInput.typeahead({
		source: function(query, result)
		{
			$.ajax({
				url:"{{url.get("contract/index")}}",
				method:"POST",
				data:{search:query},
				dataType:"json",
				success:function(data)
				{	res=[];
					data.forEach(function(element) {
					  res.push({'id':element["id"],'name':element["contract_number"],'department':element["department"]});
					});
					result(res);
				}
			})
		},
		showHintOnFocus: true,
		selectOnBlur: true,
		autoSelect: true,
		afterSelect: function(item){
			contractInput.filter(":focus").prev().val(item["id"]);
			contractInput.filter(":focus").parent().prev().text(item["department"])
		}
	});
	function calculate(){
		var input = $(this);
		if(isNaN(input.val())){
			input.val(0);
		}
		var tr = input.parent().parent();

		var reminder = tr.find(".reminder").val();
		reminder=(reminder=="" ? 0 : parseFloat(reminder));
		var admission = tr.find(".admission").val();
		admission=(admission=="" ? 0 : parseFloat(admission));
		var tax = tr.find(".tax").val();
		tax=(tax=="" ? 0 : parseFloat(tax));
		var wage = tr.find(".wage").val();
		wage=(wage=="" ? 0 : parseFloat(wage));
		var additional_expenses = tr.find(".additional_expenses").val();
		additional_expenses=(additional_expenses=="" ? 0 : parseFloat(additional_expenses));

		var expensesNode = tr.find(".expenses");
		var incomeNode = tr.find(".income");
		var expenses = (admission*tax)+wage+additional_expenses;
		var income =admission+reminder;

		 expensesNode.val(expenses);
		 incomeNode.val(income.toFixed(2));
		tr.find(".new_reminder").val(parseFloat((incomeNode.val())-parseFloat(expensesNode.val())).toFixed(2));
	}
	$(".calc").change(calculate);
	$("tr").each(function(){
		$(this).children("td").eq(4).children(".calc").each(calculate)
	});
</script>