@extends('layouts.AdminLayout')
@section('title', 'Thông báo')

@section('content')
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"style="  color: rgb(71, 160, 78);">Home</a></li>
                    <li class="breadcrumb-item"><a href="#"style="  color: rgb(71, 160, 78);">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notification</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container py-4">
        <h4 class="mb-4">📩 Thông báo Liên hệ</h4>

        @foreach ($contacts as $contact)
            <div class="card mb-3 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold mb-0 text-primary">{{ $contact->name }}</h5>
                        <small class="text-muted">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;">📧 {{ $contact->email }}</p>

                    <!-- Hiển thị tin nhắn user và tất cả phản hồi của admin -->
                    <div class="mb-2">
                        <!-- Tin nhắn gốc của user -->
                        <div class="mb-1">
                            <span class="badge bg-secondary">User</span>
                            <span class="ms-2">{{ $contact->message }}</span>
                            <small class="text-muted ms-2">{{ $contact->created_at->format('d/m/Y H:i') }}</small>
                        </div>

                        <!-- Các phản hồi từ admin -->
                        @foreach ($contact->replies as $reply)
                            <div class="mb-1">
                                <span class="badge bg-primary">Admin</span>
                                <span class="ms-2">{{ $reply->reply }}</span>
                                <small class="text-muted ms-2">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        @endforeach
                    </div>


                    <!-- Nút trả lời -->
                    <button class="btn btn-outline-primary btn-sm mt-2" type="button"
                        onclick="toggleReplyBox({{ $contact->id }})" id="btn-reply-{{ $contact->id }}">
                        Trả lời
                    </button>

                    <!-- Form trả lời -->
                    <form action="{{ route('contact-replies.store') }}" method="POST" class="mt-2" style="display: none;" id="reply-box-{{ $contact->id }}">
                        @csrf
                        <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                        <textarea name="reply" class="form-control mb-2" rows="2" placeholder="Nhập nội dung trả lời..."></textarea>
                        <button type="submit" class="btn btn-success btn-sm">Gửi</button>
                        <button type="button" class="btn btn-link btn-sm text-danger" onclick="toggleReplyBox({{ $contact->id }})">Đóng</button>
                    </form>

                </div>
            </div>
        @endforeach

    </div>

    <script>
        function toggleReplyBox(id) {
            const box = document.getElementById('reply-box-' + id);
            box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
        }
    </script>

@endsection
