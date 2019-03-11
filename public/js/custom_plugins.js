function EditTable(selector){ 
		selector = 'form'+selector;	
		var j =$(selector);
		var k =$(selector).find("input");
		var form = $(selector);
		
		form.find('input').attr('autocomplete','off');
		form.find('input').addClass("nonedit");
		form.find(".submit-edit").click(function(e){
			$('.add-content').html('');
			form.submit();
		});
		form.find(".submit-add").click(function(e){
			alert("АААААА");
			e.preventDefault();
			$('.edit-content').html('');
			form.attr("action",$(this).data("url"));
			form.submit();
		});
		form.find("input").dblclick(function(){
			$(this).addClass("edited");
			$(this).removeClass("nonedited");
		});
		form.find("input").focus(function(){
			EditTable.holder=$(this).val();
		});
		form.find("input").blur(function(){
			$(this).removeClass("edited");
			$(this).addClass("nonedited");
		});
		form.keydown(function(e){
			switch(e.which){
				case 39:{
					var input = $("input:focus");
					if(!input.hasClass("edited")){
						input.parent().next().first().find('input').focus();
					}else{
						var selec=input[0].selectionStart;
						if(selec==input.val().length){
							$("input:focus").removeClass("edited");
							$("input:focus").addClass("nonedited");
						}
					}
				}break;
				case 37:{
					var input = $("input:focus");
					if(!input.hasClass("edited")){
						$("input:focus").parent().prev().first().find('input').focus();
					}else{
						var selec=input[0].selectionStart;
						if(selec==0){
							$("input:focus").removeClass("edited");
							$("input:focus").addClass("nonedited");
						}
					}
				}break;
				case 40:{
					input=$("input:focus");
					if(!input.hasClass("edited")){
						var td = $("input:focus").parent();
						var tr = td.parent();
						var index = tr.children().index(td);
						tr.next().first().children('td:eq('+index+')').children().focus();
					}
				}break;
				case 38:{
					input=$("input:focus");
					if(!input.hasClass("edited")){
						var td = $("input:focus").parent();
						var tr = td.parent();
						var index = tr.children().index(td);
						tr.prev().first().children('td:eq('+index+')').children().focus();
					}

				}break;
				case 27:{
					if(EditTable.holder!=null){
						$("input:focus").val(EditTable.holder);
					}
					$("input:focus").removeClass("edited");
				}break;
				case 13:{
					var input = $("input:focus");
					if(input.hasClass("edited")){
						input.removeClass("edited");
						input.addClass("nonedited");
						var td = $("input:focus").parent();
						var tr = td.parent();
						var index = tr.children().index(td);
						tr.next().first().children('td:eq('+index+')').children().focus();
					}else{
						input.addClass("edited");
						input.removeClass("nonedited");
						input[0].setSelectionRange(0, 0);
					}
				}break;
				case 9:break;
				default:{
					var input = $("input:focus");
					if(!input.hasClass("edited")){
						$("input:focus").addClass("edited");
						inputNode = input[0];
						inputNode.setSelectionRange(0, input.val().length);
					}
				}
				
			}
		});
	}
	function linkElement(selector){
		$(selector).css("cursor","pointer");
		$(selector).click(function(){
			location.href=$(this).data("url");
		});
	}