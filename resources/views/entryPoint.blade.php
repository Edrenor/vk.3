<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">>
<head>
	<title></title>
</head>
<body>
	@foreach($array as $row)
		@if (array_key_exists("attachments", $row))
		<p>{{$row['text']}}</p>

			@foreach($row['attachments'] as $attachment)

				@if ($attachment['type'] == "photo")
					<img src="{{$attachment['url']}}">>
				@elseif ($attachment['type'] == "doc")
					<iframe width='480' height='360' src='{{$attachment['url']}}' frameborder='0' allowfullscreen></iframe>
				@elseif ($attachment['type'] == "video")
					<iframe width='480' height='360' src='{{$attachment['url']}}' frameborder='0' allowfullscreen></iframe>
				@endif

			@endforeach
		<a href='{{ route('postSave', ['id' => $row['id']]) }}' target='_blank'><button>Пиздануть</button></a>
		@endif
	@endforeach

	<!--/save.php?id=" . $post_id["0"]["id"] . "


	-->
</body>
</html>