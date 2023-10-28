@forelse ($model->reservationsByDateRange('reserved', request()->date('from'), request()->date('to')) as $range)
    <span style="padding: 1px 6px;" class="label lable-sm label-info">
        {{ $range->checkin_date }} - {{ $range->checkout_date }}: <b>{{ $range->reservations_count }}</b>
    </span>
@empty
    <span style="padding: 1px 6px;" class="label lable-sm label-warning">
        N/A
    </span>
@endforelse
