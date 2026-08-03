<?php

namespace Modules\Socialevents\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Socialevents\Http\Concerns\ChecksEditionMobileAccess;
use Modules\Socialevents\Services\TournamentStandingsService;

class StandingsApiController extends Controller
{
    use ChecksEditionMobileAccess;

    public function __construct(
        private TournamentStandingsService $standingsService
    ) {}

    public function getStandings(int $editionId): JsonResponse
    {
        $edition = $this->editionForMobileApi($editionId);

        if ($edition instanceof JsonResponse) {
            return $edition;
        }

        return response()->json([
            'success' => true,
            'message' => 'Tabla de posiciones obtenida correctamente',
            'data' => $this->standingsService->asStandingsPayload($editionId),
        ]);
    }
}
