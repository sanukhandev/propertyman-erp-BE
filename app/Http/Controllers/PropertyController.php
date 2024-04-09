<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class PropertyController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = QueryBuilder::for(Property::class)
            ->where('company_id', $user->company_id);
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $query->with($relations);
        }
        $properties = $query->paginate();
        return $this->successResponse($properties, 'Fetched successfully', 200);
    }


    public function store(StorePropertyRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user['id'];
        $validated['company_id'] = $user['company_id'];
        $property = Property::create($validated);
        return $this->successResponse($property, 'Created successfully', 201);
    }


    public function show(Request $request, Property $property): JsonResponse
    {
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $property->load($relations);
        }
        return $this->successResponse($property, 'Fetched successfully', 200);
    }

    public function update(Request $request, Property $property): JsonResponse
    {

        $property->update($request->validated());
        if ($request->has('additional_information')) {
            $existingInfos = $property->additionalInformation->keyBy('key');
            foreach ($request->additional_information as $info) {
                if ($existingInfos->has($info['key'])) {
                    $existingInfos[$info['key']]->update(['value' => $info['value']]);
                } else {
                    $property->additionalInformation()->create([
                        'key' => $info['key'],
                        'value' => $info['value']
                    ]);
                }
            }
        }
        return $this->successResponse($property, 'Updated successfully', 200);
    }


}
