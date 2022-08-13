@if ($notice = session()->pull('notice'))
    @php
        $notice = explode('-', $notice);
        $noticeType = $notice[0];
        $noticeMessage = $notice[1];
    @endphp
    <div class="alert alert-{{ $noticeType }} alert-dismissible fade show text-start" role="alert">
        {{ $noticeMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
    </div>
@endif
