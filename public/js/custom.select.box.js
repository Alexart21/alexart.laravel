$(document).ready(function() {
	enableSelectBoxes();
});

function enableSelectBoxes(){
	$('div.selectBox').each(function(){
		$(this).children('input.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
		$(this).attr('value',$(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));
		
		$(this).children('input.selected').click(function(){
			let list = document.querySelector('.selectOptions');
			// console.log(list.childElementCount)
			if(list.childElementCount){
				if($(this).parent().children('div.selectOptions').css('display') == 'none'){
					$(this).parent().children('div.selectOptions').css('display','block');
				}
				else
				{
					$(this).parent().children('div.selectOptions').css('display','none');
				}
			}
		});
		
		$(this).find('span.selectOption').click(function(){
			$(this).parent().css('display','none');
			$(this).closest('div.selectBox').attr('value',$(this).attr('value'));
			$(this).parent().siblings('input.selected').val($(this).html());
			let q = $(this).html();
			console.log(q);
			// fetch
		});
	});				
}

let test = document.getElementById('test');
test.onclick = () => {
	document.querySelector('.selectOptions').style.display = 'block';
}