<!DOCTYPE html>
<html>
<head>

	<title> MCQ Paper </title>

	<style type="text/css">
		body {
			border: 2px solid #000000;
			padding: 10px;
		}

		hr {
		    border-top: 2px solid #000000;
		}

		table {
			width: 100%;
		}

		.institute_name {
			text-align: center;
			font-size: 40px;
			font-weight: 700;
		}

		.left {
			text-align: left;
			font-size: 24px;
			width: 50% !important;
		}

		.right {
			text-align: right;
			font-size: 24px;
			width: 50% !important;
		}

		td {
			padding: 10px;
		}

		.question {
			font-size: 16px;
			font-weight: 700;
		}

		.option {
			font-size: 16px;
		}

	</style>
</head>
<body>

	<table>
		<tr>
			<td colspan="2" class="institute_name">{{$institute_name}}</td>
		</tr>
		<tr>
			<td class="left"><strong>Subject Name:</strong>
				@foreach ($subject as $s)
					{{$s->subjectname}},
				@endforeach
			</td>
			<td class="right"><strong>Date: </strong>{{$date}}</td>
		</tr>
		<tr>
			<td class="left"><strong>Module:</strong> 
				@foreach ($module as $m)
					{{$m->modulename}}, 
				@endforeach
			</td>
			<td class="right"><strong>Marks: </strong>{{$total_mcq_no}}</td>
		</tr>
	</table>

	<hr>

	
	<table>
		<?php $id = 0;
			$option = array();
		?>
		@foreach ($que as $q)
				<tr>
					<td colspan="4" class="question"><strong>{{++$id}}.</strong> {{$q->question}}</td>
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
					<td class="option"><strong>A.</strong> <?php echo $shuffle_options[0]; ?></td>
					<td class="option"><strong>B.</strong> <?php echo $shuffle_options[1]; ?></td>
					<td class="option"><strong>C.</strong> <?php echo $shuffle_options[2]; ?></td>
					<td class="option"><strong>D.</strong> <?php echo $shuffle_options[3]; ?></td>
				</tr>
			
		@endforeach
	</table>
	
	
	<p style="page-break-before: always"></p>
	@if ($type == "withanswer")
		<h2>Answer:</h2>
		<table>
		<tr>
			<?php $id = 0; ?>
			@foreach ($option as $o)
						<td style="width: 60px!important;border:1px solid black;"><strong>{{++$id}}. </strong><?php echo $o ?></td>
					@if( $id % 8 == 0 ) 
						</tr><tr>
					@endif
			@endforeach
		</tr>
		</table>
	@endif
	


</body>
</html>

