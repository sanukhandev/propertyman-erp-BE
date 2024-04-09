<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contract;
use App\Traits\ApiResponseTrait;
use Barryvdh\DomPDF\PDF as DomPDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;


class ContractController extends Controller
{
    use ApiResponseTrait;


    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = QueryBuilder::for(Contract::class)
            ->where('company_id', $user->company_id)
            ->allowedFilters('type', 'status', 'start_date', 'end_date', 'price', 'payment_frequency', 'payment_method', 'payment_status')
            ->defaultSort('-updated_at')
            ->allowedSorts(['id', 'type', 'status', 'start_date', 'end_date', 'price', 'payment_frequency', 'payment_method', 'payment_status']);
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $query->with($relations);
        }
        $contracts = $query->paginate();
        return $this->successResponse($contracts, 'Fetched successfully', 200);
    }

    public function store(StoreContractRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user['id'];
        $validated['company_id'] = $user['company_id'];
        $contract = Contract::create($validated);
        if ($request->has('additional_information')) {
            foreach ($request->additional_information as $info) {
                $contract->additionalInformation()->create([
                    'key' => $info['key'],
                    'value' => $info['value']
                ]);
            }
        }
        return $this->successResponse($contract, 'Created successfully', 201);
    }


    public function show(Request $request,Contract $contract): JsonResponse
    {
        if ($request->has('with')) {
            $relations = explode(',', $request->query('with'));
            $contract->load($relations);
        }
        return $this->successResponse($contract, 'Fetched successfully', 200);
    }




    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->validated());
        if ($request->has('additional_information')) {
            $existingInfos = $contract->additionalInformation->keyBy('key');
            foreach ($request->additional_information as $info) {
                if ($existingInfos->has($info['key'])) {
                    $existingInfos[$info['key']]->update(['value' => $info['value']]);
                } else {
                    $contract->additionalInformation()->create([
                        'key' => $info['key'],
                        'value' => $info['value']
                    ]);
                }
            }
        }
        return $this->successResponse($contract, 'Updated successfully', 200);
    }

    public function generatePdf(Request $request, DomPDF  $pdf): \Illuminate\Http\Response
    {
        // Generate PDF
        $data = ['title' => 'Laravel PDF Example', 'date' => date('m/d/Y')];

        $pdf->loadView('document', $data);


        return $pdf->download('example.pdf');
    }


}
