<?php

namespace SaeedVaziry\Monitoring\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SaeedVaziry\Monitoring\HasRecords;

class MonitoringController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use HasRecords;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('monitoring::index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function records()
    {
        $instances = $this->getInstances();
        $charts = $this->getCharts($this->getRecords($instances));

        return response()->json([
            'instances' => $instances,
            'records' => $this->getLastRecords($instances),
            'charts' => $charts
        ]);
    }
}
