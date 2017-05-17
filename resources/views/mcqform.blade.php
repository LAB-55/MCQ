<!DOCTYPE html>
<html>
<head>

	<title>MCQ Paper Form</title>

	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style type="text/css">
		.left {
			width: 40%;
			padding: 20px;
			float: left;
		}
		.right {
			width: 60%;
			padding: 20px;
			float: right;
		}
		iframe {
			width: 100%;
			height: 600px;
		}
	</style>

</head>
<body>

	<div class="left">
		<form action="/" method="post">
			{{ csrf_field() }}
			
			<div class="form-group">
				<label>Total MCQ : </label>
				<input class="form-control" type="number" id="total_mcq_no" name="total_mcq_no" placeholder="100" required>
			</div>

			<div class="form-group">
				<label>Answer : </label>
				<select class="form-control" id="type" name="type" required>
					<option>Select Option</option>
					<option name="withoutanswer" value="withoutanswer">Without Answer</option>
					<option name="withanswer" value="withanswer">With Answer</option>
				</select>
			</div>
			
			<label>MCQ Type :</label>
			<div id="mcqdetails" class="mcqdetails">
				<div class="mcqtype" style="border: 2px solid; padding: 20px; margin-bottom: 20px;">
					<div class="form-group">
						<label>Subject : </label>
						<select class="form-control" id="subject" name="subject[]" required>
							<option>Select Option</option>
							@foreach ($subject as $s)
							<option name="{{$s->subjectid}}" value="{{$s->subjectid}}">{{$s->subjectname}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Module : </label>
						<select class="form-control" id="module" name="module[]" required disabled>
							<option value="">Select Option</option>
						</select>
					</div>

					<div class="form-group">
						<label>No. of MCQ : </label>
						<input class="form-control" type="number" id="mcqno" name="mcqno[]" placeholder="100" required>
					</div>

					<button class='btn mcq-delete btn-danger' type="button" onclick='del_parent(this)'><i class='fa fa-trash'></i></button>
				</div>
			</div>

			<div id="add" class="add" style="text-align: right;">
				<button id="add" type="button" class="btn btn-info">
					<i class="fa fa-plus"></i>
				</button>
			</div>

			<button type="submit" id="submit" class="btn btn-success" value="submit">Submit</button>

		</form>
	</div>

	<div class="right">
		<iframe id="ifr" style=" display:none;"></iframe>
	</div>

	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/mcq.js"></script>

</body>
</html>

