<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Services\SalesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SalesIndexRequest;
use App\Http\Requests\SalesStoreRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $service,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(SalesIndexRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->getActiveSales(), Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesStoreRequest $request): JsonResponse
    {
        try {
            return new JsonResponse($this->service->createSale($request->all()), Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            return new JsonResponse($this->service->findById($id), Response::HTTP_OK);
        } catch (Exception $e) {
            return new JsonResponse(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
