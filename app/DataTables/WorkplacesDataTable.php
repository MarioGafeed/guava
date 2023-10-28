<?php

namespace App\DataTables;

use App\Models\Workplace;
use Yajra\DataTables\Services\DataTable;

class WorkplacesDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('toggle', 'backend.workplaces.buttons.toggle')
            ->addColumn('show', 'backend.workplaces.buttons.show')
            ->addColumn('edit', 'backend.workplaces.buttons.edit')
            ->addColumn('delete', 'backend.workplaces.buttons.delete')
            ->rawColumns(['checkbox', 'show', 'edit', 'toggle', 'delete']);
    }

    public function query(Workplace $model)
    {
        $query = Workplace::query()->select('workplaces.*');

        return $model->newQuery();
    }

    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters($this->getCustomBuilderParameters([1, 2, 3], [], GetLanguage() == 'ar'));

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
                'name' => 'workplaces.name',
                'data' => 'name',
                'title' => trans('main.fullname'),
                'searchable' => true,
                'orderable' => true,
                'width' => '100px',
            ],
            [
                'name' => 'workplaces.address',
                'data' => 'address',
                'title' => trans('main.address'),
                'searchable' => true,
                'orderable' => true,
                'width' => '400px',
            ],
            [
                'name' => 'workplaces.phone',
                'data' => 'phone',
                'title' => trans('main.phone'),
                'searchable' => true,
                'orderable' => true,
                'width' => '400px',
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
        return 'Workplaces'.date('YmdHis');
    }
}
