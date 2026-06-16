# nexphant View Engine

Lightweight view engine with Blade-like syntax and hybrid rendering support.

## Installation

```bash
composer require nexphant/view
```

## Usage

```php
return view('home', ['title' => 'nexphant']);
```

## Syntax

```blade
{{ $title }}
{!! $html !!}
@if ($user)
@endif
@foreach ($users as $user)
@endforeach
@include('partials.card')
@island('Counter', ['count' => 0])
```

## License

MIT
