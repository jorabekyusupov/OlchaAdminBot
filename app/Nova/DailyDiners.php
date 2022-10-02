<?php

namespace App\Nova;

use App\Exports\DailyDinersExport;
use App\Nova\Actions\ExportDailyDiner;
use App\Nova\Filters\DailyFilter;
use App\Nova\Lenses\DailyDinnerLens;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DailyDiners extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\DailyDiners::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Daily Diners';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'date'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('ID', 'id')->sortable(),
            BelongsTo::make('User', 'user', User::class)
                ->nullable()
                ->hideFromIndex(),
            Text::make('first_name', 'first_name')
                ->nullable()
                ->sortable()
                ->onlyOnIndex(),
            Text::make('last_name', 'last_name')
                ->nullable()
                ->sortable()
                ->onlyOnIndex(),
            Text::make('department_name', 'department_name')
                ->nullable()
                ->sortable()
                ->onlyOnIndex(),
            Date::make('date', 'date')
                ->nullable()
                ->sortable(),
//            DateTime::make('last_status_change', 'status_changed_at')
//                ->nullable()
//                ->sortable()
//                ->onlyOnIndex(),
//            Number::make('rating', 'rating')
//                ->nullable()
//                ->sortable()
//               ->hide(),
            Boolean::make('is_lunch', 'is_lunch')
                ->nullable()
                ->sortable()
                ->onlyOnIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new DailyFilter,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
//            new DailyDinnerLens,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            new ExportDailyDiner,
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query
            ->join('users', 'users.id', '=', 'daily_diners.user_id')
            ->join('departments', 'departments.id', '=', 'users.department_id', 'left')
            ->select([
                'daily_diners.order as id',
                'users.first_name as first_name',
                'users.last_name as last_name',
                'departments.name as department_name',
                'daily_diners.date as date',
//                'daily_diners.status_changed_at as status_changed_at',
                'daily_diners.is_lunch as is_lunch',
//                'daily_diners.rating as rating',

            ]);
    }
}
