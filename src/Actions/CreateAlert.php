<?php

namespace SaeedVaziry\Monitoring\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateAlert
{
    /**
     * @param array $input
     *
     * @throws ValidationException
     *
     * @return mixed
     */
    public function create(array $input)
    {
        $this->validate($input);

        $alert = app(config('monitoring.models.monitoring_alert'))
            ->where('instance_name', $input['instance_name'])
            ->firstOrCreate([
                'instance_name' => $input['instance_name'],
            ], $input);
        $alert->update($input);

        return $alert;
    }

    /**
     * @param array $input
     *
     * @throws ValidationException
     *
     * @return void
     */
    protected function validate(array $input)
    {
        $rules = [
            'instance_name' => 'required',
        ];

        if (isset($input['cpu']) && !empty($input['cpu'])) {
            $rules['cpu'] = 'required|numeric|min:1|max:99';
        }

        if (isset($input['memory']) && !empty($input['memory'])) {
            $rules['memory'] = 'required|numeric|min:1|max:99';
        }

        if (isset($input['disk']) && !empty($input['disk'])) {
            $rules['disk'] = 'required|numeric|min:1|max:99';
        }

        Validator::make($input, $rules)->validateWithBag('createAlert');

        if (
            (!isset($input['cpu']) && !isset($input['memory']) && !isset($input['disk'])) ||
            (empty($input['cpu']) && empty($input['memory']) && empty($input['disk']))
        ) {
            throw ValidationException::withMessages([
                'cpu'    => __('You must fill at least one item'),
                'memory' => __('You must fill at least one item'),
                'disk'   => __('You must fill at least one item'),
            ])->errorBag('createAlert');
        }
    }
}
