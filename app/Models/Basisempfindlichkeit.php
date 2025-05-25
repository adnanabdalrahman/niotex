<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneArtikelNummer
 * @property string|null $Zaehlertyp
 * @property string|null $Beschreibung
 * @property string|null $Bauart
 * @property string|null $Fabrikat
 * @property int|null $Laufzeit
 * @property string|null $Anschluss
 * @property string|null $QN
 * @property int|null $Verbrauchzaehlt
 * @property int|null $StueckZaehlt
 * @property int|null $GeraetWalkByFaehig
 * @property string|null $ArtikelAufsatzModul
 * @property int|null $GeraetInWartung
 * @property int|null $GeraetInMiete
 * @property int|null $GeraetFunkVorbereitet
 * @property int|null $Skalennummer
 * @property string|null $SkalenBezeichnung
 * @property string|null $SkalaHersteller
 * @property string|null $SkalaKurzbezeichnung
 * @property string|null $HKVTypVisualThermSkala
 * @property int|null $MaximalwertSkala
 * @property string|null $FormelKVBerechnungSkala
 * @property string|null $AnzahlFuehlerSkala
 * @property string|null $MontagehoeheSkala
 * @property float|null $BasisempfindlichkeitSkala
 * @property float|null $SKFaktorSkala
 * @property int|null $StricheUeberfuellungSkala
 * @property float|null $EinheitenUeberfuellungSkala
 * @property int|null $HKVTyp
 * @property int|null $HKVBewertungsnorm
 * @property int|null $HKVSkalierung
 * @property int|null $Ampullenfarbe
 * @property int|null $FolgeAblesewert
 * @property int|null $ArtDerBewertung
 * @property int|null $StichtagProgrammiertSkala
 * @property int|null $GeraetKodiertSkala
 * @property int|null $CheckzahlSkala
 * @property int|null $CheckzahlArtSkala
 * @property string|null $TextSkala
 * @property string|null $KennzeichenSontex
 * @property int|null $Geraetebits
 * @property string|null $RoutenEigenschaften
 * @property float|null $Laenge
 * @property float|null $Hoehe
 * @property float|null $Tiefe
 * @property string|null $Heizkoerperbezeichnung
 * @property string|null $Herstellerbezeichnung
 * @property string|null $CMID
 * @property float|null $LeistungInWatt
 * @property float|null $Segmentlaenge
 * @property float|null $KCWert
 * @property string|null $TimeStamp
 * @property string|null $Mediacode
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAmpullenfarbe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAnschluss($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAnzahlFuehlerSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereArtDerBewertung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereArtikelAufsatzModul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBasisempfindlichkeitSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBauart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBeschreibung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCMID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCheckzahlArtSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCheckzahlSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereEinheitenUeberfuellungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFabrikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFolgeAblesewert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFormelKVBerechnungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetFunkVorbereitet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetInMiete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetInWartung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetKodiertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetWalkByFaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetebits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVBewertungsnorm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVSkalierung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVTypVisualThermSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHeizkoerperbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHerstellerbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHoehe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereInterneArtikelNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereKCWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereKennzeichenSontex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLaenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLeistungInWatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMaximalwertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMediacode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMontagehoeheSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereQN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereRoutenEigenschaften($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSKFaktorSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSegmentlaenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalaHersteller($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalaKurzbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalenBezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStichtagProgrammiertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStricheUeberfuellungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStueckZaehlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTextSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTiefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereVerbrauchzaehlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereZaehlertyp($value)
 * @mixin \Eloquent
 */
class Basisempfindlichkeit extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.RakArtikel';
    protected $primaryKey = 'InterneArtikelNummer';
    protected $guarded = [];


}
