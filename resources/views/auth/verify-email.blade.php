<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Vui lòng xác minh email của bạn bằng cách nhấn vào liên kết chúng tôi vừa gửi.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Chúng tôi đã gửi lại liên kết xác minh đến email của bạn.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <x-primary-button>
            {{ __('Gửi lại email xác minh') }}
        </x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Đăng xuất') }}
        </button>
    </form>
</x-guest-layout>
