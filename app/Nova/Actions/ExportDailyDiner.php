<?php

namespace App\Nova\Actions;

use App\Exports\DailyDinersExport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ExportDailyDiner extends Action
{
    use InteractsWithQueue, Queueable;

    public $withoutConfirmation = true;
    public $name = 'Excel';
    public $showInline = true;
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

         Excel::store(new DailyDinersExport($models), 'daily-diners.xlsx', 'pub');
         return Action::download(asset('excel/daily-diners.xlsx'), 'daily-diners.xlsx');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

        ];
    }
}
