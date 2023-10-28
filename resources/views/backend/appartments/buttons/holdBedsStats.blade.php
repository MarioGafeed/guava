@forelse ($model->reservationsByDateRange('hold', request()->date('from'), request()->date('to')) as $range)
    <span style="padding: 1px 6px;" class="label lable-sm label-warning">
        {{ $range->checkin_date }} - {{ $range->checkout_date }}: <b>{{ $range->reservations_count }}</b>
    </span>
@empty
    <span style="padding: 1px 6px;" class="label lable-sm label-primary">
        N/A
    </span>
@endforelse
