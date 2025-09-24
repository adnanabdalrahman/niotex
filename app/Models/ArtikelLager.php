<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ArtikelLagerID
 * @property int $InterneArtikelnummer
 * @property int $AlaAuswahlJN
 * @property float $AlaMindestMenge1
 * @property float $AlaMindestMenge2
 * @property float $AlaPhysikalischeMenge1
 * @property float $AlaPhysikalischeMenge2
 * @property float $AlaSperrMenge1
 * @property float $AlaSperrMenge2
 * @property float $AlaKommissionsMenge1
 * @property float $AlaKommissionsMenge2
 * @property float $AlaEKMenge1
 * @property float $AlaEKMenge2
 * @property float $AlaVerplanteMenge1
 * @property float $AlaVerplanteMenge2
 * @property float $AlaVerplantBestellungMenge1
 * @property float $AlaVerplantBestellungMenge2
 * @property float $AlaVerplantFertigungMenge1
 * @property float $AlaVerplantFertigungMenge2
 * @property float $AlaBestellteMenge1
 * @property float $AlaBestellteMenge2
 * @property float $AlaGefertigteMenge1
 * @property float $AlaGefertigteMenge2
 * @property float $AlaForecastMenge1
 * @property float $AlaForecastMenge2
 * @property float $AlaVerfuegbar1Menge1
 * @property float $AlaVerfuegbar1Menge2
 * @property float $AlaVerfuegbar2Menge1
 * @property float $AlaVerfuegbar2Menge2
 * @property float $AlaVerfuegbarBestellungMenge1
 * @property float $AlaVerfuegbarBestellungMenge2
 * @property float $AlaVerfuegbarFertigungMenge1
 * @property float $AlaVerfuegbarFertigungMenge2
 * @property string|null $TimeStamp
 * @property float $AlaBeistellungsMenge1
 * @property float $AlaBeistellungsMenge2
 * @property int $AlaMindestmengeJN
 * @property int $AlaBestandsobergrenzeJN
 * @property float $AlaBestandsobergrenzeMenge1
 * @property float $AlaBestandsobergrenzeMenge2
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaAuswahlJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBeistellungsMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBeistellungsMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestellteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestellteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaEKMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaEKMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaForecastMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaForecastMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaGefertigteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaGefertigteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaKommissionsMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaKommissionsMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestmengeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaPhysikalischeMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaPhysikalischeMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaSperrMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaSperrMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar1Menge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar1Menge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar2Menge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar2Menge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarBestellungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarBestellungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarFertigungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarFertigungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantBestellungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantBestellungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantFertigungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantFertigungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplanteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplanteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereArtikelLagerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereTimeStamp($value)
 * @mixin Eloquent
 */
class ArtikelLager extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.ArtikelLager';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];

}
