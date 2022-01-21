<?php

namespace SaeedVaziry\Monitoring\Http;

use Illuminate\Http\Request;
use SaeedVaziry\Monitoring\Actions\CreateAlert;
use SaeedVaziry\Monitoring\HasRecords;

class MonitoringAlertController extends Controller
{
    use HasRecords;

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json([
            'alert' => app(CreateAlert::class)->create($request->only([
                'instance_name',
                'cpu',
                'memory',
                'disk',
            ])),
        ]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        app(config('monitoring.models.monitoring_alert'))
            ->findOrFail($id)
            ->delete();

        return response()->json(true);
    }
}
