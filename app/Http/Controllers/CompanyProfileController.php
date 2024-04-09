<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;


use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $companyProfile = QueryBuilder::for(CompanyProfile::class)
            ->where('id', $user['company_id'])
            ->with('users')
            ->allowedFilters('name','phone','email','country','status')
            ->defaultSort('-updated_at')
            ->allowedSorts(['id','name','status'])
            ->paginate();
        return $this->successResponse($companyProfile,'Fetched successfully',200);
    }


    public function show(Request $request, CompanyProfile $companyProfile): JsonResponse
    {
        return $this->successResponse($companyProfile,'Fetched successfully',200);
    }

    public function store(StoreCompanyProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $companyProfile = CompanyProfile::create($validated);
        if ($request->has('additional_information')) {
            foreach ($request->additional_information as $info) {
                $companyProfile->additionalInformation()->create([
                    'key' => $info['key'],
                    'value' => $info['value']
                ]);
            }
        }
        return $this->successResponse($companyProfile,'Created successfully',201);
    }

    public function update(UpdateCompanyProfileRequest $request, CompanyProfile $companyProfile): JsonResponse
    {
        $validated = $request->validated();
        $companyProfile->update($validated);
        if ($request->has('additional_information')) {
             $existingInfos = $companyProfile->additionalInformation->keyBy('key');
             foreach ($request->additional_information as $info) {
                 if ($existingInfos->has($info['key'])) {
                     $existingInfos[$info['key']]->update(['value' => $info['value']]);
                 } else {
                     $companyProfile->additionalInformation()->create([
                         'key' => $info['key'],
                         'value' => $info['value']
                     ]);
                 }
             }
        }

        return $this->successResponse($companyProfile, 'Updated successfully', 200);
    }

}
