<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
<div class="container flex-grow-1">
    <?= $this->getContent() ?>
</div>
<script type="text/javascript">
	var organization = $('#organization');
	organization.typeahead({
		source: function(query, result)
		{
			$.ajax({
				url:"<?= $this->url->get('organization/get') ?>",
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
			organization.filter(":focus").prev().val(item["id"]);
		}
	});
</script>