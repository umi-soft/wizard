@extends('layouts.user')

@section('title', '通知')
@section('user-content')

    <div class="card">
        <div class="card-body">
            <div class="btn-group wz-nav-control">
                <form action="{{ route('user:notifications:read-all') }}" method="post" id="form-notifications-readall">{{ method_field('PUT') }}{{ csrf_field() }}</form>
                <button class="btn btn-primary btn-raised" wz-form-submit data-form="#form-notifications-readall">全部标记为已读</button>
            </div>

            <table class="table table-hover wz-message-table">
                @forelse($notifications as $notification)
                    <tr class="{{ is_null($notification->read_at) ? 'warning' : '' }}">
                        <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {!! $notification->data['message'] !!}
                            @if(is_null($notification->read_at))
                                <span class="wz-message-read hidden">
                            <a href="#" class="glyphicon glyphicon-ok-sign wz-message-read-btn" title="设为已读"
                               data-url="{{ wzRoute('user:notifications:read', ['notification_id' => $notification->id]) }}"></a>
                        </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">没有符合条件的信息！</td>
                    </tr>
                @endforelse
            </table>

            <div class="wz-pagination">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>

@endsection

@push('script')
<script>
    $(function () {
        $('.wz-message-read-btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var url = $(this).data('url');
            $.wz.request('put', url, {}, function(data) {
                $this.parents('tr').removeClass('warning');
                $this.parents('.wz-message-read').remove();
            });
        });
    });
</script>
@endpush