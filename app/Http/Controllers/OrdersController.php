<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Orders;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class OrdersController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = QueryBuilder::for(Orders::class)
            ->where('company_id', $user->company_id)
            ->allowedFilters('type', 'status', 'start_date', 'end_date', 'price', 'payment_frequency', 'payment_method', 'payment_status')
            ->defaultSort('-updated_at')
            ->allowedSorts(['id', 'type', 'status', 'start_date', 'end_date', 'price', 'payment_frequency', 'payment_method', 'payment_status']);
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $query->with($relations);
        }
        $orders = $query->paginate();
        return $this->successResponse($orders, 'Fetched successfully', 200);
    }



    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user['id'];
        $validated['company_id'] = $user['company_id'];
        $order = Orders::create($validated);
        if ($request->has('additional_information')) {
            foreach ($request->additional_information as $info) {
                $order->additionalInformation()->create([
                    'key' => $info['key'],
                    'value' => $info['value']
                ]);
            }
        }
        return $this->successResponse($order, 'Created successfully', 201);

    }


    public function show(Request $request,Orders $orders): JsonResponse
    {
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $orders->load($relations);
        }
        return $this->successResponse($orders, 'Fetched successfully', 200);
    }


    public function update(UpdateOrderRequest $request, Orders $orders)
    {
        //
    }


}
