<h1>Questions:</h1>
<table border="1"  cellspacing="0" cellpadding="2">
	<?php $id = 0;
		$option = array();
	?>
	@foreach ($que as $q)
		<tr>
			<td colspan="4"><strong>{{++$id}}.</strong> {{$q->question}}</td>
		</tr>
		<?php 
			$answer = $q->answer;
			$option1 = $q->option1;
			$option2 = $q->option2;
			$option3 = $q->option3;
			$options = array($q->answer, $q->option1, $q->option2, $q->option3);
			$shuffle_options = $options;
			shuffle($shuffle_options);
			switch ($answer) {
				case $shuffle_options[0]:
					array_push($option, 'A');
					break;
				case $shuffle_options[1]:
					array_push($option, 'B');
					break;
				case $shuffle_options[2]:
					array_push($option, 'C');
					break;
				case $shuffle_options[3]:
					array_push($option, 'D');
					break;
			}
		?>
		<tr>
			<td><strong>A.</strong> <?php echo $shuffle_options[0]; ?></td>
			<td><strong>B.</strong> <?php echo $shuffle_options[1]; ?></td>
			<td><strong>C.</strong> <?php echo $shuffle_options[2]; ?></td>
			<td><strong>D.</strong> <?php echo $shuffle_options[3]; ?></td>
		</tr>
	@endforeach
</table>

@if ($type == "withanswer")
	<h2>Answer:</h2>
	<table>
	<tr>
		<?php $id = 0; ?>
		@foreach ($option as $o)
					<td style="width: 60px!important;border:1px solid black;"><strong>{{++$id}}. </strong><?php echo $o ?></td>
				@if( $id % 10 == 0 ) 
					</tr><tr>
				@endif
		@endforeach
	</tr>
	</table>
@endif
