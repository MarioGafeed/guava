<?php

namespace App\DataTables;

use App\Models\Appartment;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class AppartmentsDataTable extends DataTable
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
            ->addColumn('reservedBedsStats', 'backend.appartments.buttons.reservedBedsStats')
            ->addColumn('holdBedsStats', 'backend.appartments.buttons.holdBedsStats')
            ->addColumn('toggle', 'backend.appartments.buttons.toggle')
            ->addColumn('book', 'backend.appartments.buttons.book')
            ->addColumn('show', 'backend.appartments.buttons.show')
            ->addColumn('edit', 'backend.appartments.buttons.edit')
            ->addColumn('delete', 'backend.appartments.buttons.delete')
            ->rawColumns(['checkbox', 'book', 'show', 'edit', 'toggle', 'delete', 'reservedBedsStats', 'holdBedsStats', 'is_active']);
    }

    public function query(Appartment $model)
    {
        $query = Appartment::query()->with('place')->select('appartments.*');

        return $this->applyScopes($query);
    }

    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getCustomBuilderParameters([1, 2], [], GetLanguage() == 'ar'));

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
                'name' => 'appartments.name',
                'data' => 'name',
                'title' => trans('main.fullname'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'appartments.hasBeds',
                'data' => 'hasBeds',
                'title' => trans('main.hasBeds'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'reservedBedsStats',
                'data' => 'reservedBedsStats',
                'title' => trans('main.reservedBedsStats'),
                'searchable' => false,
                'orderable' => false,
                'width' => '100px',
            ],
            [
                'name' => 'holdBedsStats',
                'data' => 'holdBedsStats',
                'title' => trans('main.holdBedsStats'),
                'searchable' => false,
                'orderable' => false,
                'width' => '100px',
            ],
            [
                'name' => 'place.name',
                'data' => 'place.name',
                'title' => trans('main.place'),
                'searchable' => true,
                'orderable' => true,
                'width' => '150px',
            ],
            [
                'name' => 'appartments.active',
                'data' => 'is_active',
                'title' => trans('main.active'),
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
                'name' => 'book',
                'data' => 'book',
                'title' => trans('main.book'),
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
        return 'Appartments_'.date('YmdHis');
    }
}
