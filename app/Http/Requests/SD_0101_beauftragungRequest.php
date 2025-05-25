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
        VorArt nvarchar(1);		default Value A
        VorUnterArt default Value R


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
    /*{"header":{
    "vbeln":"6000000003",
    "auart":"ZSB1",
    "kunnr":"0004000130",
    "vdatu":"2025-05-05",
    "zzlgsnr":null,
    "genrCeos":0,
    "txtZ012":"@* Bitte das 3.OG rechts nichts ausstatten",
    "txtZ013":null
    },*/


    public function rules(): array
    {
        return [
            'header' => 'required|array',
            'header.vbeln' => 'required|string|max:10', // Verkaufsbeleg Vorgang.VorIndividualC1
            'header.auart' => 'required|string|max:4', // Vorgang.VorIndividualC2
            'header.kunnr' => 'required|string|max:10', // Adresse.AdressNummer(was empfangene nummer) -> Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'header.vdatu' => 'required|date', // Wunschlieferdatum Vorgang.VorLieferung-WunschDatum
            'header.zzlgsnr' => 'nullable|string|max:9', // Liegenschaftsnummer Vorgang.VorIndividualC3
            'header.genrCeos' => 'nullable|integer',// Vorgang.VorIndividualD4
            'header.txtZ012' => 'nullable|string', //Bemerkung zur Liegenschaft Vorgang2Text.VorNotiz
            'header.txtZ013' => 'nullable|string',// Vorgang.VorStichwort  Für Reparaturaufträge Ausstattung / Austauschgrund

            /*
            // "aufnr": "A141601099",
            "kondm": "W3", Materialgruppe
            "kwmeng": 5.0,
            "kwmengO": 0,
            "matnr": "000000000000000432",
            "posErl": 0,
            "posnr": 700,
            "txtZ002": "",
            "txtZ009": "",
            "txtZ010": "",
            "vorgn": 0,
            "vrkme": "LE"
            */
            'positions' => 'required|array|min:1',
            'positions.*.kondm' => 'required|string|max:2',
            'positions.*.kwmeng' => 'required|numeric',
            'positions.*.kwmengO' => 'nullable|numeric',
            'positions.*.posnr' => 'required|integer',
            'positions.*.matnr' => 'required|string|max:18',
            'positions.*.vrkme' => 'required|string|max:6',
            'positions.*.posErl' => 'nullable|Boolean', // 1 erledigt ,2 teilweise erledigt
//            'positions.*.Kontierungsobjekt' => 'required|string|max:12',
            'positions.*.txtZ002' => 'nullable|string',
//            'positions.*.Vorgangsnummer' => 'nullable|integer',
            'positions.*.txtZ009' => 'nullable|string',
            'positions.*.txtZ010' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Das Feld "header" ist erforderlich.',
            'header.array' => 'Das Feld "header" muss ein gültiges Array sein.',

            'header.vbeln.required' => 'Die Verkaufsbelegnummer (vbeln) ist erforderlich.',
            'header.vbeln.string' => 'Die Verkaufsbelegnummer (vbeln) muss ein Text sein.',
            'header.vbeln.max' => 'Die Verkaufsbelegnummer (vbeln) darf maximal 10 Zeichen lang sein.',

            'header.auart.required' => 'Der Auftragstyp (auart) ist erforderlich.',
            'header.auart.string' => 'Der Auftragstyp (auart) muss ein Text sein.',
            'header.auart.max' => 'Der Auftragstyp (auart) darf maximal 4 Zeichen lang sein.',

            'header.kunnr.required' => 'Die Kundennummer (kunnr) ist erforderlich.',
            'header.kunnr.string' => 'Die Kundennummer (kunnr) muss ein Text sein.',
            'header.kunnr.max' => 'Die Kundennummer (kunnr) darf maximal 10 Zeichen lang sein.',

            'header.vdatu.required' => 'Das gewünschte Lieferdatum (vdatu) ist erforderlich.',
            'header.vdatu.date' => 'Das gewünschte Lieferdatum (vdatu) muss ein gültiges Datum sein.',

            'header.zzlgsnr.string' => 'Die Zusatznummer (zzlgsnr) muss ein Text sein.',
            'header.zzlgsnr.max' => 'Die Zusatznummer (zzlgsnr) darf maximal 9 Zeichen lang sein.',

            'header.genrCeos.integer' => 'Der Wert von genrCeos muss eine ganze Zahl sein.',


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
