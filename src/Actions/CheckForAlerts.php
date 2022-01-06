<?php

namespace SaeedVaziry\Monitoring\Actions;

class CheckForAlerts
{
    /**
     * @return void
     */
    public function check($record)
    {
        $alerts = app(config('monitoring.models.monitoring_alert'))
            ->where('instance_name', $record->instance_name)
            ->where(function ($query) use ($record) {
                $query->where('cpu', '<=', $record->cpu)
                    ->orWhere('memory', '<=', $record->memory)
                    ->orWhere('disk', '<=', $record->disk);
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
