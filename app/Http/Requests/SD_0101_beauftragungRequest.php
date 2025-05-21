<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SD_0101_beauftragungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    /*
{"header":{
    "vbeln":"6000000003",
    "auart":"ZSB1",
    "kunnr":"0004000130",
    "vdatu":"2025-05-05",
    "zzlgsnr":null,
    "genrCeos":0,
    "txtZ012":"@* Bitte das 3.OG rechts nichts ausstatten",
    "txtZ013":null
    },


    "positions":
    [
        {
            "posnr":100,
            "matnr":"000000000982400000",
            "kondm":"D3",
            "kwmeng":5.0,
            "vrkme":"ST",
            "aufnr":"A141601099",
            "txtZ002":null,
            "txtZ009":null,
            "txtZ010":null,
            "vorgn":null,
            "posErl":0,
            "kwmengO":0,
            "vbeln":null
        }
    ]
    }


[2025-04-29 15:23:14] local.INFO: Received beauftragung Data: {"header":{"vbeln":"6000000003","auart":"ZSB1","kunnr":"0004000130","vdatu":"2025-05-05","zzlgsnr":null,"genrCeos":0,"txtZ012":"@* Bitte das 3.OG rechts nichts ausstatten","txtZ013":null},"positions":[{"posnr":300,"matnr":"000000000731200034","kondm":"M0","kwmeng":7.0,"vrkme":"ST","aufnr":"A141601099","txtZ002":null,"txtZ009":null,"txtZ010":null,"vorgn":null,"posErl":0,"kwmengO":0,"vbeln":null}]}


[2025-04-29 15:23:42] local.INFO: Received beauftragung Data: {"header":{"vbeln":"6000000003","auart":"ZSB1","kunnr":"0004000130","vdatu":"2025-05-05","zzlgsnr":null,"genrCeos":0,"txtZ012":"@* Bitte das 3.OG rechts nichts ausstatten","txtZ013":null},"positions":[{"posnr":200,"matnr":"000000000731320012","kondm":"M2","kwmeng":6.0,"vrkme":"ST","aufnr":"A141601099","txtZ002":null,"txtZ009":null,"txtZ010":null,"vorgn":null,"posErl":0,"kwmengO":0,"vbeln":null}]}
    */


    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.Verkaufsbeleg' => 'required|string|max:10', // Vorgang.VorIndividualC1
            'header.Verkaufsbelegart' => 'required|string|max:4', // Vorgang.VorIndividualC2
            'header.Auftraggeber' => 'required|string|max:10', // Adresse.AdressNummer(was empfangene nummer) -> Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'header.Wunschlieferdatum' => 'required|date', // ???????????????????????????? Vorgang.VorLieferungWunschDatum
            'header.LgsNummer' => 'nullable|string|max:9',// Vorgang.VorIndividualC3
            'header.GebaeudeAdressNr' => 'required|integer', // ????????? (Tabelle existiert momentan noch nicht)
            'header.BemerkungZurLgs' => 'nullable|string',//soll von CEOS zurückgegeben werden, z. Bsp. wenn nicht alles ausgestattet werden konnte, ggf. später für Druck auf Rechnung
            'header.Austauschgrund' => 'nullable|string',

            'positions' => 'required|array|min:1',
            'positions.*.PosNr' => 'required|integer',
            'positions.*.Material' => 'required|string|max:18',
            'positions.*.Materialgruppe' => 'required|string|max:2',
            'positions.*.Menge' => 'required|numeric',
            'positions.*.Mengeneinheit' => 'required|string|max:6',
            'positions.*.Kontierungsobjekt' => 'required|string|max:12',
            'positions.*.BemerkungNuMonteur' => 'nullable|string',
            'positions.*.PositionErledigt' => 'nullable|Boolean', // 1 erledigt ,2 teilweise erledigt
            'positions.*.MengeOffen' => 'nullable|numeric|min:0',
            'positions.*.Vorgangsnummer' => 'nullable|integer',
            'positions.*.InfoZurMontageSAP ' => 'nullable|string',
            'positions.*.InfoZurMontageCEOS' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'header.auart.required' => 'Das Feld "auart" (Bestellart) ist erforderlich.',
            'header.genrCeos.required' => 'Das Feld "genrCeos" ist erforderlich.',
            'header.kunnr.required' => 'Die Kundennummer ("kunnr") ist erforderlich.',
            'header.vbeln.required' => 'Die Verkaufsbelegnummer ("vbeln") ist erforderlich.',
            'header.vdatu.required' => 'Das Bestelldatum ("vdatu") ist erforderlich.',
            'header.vdatu.date' => 'Das Bestelldatum ("vdatu") muss ein gültiges Datum sein.',

            'positions.required' => 'Die Liste der Positionen ("positions") ist erforderlich.',
            'positions.*.PosNr.required' => 'Die Positionsnummer ("PosNr") ist für jede Position erforderlich.',
            'positions.*.PosNr.integer' => 'Die Positionsnummer ("PosNr") muss eine ganze Zahl sein.',
            'positions.array' => 'Die Positionen ("positions") müssen ein Array sein.',
            'positions.*.aufnr.required' => 'Die Auftragsnummer ("aufnr") ist für jede Position erforderlich.',
            'positions.*.kondm.required' => 'Der Konditionstyp ("kondm") ist für jede Position erforderlich.',
            'positions.*.kwmeng.required' => 'Die Menge ("kwmeng") ist für jede Position erforderlich.',
            'positions.*.kwmeng.numeric' => 'Die Menge ("kwmeng") muss eine Zahl sein.',
            'positions.*.matnr.required' => 'Die Materialnummer ("matnr") ist für jede Position erforderlich.',
            'positions.*.matnr.string' => 'Die Materialnummer ("matnr") muss ein String sein.',
            'positions.*.vrkme.required' => 'Die Maßeinheit ("vrkme") ist für jede Position erforderlich.',
            'positions.*.vrkme.string' => 'Die Maßeinheit ("vrkme") muss ein String sein.',
        ];
    }

}
