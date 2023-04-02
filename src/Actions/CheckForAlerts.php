<?php

namespace SaeedVaziry\Monitoring\Actions;

use Illuminate\Database\Eloquent\Builder;

class CheckForAlerts
{
    /**
     * @return void
     */
    public function check($record)
    {
        $alerts = app(config('monitoring.models.monitoring_alert'))
            ->where('instance_name', $record->instance_name)
            ->where(function (Builder $query) use ($record) {
                $query->where('cpu', '<=', (float)$record->cpu)
                    ->orWhere('memory', '<=', (float)$record->memory)
                    ->orWhere('disk', '<=', (float)$record->disk);
            })
            ->get();
        foreach ($alerts as $alert) {
            $alert->occurred += 1;
            $alert->save();
            foreach (config('monitoring.notifications.channels') as $channel) {
                app($channel)->send($record);
            }
        }
    }
}
