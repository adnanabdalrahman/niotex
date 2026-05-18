<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DLBuchungsdateiService
{
    public function create(array $header): void
    {
        $filename = sprintf(
            'DL-Buchungsdatei_%s_%s.txt',
            now()->format('Ymd'),
            now()->format('Hisv')
        );

        $content = $this->buildContent($header);

        Storage::disk('dl_buchung')->put(
            $filename,
            $content
        );
    }

    private function buildContent(array $header): string
    {
        /*
         * Betrag
         * 15 Zeichen
         * decimal separator = comma
         */

        $betrag = number_format(
            (float)$header['gesamtsteuerbetrag'],
            2,
            ',',
            ''
        );

        $betrag = str_pad(
            $betrag,
            15,
            ' ',
            STR_PAD_RIGHT
        );

        /*
         * Bezugsdatum
         */
        $bezugsdatum = Carbon::parse(
            $header['datumbis']
        )->format('d.m.Y');

        $eigenschaftWert = $header['liegenschaft'] ? substr($header['liegenschaft'], 1, 5) : 00000;
        /*
         * Buchungstext
         */
        $buchungstext = $header['fakturanummer'];

        $fields = [
            '1450',
            '803000',
            '40',
            $betrag,
            'N5',
            $header['abrechnungseinheit'] ?? '',// Abrechnungseinheit
            '3040',
            $eigenschaftWert,
            $bezugsdatum . "\t" . "\t" . "\t",
            'Dienstleistungsrechnung',
            $buchungstext,
        ];

        return implode("\t", $fields);
    }
}
