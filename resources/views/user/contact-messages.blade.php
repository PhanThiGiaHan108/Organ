@extends('layouts.UserLayout')
@section('title', 'Tin nhắn của bạn')

@section('content')
<div class="mt-5">
    <h4 class="mb-4">📨 Phản hồi từ Admin</h4>

    @forelse ($contacts as $contact)
        <div class="mb-4 border rounded-3 p-3 bg-light">
            <!-- Tin nhắn người dùng -->
            <div class="mb-2">
                <span class="fw-bold text-primary">Bạn:</span>
                <span>{{ $contact->message }}</span><br>
                <small class="text-muted">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
            </div>

            <!-- Các phản hồi từ admin -->
            @forelse ($contact->replies as $reply)
                <div class="mt-2">
                    <span class="fw-bold text-success">Admin:</span>
                    <span>{{ $reply->reply }}</span><br>
                    <small class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @empty
                <div class="text-muted mt-2">⏳ Chưa có phản hồi từ admin.</div>
            @endforelse
        </div>
    @empty
        <div class="text-center text-muted fs-5">📭 Bạn chưa gửi tin nhắn nào.</div>
    @endforelse
</div>

@endsection
