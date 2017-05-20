$('#subject').change(function(){
var subjectid = $(this).val();
// console.log(subject_id)    
if(subjectid.length>0){
	$.get("/getmodulelist/"+subjectid , function( d ){
		$('#module').empty();
		$.each(d,function(k, module){
			// console.log(module);
			var opt = $('<option>',{
						value:module.moduleid,
						text:module.modulename
					});
			$('#module').append( opt );
		});
		$('#module').removeAttr("disabled");

	});
}else{
    $('#module').empty();
}      
});




function del_parent( btn ){
	$(btn).closest('.mcqtype').remove();
};

var mcq_html = $("#mcqdetails").html();

$(".mcq-delete").remove();

$(function() {
  $("#add").click(function() {
      $("#mcqdetails").append( mcq_html );
    });
});


$(document).ready(function () {
	$('form').on('submit',function () {
			$('#ifr').hide();

		var ar = $(this).serialize();
		$('#submit').attr('disabled','true');
		$('#submit').html('Generating..');

		$.post('/',ar).done(function(res){
			$('#ifr').attr('src','/pdf/'+res);
			$('#ifr').show();
			$('#submit').html('Re-Generate');
			$('#submit').removeAttr('disabled');

		});

		return false;
	});
});