<?php

namespace App\DataTables;

use App\Models\Owner;
use Yajra\DataTables\Services\DataTable;

class OwnersDataTable extends DataTable
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
            ->addColumn('toggle', 'backend.owners.buttons.toggle')
            ->addColumn('show', 'backend.owners.buttons.show')
            ->addColumn('edit', 'backend.owners.buttons.edit')
            ->addColumn('delete', 'backend.owners.buttons.delete')
            ->rawColumns(['checkbox', 'show', 'edit', 'toggle', 'delete', 'is_active']);
    }

    public function query(Owner $model)
    {
        $query = Owner::query()->select('owners.*');

        return $model->newQuery();
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
                'name' => 'owners.name',
                'data' => 'name',
                'title' => trans('main.fullname'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'owners.phone',
                'data' => 'phone',
                'title' => trans('main.phone'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'owners.active',
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
        return 'Owners_'.date('YmdHis');
    }
}
