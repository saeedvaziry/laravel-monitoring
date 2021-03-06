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
     * @throws \Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function records(Request $request)
    {
        $request->validate([
            'duration' => 'in:hour,day',
        ]);

        $instances = $this->getInstances();
        $charts = $this->getRecords($instances, $request->duration);

        return response()->json([
            'instances' => $instances,
            'records'   => $this->getLastRecords($instances),
            'charts'    => $charts,
            'alerts'    => $this->getAlerts($instances),
        ]);
    }
}
