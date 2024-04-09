<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeads;
use App\Http\Requests\UpdateLeads;
use App\Models\Customer;
use App\Models\Leads;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class LeadsController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = QueryBuilder::for(Leads::class)
            ->allowedFilters(['status', 'source'])
            ->allowedIncludes(['user', 'company', 'customer', 'interactions'])
            ->where('user_id', $user->id)
            ->defaultSort('-updated_at')
            ->allowedSorts(['id', 'status', 'source', 'contact_date', 'next_follow_up']);

        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $query->with($relations);
        }
        $leads = $query->paginate();
        return $this->successResponse($leads, 'Fetched successfully', 200);
    }



    public function store(StoreLeads $request): JsonResponse
    {
        $validated = $request->validated();
        $customerId = $validated['customer_id'] ?? null;
        if ($customerId && !Customer::find($customerId)) {
            $customerData = $request->only(['customer_name', 'customer_email', 'customer_phone']);
            $customer = Customer::create($customerData);
            $customerId = $customer->id;
        }
        $validated['customer_id'] = $customerId;
        $leads = Leads::create($validated);
        if ($request->has('additional_information')) {
            foreach ($request->additional_information as $info) {
                $leads->additionalInformation()->create([
                    'key' => $info['key'],
                    'value' => $info['value']
                ]);
            }
        }

        return $this->successResponse($leads, 'Created successfully', 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request,Leads $leads): JsonResponse
    {
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $leads->load($relations);
        }
        return $this->successResponse($leads, 'Fetched successfully', 200);
    }


    public function update(UpdateLeads $request, Leads $leads): JsonResponse
    {
        $validated = $request->validated();
        $customerId = $validated['customer_id'] ?? null;
        if ($customerId && !Customer::find($customerId)) {
            $customerData = $request->only(['customer_name', 'customer_email', 'customer_phone']);
            $customer = Customer::create($customerData);
            $customerId = $customer->id;
        }
        $validated['customer_id'] = $customerId;
        $leads->update($validated);
        if ($request->has('additional_information')) {
            $existingInfos = $leads->additionalInformation->keyBy('key');
            foreach ($request->additional_information as $info) {
                if ($existingInfos->has($info['key'])) {
                    $existingInfos[$info['key']]->update(['value' => $info['value']]);
                } else {
                    $leads->additionalInformation()->create([
                        'key' => $info['key'],
                        'value' => $info['value']
                    ]);
                }
            }
        }

        return $this->successResponse($leads, 'Updated successfully', 200);
    }


}
