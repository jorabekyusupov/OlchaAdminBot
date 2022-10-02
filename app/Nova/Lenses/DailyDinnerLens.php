<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class DailyDinnerLens extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param \Laravel\Nova\Http\Requests\LensRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $query->join('users', 'users.id', '=', 'daily_diners.user_id')
            ->select([
                'daily_diners.id as id',
                'users.first_name as first_name',
                'users.last_name as last_name',
                'daily_diners.date as diner_date',
                'daily_diners.is_lunch as is_lunch',
                'daily_diners.status_changed_at as last_status_change',
                'daily_diners.rating as rating',
            ]);
    }


    /**
     * Get the fields available to the lens.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make('id', 'id')->sortable(),
            Text::make('first_name', 'first_name')->sortable(),
            Text::make('last_name', 'last_name')->sortable(),
            Date::make('diner_date', 'date')->sortable(),
            Boolean::make('is_lunch', 'is_lunch')->sortable(),
            DateTime::make('last_status_change', 'last_status_change')->sortable(),
            Number::make('rating', 'rating')->sortable(),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'daily-dinner-lens';
    }
}
