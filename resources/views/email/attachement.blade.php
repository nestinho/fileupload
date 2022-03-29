<h1>Your image {{ $title }}</h1>

<img src="{{ $message->embed(storage_path('app/'.$path)) }}" alt="" width="400" />