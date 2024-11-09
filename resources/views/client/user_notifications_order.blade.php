{{-- Nơi hiển thị các thông báo cho người dùng --}}
@extends('client.layout.user_page')
@section('title')
    Thông báo
@endsection
@section('main_user')
    @if ($notiList && $notiList->isNotEmpty())
        <a href="{{ route('notifications.seenAll') }}" class="btn btn-link">Đánh dấu đã đọc</a>
        <hr>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @foreach ($notiList as $item)
            <a href="{{ route('notifications.seen', $item->id) }}" class="card mb-3 text-decoration-none">
                <div class="row g-0 alert p-0 m-0 {{ $item->seen == 0 ? 'alert-' . $item->type : '' }}">
                    <div class="col-md-4 d-flex justify-content-between align-items-center">
                        <img src="{{ asset('assets/image/' . $item->image_url) }}" height="100%" width="100%" class="object-fit-fill overflow-hidden rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><small class="text-body-secondary">{{ $item->created_at->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    @else
        <div class="alert alert-primary">
            <h4 class="text-center">Chưa có thông báo mới!</h4>
        </div>
    @endif
@endsection
