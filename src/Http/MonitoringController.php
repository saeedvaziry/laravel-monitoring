<?php

namespace SaeedVaziry\Monitoring\Http;

class MonitoringController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('monitoring::index');
    }
}
