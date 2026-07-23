<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Jobs\SyncNiotixVirtualDevicesJob;
use App\Services\Niotix\NiotixVirtualDeviceService;
use App\Traits\ApiResponses;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Throwable;

class NiotixVirtualDeviceController extends Controller
{
    use ApiResponses;

    public function __construct(
        protected NiotixVirtualDeviceService $virtualDeviceService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function index()
    {
        $virtualDevices = $this->virtualDeviceService->getAllFromNiotix();
        return $this->successResponse('Virtual devices retrieved successfully.', $virtualDevices['data']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $virtualDevice = $this->virtualDeviceService->createInNiotix($request->all());
        return $this->successResponse('Virtual device created successfully.', $virtualDevice);
    }

    /**
     * Display the specified resource.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function show($niotixDeviceId)
    {
        $virtualDevice = $this->virtualDeviceService->getByIdFromNiotix($niotixDeviceId);
        return $this->successResponse('Virtual device retrieved successfully.', $virtualDevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(Request $request, int $niotixDeviceId)
    {
        $virtualDevice = $this->virtualDeviceService->updateInNiotix(
            $niotixDeviceId,
            $request->all()
        );
        return $this->successResponse('Virtual device updated successfully.', $virtualDevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Throwable
     */
    public function destroy(int $niotixDeviceId)
    {
        $this->virtualDeviceService->deleteFromNiotix(
            $niotixDeviceId
        );

        return $this->successResponse(
            'Virtual device deleted successfully.'
        );
    }

    /**
     * Synchronize all virtual devices from Niotix.
     *
     * @throws Throwable
     */
    public function sync()
    {
        SyncNiotixVirtualDevicesJob::dispatch();
        return $this->successResponse('Virtual device synchronization has been started.');
    }

    /**
     * Synchronize a single virtual device from Niotix.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function syncOne(int $niotixDeviceId)
    {
        $this->virtualDeviceService->syncById(
            $niotixDeviceId
        );

        return $this->successResponse(
            'Virtual device synchronized successfully.'
        );
    }
}
