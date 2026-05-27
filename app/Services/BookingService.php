<?php


namespace App\Services;

use App\Models\Booking;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BookingService
{
    /**
     * @param array $data
     * @return Booking
     */
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {

            $client = $this->resolveClient($data);

            $startAt = Carbon::parse($data['start_at']);
            $endAt = $startAt->copy()->addMinutes((int) $data['duration']);

            $this->checkConflict($data['master_id'], $startAt, $endAt);

            return Booking::create([
                'client_id' => $client->id,
                'master_id' => $data['master_id'],
                'status' => $data['status'],
                'car_brand' => $data['car_brand'] ?? null,
                'car_model' => $data['car_model'] ?? null,
                'start_at' => $startAt,
                'end_at' => $endAt,
                'complaint' => $data['complaint'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        });
    }

    /**
     * @param array $data
     * @return Client
     * @throws \Exception
     */
    private function resolveClient(array $data): Client
    {
        if (!empty($data['client_id'])) {
            return Client::findOrFail($data['client_id']);
        }

        if (
            empty($data['client_name']) ||
            empty($data['client_phone'])
        ) {
            throw new \Exception('Заполните данные клиента');
        }

        return Client::firstOrCreate(
            ['phone' => $data['client_phone']],
            [
                'name' => $data['client_name'],
            ]
        );
    }

    /**
     * @param int $masterId
     * @param Carbon $startAt
     * @param Carbon $endAt
     * @throws \Exception
     */
    private function checkConflict(int $masterId, Carbon $startAt, Carbon $endAt): void
    {
        $hasConflict = Booking::where('master_id', $masterId)
            ->where(function ($query) use ($startAt, $endAt) {

                $query->whereBetween('start_at', [$startAt, $endAt])
                    ->orWhereBetween('end_at', [$startAt, $endAt])
                    ->orWhere(function ($q) use ($startAt, $endAt) {
                        $q->where('start_at', '<=', $startAt)
                            ->where('end_at', '>=', $endAt);
                    });
            })
            ->exists();

        if ($hasConflict) {
            throw new \Exception('У мастера уже есть запись на это время');
        }
    }

}
