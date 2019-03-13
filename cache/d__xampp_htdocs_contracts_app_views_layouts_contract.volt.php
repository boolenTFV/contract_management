<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

<div class="container-fluid flex-grow-1" style="padding-left: 90px; padding-right: 90px;">
    <?= $this->getContent() ?>
</div>

<script type="text/javascript">
	var department = $('#department');
	department.typeahead({
		source: function(query, result)
		{
			$.ajax({
				url:"<?= $this->url->get('department/get') ?>",
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
				url:"<?= $this->url->get('contractor/get') ?>",
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


	var getTemplateBtn = $('.get-template').click(function (){
		let id = $(this).data('contract');
		$.ajax({
			url: '<?= $this->url->get('document/get') ?>',
			dataType:'json',
			success: function (data){
				let tabel = $('#templatesTable');
				tabel.html('');
				let tr;
				let tdName;
				let td;
				let icon = '<i class="fas fa-file-download fa-2x"></i>';
				let a;
				for(i in data){
					tr = $('<tr>');
					td = $('<td>');
					td.text(data[i]['name']);
					tr.append(td);

					td = $('<td>').addClass('text-right');
					a=$('<a>');
					a.attr("href","<?= $this->url->get('document/generate') ?>/"+data[i]['id']+'/'+id);
					a.html(icon);
					td.append(a);
					tr.append(td);
					
					tabel.append(tr);
				}				
				
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert('Ошибка: '+textStatus);
			}
		});
	});
</script>