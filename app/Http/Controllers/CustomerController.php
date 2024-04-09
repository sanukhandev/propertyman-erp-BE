<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends Controller
{
    use ApiResponseTrait;


    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = QueryBuilder::for(Customer::class)
            ->where('company_id', $user->company_id);
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $query->with($relations);
        }
        $customers = $query->paginate();
        return $this->successResponse($customers, 'Fetched successfully', 200);
    }


    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user['id'];
        $validated['company_id'] = $user['company_id'];
        $customer = Customer::create($validated);
        if ($request->has('additional_information')) {
            foreach ($request->additional_information as $info) {
                $customer->additionalInformation()->create([
                    'key' => $info['key'],
                    'value' => $info['value']
                ]);
            }
        }
        return $this->successResponse($customer, 'Created successfully', 201);
    }


    public function show(Request $request, Customer $customer): JsonResponse
    {
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $customer->load($relations);
        }
        return $this->successResponse($customer, 'Fetched successfully', 200);
    }


    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $customer->update($request->validated());
        if ($request->has('additional_information')) {
            $existingInfos = $customer->additionalInformation->keyBy('key');
            foreach ($request->additional_information as $info) {
                if ($existingInfos->has($info['key'])) {
                    $existingInfos[$info['key']]->update(['value' => $info['value']]);
                } else {
                    $customer->additionalInformation()->create([
                        'key' => $info['key'],
                        'value' => $info['value']
                    ]);
                }
            }
        }
        return $this->successResponse($customer, 'Updated successfully', 200);
    }


}
