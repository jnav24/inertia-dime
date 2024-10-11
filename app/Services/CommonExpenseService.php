<?php

namespace App\Services;

use App\Http\Requests\CommonExpenseRequest;
use App\Models\ChildcareTemplate;
use App\Models\EducationTemplate;
use App\Models\EntertainmentTemplate;
use App\Models\FoodTemplate;
use App\Models\GiftTemplate;
use App\Models\HousingTemplate;
use App\Models\LoanTemplate;
use App\Models\MedicalTemplate;
use App\Models\MiscellaneousTemplate;
use App\Models\PersonalTemplate;
use App\Models\ShoppingTemplate;
use App\Models\SubscriptionTemplate;
use App\Models\TaxTemplate;
use App\Models\TravelTemplate;
use App\Models\UtilityTemplate;
use Symfony\Component\HttpFoundation\Response;

class CommonExpenseService
{
    protected $models = [
        'childcare' => [
            'budget' => '',
            'template' => ChildcareTemplate::class,
        ],
        'education' => [
            'budget' => '',
            'template' => EducationTemplate::class,
        ],
        'entertainment' => [
            'budget' => '',
            'template' => EntertainmentTemplate::class,
        ],
        'food' => [
            'budget' => '',
            'template' => FoodTemplate::class,
        ],
        'gifts' => [
            'budget' => '',
            'template' => GiftTemplate::class,
        ],
        'housing' => [
            'budget' => '',
            'template' => HousingTemplate::class,
        ],
        'loan' => [
            'budget' => '',
            'template' => LoanTemplate::class,
        ],
        'medical' => [
            'budget' => '',
            'template' => MedicalTemplate::class,
        ],
        'miscellaneous' => [
            'budget' => '',
            'template' => MiscellaneousTemplate::class,
        ],
        'personal' => [
            'budget' => '',
            'template' => PersonalTemplate::class,
        ],
        'shopping' => [
            'budget' => '',
            'template' => ShoppingTemplate::class,
        ],
        'subscription' => [
            'budget' => '',
            'template' => SubscriptionTemplate::class,
        ],
        'tax' => [
            'budget' => '',
            'template' => TaxTemplate::class,
        ],
        'travel' => [
            'budget' => '',
            'template' => TravelTemplate::class,
        ],
        'utility' => [
            'budget' => '',
            'template' => UtilityTemplate::class,
        ],
    ];

    public function getModel(CommonExpenseRequest $request, bool $template)
    {
        $key = $this->getKey($request);

        if (empty($this->models[$key]) || empty($model = $this->models[$key][$template ? 'template' : 'budget'])) {
            abort(Response::HTTP_BAD_REQUEST, 'Model not found');
        }

        return $model;
    }

    private function getKey(CommonExpenseRequest $request)
    {
        $list = explode('/', $request->path());
        $count = count($list);

        if ($count === 3 || $count === 4) {
            return $list[2];
        }

        abort(Response::HTTP_BAD_REQUEST, 'Unable to get model');
    }
}
