<?php

namespace App\DataTables;

use App\Models\Booking;
use Yajra\DataTables\Services\DataTable;

class BookingsDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('is_active', function ($model) {
                if ($model->active == 1) {
                    return '
                        <span style="padding: 1px 6px;" class="label lable-sm label-success">'.trans('main.yes').'</span>
                            ';
                } else {
                    return '
                        <span style="padding: 1px 6px;" class="label lable-sm label-danger">'.trans('main.no').'</span>
                    ';
                }
            })
            ->addColumn('toggle', 'backend.bookings.buttons.toggle')
            ->addColumn('show', 'backend.bookings.buttons.show')
            ->addColumn('edit', 'backend.bookings.buttons.edit')
            ->addColumn('delete', 'backend.bookings.buttons.delete')
            ->rawColumns(['checkbox', 'show', 'edit', 'toggle', 'delete', 'is_active']);
    }

    public function query(Booking $model)
    {
        $query = Booking::query()->with('appartment', 'guest')->select('bookings.*');

        return $this->applyScopes($query);
    }

    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getCustomBuilderParameters([1, 2, 3, 4], [], GetLanguage() == 'ar'));

        return $html;
    }

    protected function getColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="select-all" onclick="select_all()">',
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'width' => '10px',
                'aaSorting' => 'none',
            ],
            [
                'name' => 'bookings.checkin_date',
                'data' => 'checkin_date',
                'title' => trans('main.checkin_date'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            // [
            //     'name' => "bookings.created_at",
            //     'data'    => 'created_at',
            //     'title'   => trans('main.booking_date'),
            //     'searchable' => true,
            //     'orderable'  => true,
            //     'width'          => '100px',
            // ],
            [
                'name' => 'guest.name',
                'data' => 'guest.name',
                'title' => trans('main.guest'),
                'searchable' => true,
                'orderable' => true,
                'width' => '150px',
            ],
            [
                'name' => 'appartment.name',
                'data' => 'appartment.name',
                'title' => trans('main.appartment'),
                'searchable' => true,
                'orderable' => true,
                'width' => '150px',
            ],
            [
                'name' => 'bookings.active',
                'data' => 'is_active',
                'title' => trans('main.active'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'bookings.checkout_date',
                'data' => 'checkout_date',
                'title' => trans('main.checkout_date'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'toggle',
                'data' => 'toggle',
                'title' => trans('main.toggle'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('main.show'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('main.edit'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('main.delete'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],

        ];
    }

    protected function filename()
    {
        return 'Bookings_'.date('YmdHis');
    }
}
