<?php

namespace SaeedVaziry\Monitoring\Http;

use Illuminate\Http\Request;
use SaeedVaziry\Monitoring\HasAlerts;
use SaeedVaziry\Monitoring\HasRecords;

class MonitoringRecordController extends Controller
{
    use HasRecords;
    use HasAlerts;

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function records(Request $request)
    {
        $request->validate([
            'duration' => 'in:hour'
        ]);

        $instances = $this->getInstances();
        $charts = $this->getCharts($this->getRecords($instances));

        return response()->json([
            'instances' => $instances,
            'records' => $this->getLastRecords($instances),
            'charts' => $charts,
            'alerts' => $this->getAlerts($instances)
        ]);
    }
}
