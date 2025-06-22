@extends('layouts.UserLayout')
@section('title', 'Tin nhắn của bạn')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-black">
        📨 Phản hồi từ Quản trị viên 
        <span class="badge bg-info text-dark">{{ $contacts->count() }} tin nhắn</span>
    </h2>

    <!-- Form gửi tin nhắn -->
    <div class="card mb-5 shadow-sm rounded-3">
        <div class="card-body">
            <h5 class="mb-3">✍️ Gửi tin nhắn mới</h5>
        </div>
    </div>

    <!-- Danh sách tin nhắn -->
    @forelse ($contacts as $contact)
        <div class="card mb-4 shadow-sm rounded-3">
            <div class="card-body">
                <!-- Tin nhắn người dùng -->
                <div class="mb-3">
                    <span class="badge bg-primary">Bạn</span>
                    <span class="ms-2">{{ $contact->message }}</span><br>
                    <small class="text-muted">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
                </div>

                <!-- Các phản hồi từ admin -->
                @forelse ($contact->replies as $reply)
                    <div class="mb-2">
                        <span class="badge bg-success">Admin</span>
                        <span class="ms-2">{{ $reply->reply }}</span><br>
                        <small class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                @empty
                    <p class="text-muted mb-0"><i>⏳ Chưa có phản hồi từ quản trị viên.</i></p>
                @endforelse
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            📭 Bạn chưa gửi tin nhắn nào.
        </div>
    @endforelse
</div>
@endsection
