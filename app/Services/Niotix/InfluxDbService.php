<?php

namespace App\Services\Niotix;

use App\Services\RakMadDeviceValService;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Throwable;

class InfluxDbService
{
    private const QUERY_ENDPOINT = 'influxdb/query';

    private const MEASUREMENT = 'states_history';
    private const FIELD = 'value_string';
    private const AGGREGATION = 'LAST';
    private const GROUP_BY = '24h';
    private const FILL = 'null';

    private const FILTER_TAGS = [
        'dtwin_title',
        'dtwin_id',
        'state_identifier',
    ];

    public function __construct(
        protected NiotixApiClient        $niotixApiClient,
        protected RakMadDeviceValService $deviceValService,
    )
    {
    }

    /**
     * @throws ConnectionException
     * @throws Throwable
     */
    public function syncStateHistory(array $payload): void
    {
        $points = $this->getStateHistory($payload);
        DB::transaction(function () use ($points, $payload) {
            $this->deviceValService->store($points, $payload);
        });
    }

    /**
     * @throws ConnectionException
     */
    public function getStateHistory(array $data): array
    {
        $response = $this->niotixApiClient->post(
            self::QUERY_ENDPOINT,
            [
                'epoch' => 'ms',
                'q' => $this->buildQuery($data),
            ]
        );
        return $response;
        return $this->extractMonthlyPoints(
            data_get($response, 'results.0.series.0.values', [])
        );
    }

    private function buildQuery(array $data): string
    {
        $from = Carbon::parse($data['from'])
            ->startOfDay()
            ->getTimestampMs();

        $to = Carbon::parse($data['to'])
            ->endOfDay()
            ->getTimestampMs();

        $sql = sprintf(
            'SELECT %s("%s") FROM "%s"',
            self::AGGREGATION,
            self::FIELD,
            self::MEASUREMENT
        );

        $where = [];

        foreach (self::FILTER_TAGS as $tag) {
            if (!empty($data[$tag])) {
                $where[] = $this->whereEquals(
                    $tag,
                    is_string($data[$tag])
                        ? $this->escape($data[$tag])
                        : $data[$tag]
                );
            }
        }

        $where[] = sprintf('time >= %dms', $from);
        $where[] = sprintf('time <= %dms', $to);

        $sql .= ' WHERE ' . implode(' AND ', $where);

        $sql .= sprintf(
            ' GROUP BY time(%s) FILL(%s)',
            self::GROUP_BY,
            self::FILL
        );

        return $sql;
    }

    private function whereEquals(string $field, mixed $value): string
    {
        return sprintf(
            '"%s" = \'%s\'',
            $field,
            $value
        );
    }

    private function escape(string $value): string
    {
        return str_replace("'", "\\'", $value);
    }

    private function extractMonthlyPoints(array $values): array
    {
        // Remove null values
        $values = array_filter(
            $values,
            fn(array $row) => $row[1] !== null
        );

        $months = [];

        foreach ($values as [$timestamp, $value]) {

            $date = Carbon::createFromTimestampMs($timestamp);

            $key = $date->format('Y-m');

            $months[$key][] = [
                'timestamp' => $timestamp,
                'date' => $date,
                'value' => $value,
            ];
        }

        $result = [];

        foreach ($months as $month => $rows) {

            usort(
                $rows,
                fn($a, $b) => $a['timestamp'] <=> $b['timestamp']
            );

            $first = $rows[0];
            $last = $rows[count($rows) - 1];

            $middle = collect($rows)
                ->sortBy(
                    fn($row) => abs($row['date']->day - 15)
                )
                ->first();

            $result[] = [
                'month' => $month,

                'first' => [
                    'date' => $first['date']->toDateString(),
                    'timestamp' => $first['timestamp'],
                    'value' => $first['value'],
                ],

                'middle' => [
                    'date' => $middle['date']->toDateString(),
                    'timestamp' => $middle['timestamp'],
                    'value' => $middle['value'],
                ],

                'last' => [
                    'date' => $last['date']->toDateString(),
                    'timestamp' => $last['timestamp'],
                    'value' => $last['value'],
                ],
            ];
        }

        return $result;
    }


}
