<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

{!! $seo->buildGenerates() !!}

<link rel="stylesheet" href="{{asset('/css/app.min.css')}}?v={{sha1_file(public_path().'/css/app.min.css')}}">

<link rel="shortcut icon" href="/public/favicon.ico" type="image/x-icon">

{{-- visually impaired plagin --}}
<link rel="stylesheet" href="{{asset('lib/visually-impaired/dist/css/bvi.min.css')}}" type="text/css">