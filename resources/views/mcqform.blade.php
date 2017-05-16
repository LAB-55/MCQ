<form action="/" method="post">
	{{ csrf_field() }}
	<select name="mcq_no" required>
		<option>Select Option</option>
		<option name="1" value="1">1</option>
		<option name="2" value="2">2</option>
		<option name="3" value="3">3</option>
		<option name="4" value="4">4</option>
		<option name="5" value="5">5</option>
	</select>

	<select name="type" required>
		<option>Select Option</option>
		<option name="withoutanswer" value="withoutanswer">Without Answer</option>
		<option name="withanswer" value="withanswer">With Answer</option>
	</select>

	<button type="submit" id="submit" value="submit">Submit</button>
	<br>
	<br>
	<iframe id="ifr" style=" display:none;width: 100%;height: 500px;"></iframe>
</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
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
</script>