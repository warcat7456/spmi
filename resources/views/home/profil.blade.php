@extends('template.HomeView', ['title' => $page->title])
@section('styles')
    <style>
        html,
        body {
            height: 100%;
        }

        main {
            height: 100%;
        }

        .card {
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="container p-2 p-md-3 ">
        <article class="card p-2 p-md-3 rounded">
            <h2 style="text-decoration: underline;color:#0082ad;" class="mb-1">{{ $page->title }}</h2>
            {!! $page->content !!}
        </article>
    </main>
    <!-- End #main -->
@endsection
