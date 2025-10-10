<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $InterneArtikelnummer
 * @property string $KZArtikelgruppe
 * @property string $KZWarengruppe
 * @property int|null $ArtikelUntergruppeID
 * @property string|null $KZProduktgruppe
 * @property string|null $KZKalkulationGruppe
 * @property string|null $KZArtikelRabattgruppe
 * @property string $Artikelnummer
 * @property string|null $ArtBezeichnung1
 * @property string|null $ArtBezeichnung2
 * @property string|null $ArtMatchcode
 * @property string|null $ArtNotiz
 * @property string|null $KZArtMengeneinheit1
 * @property string|null $KZArtMengeneinheit2
 * @property string|null $ArtFormelMengeneinheit1
 * @property float|null $ArtFaktorMengeneinheit2
 * @property string|null $ArtFormelMengeneinheit2
 * @property int $ArtPreisProMengeneinheit2
 * @property int $NRPreisbasis
 * @property int $MwstNummer
 * @property int|null $LinecardID
 * @property int $ArtRabattfaehigJN
 * @property float|null $ArtRabatt1
 * @property float|null $ArtRabatt2
 * @property float|null $ArtRabatt3
 * @property float|null $ArtRabattWert1
 * @property float|null $ArtRabattWert2
 * @property int $ArtEKRabattfaehigJN
 * @property float|null $ArtEKRabatt1
 * @property float|null $ArtEKRabatt2
 * @property float|null $ArtEKRabatt3
 * @property float|null $ArtEKRabattWert1
 * @property float|null $ArtEKRabattWert2
 * @property string|null $ArtABC_Analyse
 * @property float $ArtVerkaufspreis1
 * @property float|null $ArtVerkaufspreisNeu
 * @property string|null $ArtVerkaufspreisNeuDatum
 * @property float|null $ArtKalkulatorischerEK
 * @property float|null $ArtInventurpreis
 * @property string|null $ArtInventurAm
 * @property float $ArtMaterialkosten
 * @property float $ArtFertigungskosten
 * @property float $ArtFremdfertigungskosten
 * @property float $ArtSondereinzelkosten
 * @property int $ArtSeriennummernfaehigJN
 * @property int $ArtChargenfaehigJN
 * @property int $ArtAutoAbbuchenJN
 * @property int $ArtAutoZubuchenJN
 * @property int|null $ArtDispoart
 * @property int|null $ArtAbbuchungsmethode
 * @property int $ArtPruefpflichtigJN
 * @property string|null $KZZusatztext
 * @property string|null $KZIntraStat
 * @property string|null $ArtOberflaeche
 * @property int|null $NRWerkstoff
 * @property float|null $ArtWerkstoffPreisbasisEK
 * @property float|null $ArtWerkstoffPreisbasisVK
 * @property float|null $ArtWerkstoffAnteil
 * @property string|null $ArtNorm
 * @property string|null $ArtZeichnungsnummer
 * @property string|null $ArtZeichnungsformat
 * @property float|null $ArtNettoGewicht
 * @property float|null $ArtBruttoGewicht
 * @property string|null $KZArtGewichtseinheit
 * @property int|null $ArtGewichtsbasis
 * @property float|null $ArtAbwicklung
 * @property string|null $ArtBezeichnung1Fertigung
 * @property string|null $ArtBezeichnung2Fertigung
 * @property string|null $ArtBezeichnung1Einkauf
 * @property string|null $ArtBezeichnung2Einkauf
 * @property int $ArtAltJN
 * @property float|null $ArtAbmasse1
 * @property float|null $ArtAbmasse2
 * @property float|null $ArtAbmasse3
 * @property float|null $ArtAbmasse4
 * @property string|null $ArtBarcode
 * @property int|null $ArtFibuKontoGruppeAR
 * @property int|null $ArtFibuKontoGruppeVB
 * @property int|null $ArtNRKostenstelleAR
 * @property int|null $ArtNRKostenstelleVB
 * @property int|null $ArtNRKostentraegerAR
 * @property int|null $ArtNRKostentraegerVB
 * @property float|null $ArtIndividualD1
 * @property float|null $ArtIndividualD2
 * @property float|null $ArtIndividualD3
 * @property float|null $ArtIndividualD4
 * @property float|null $ArtIndividualD5
 * @property float|null $ArtIndividualD6
 * @property float|null $ArtIndividualD7
 * @property string|null $ArtIndividualC1
 * @property string|null $ArtIndividualC2
 * @property string|null $ArtIndividualC3
 * @property string|null $ArtIndividualC4
 * @property string|null $ArtIndividualC5
 * @property string|null $ArtIndividualC6
 * @property string|null $ArtIndividualC7
 * @property string|null $ArtIndividualT1
 * @property string|null $ArtIndividualT2
 * @property string|null $ArtIndividualT3
 * @property string|null $ArtIndividualT4
 * @property int|null $ArtIndividualCombo1
 * @property int|null $ArtIndividualCombo2
 * @property int|null $ArtIndividualCombo3
 * @property int|null $ArtIndividualCombo4
 * @property int $ArtStuecklisteJN
 * @property int|null $ArtBearbeiter
 * @property int|null $ArtStkVerkaufspreis
 * @property int|null $ArtStkEinkaufspreis
 * @property int|null $ArtStkBestellpreis
 * @property int $ArtStkAufAusgabeJN
 * @property int $ArtStkAufAufloesungJN
 * @property int $ArtStkBesAusgabeJN
 * @property int $ArtStkBesAufloesungJN
 * @property int $ArtStkAuftragLagerbuchung
 * @property int|null $ArtStkBestellLagerbuchung
 * @property int|null $ArtStkFertLagerbuchung
 * @property int $ArtStkBestellbeistellungJN
 * @property int $ArtStkKundenbeistellungJN
 * @property int $ArtStkKundenbeistellabgangJN
 * @property int $ArtStkMultiplikatorJN
 * @property int $ArtStkPseudobaugruppeJN
 * @property int $ArtStkManuellJN
 * @property float|null $ArtProvisionProzent
 * @property int $ArtProvisionsfaehigJN
 * @property int $ArtWebshopfaehigJN
 * @property int $ArtBonusberechtigtJN
 * @property int|null $ArtPlanungshorizont
 * @property float|null $ArtOptimaleBestellmenge1
 * @property float|null $ArtOptimaleBestellmenge2
 * @property float|null $ArtOptimaleFertigungsmenge1
 * @property float|null $ArtOptimaleFertigungsmenge2
 * @property float|null $ArtMengeProVerpackungEK
 * @property float|null $ArtMenge2ProVerpackungEK
 * @property float|null $ArtMengeProVerpackungVK
 * @property float|null $ArtMenge2ProVerpackungVK
 * @property string|null $ArtWebshopLetzteAktualisierungAm
 * @property int $ArtWebshopNaechsteAktualisierungJN
 * @property string|null $ArtEdiKennung
 * @property string|null $ArtLetztePreisaenderungAm
 * @property int|null $ArtLetztePreisaenderungDurch
 * @property int $ArtLiefErklaerungsPflichtigJN
 * @property string|null $ArtLiefErklaerungGueltigBis
 * @property int $ArtPraeferenzJNA
 * @property float|null $ArtPraeferenzWert
 * @property int $ArtPraeferenzDynamischJN
 * @property int $ArtFremdfertigungJN
 * @property int $ArtLieferantenfaehigJN
 * @property int $ArtFertigungsfaehigJN
 * @property int $ArtVerkaufsfaehigJN
 * @property int $ArtEKInNachkalkulationJN
 * @property int $ArtServiceJN
 * @property float|null $ArtAusschussFaktor
 * @property float|null $ArtAusschussMenge
 * @property int|null $ArtWiederbeschaffungszeit
 * @property int|null $ArtDurchlaufzeit
 * @property string|null $ArtExportAm
 * @property int $ArtErstmusterPruefungJN
 * @property int $ArtErstmusterFreigabeJN
 * @property string|null $ArtErstmusterFreigabeAm
 * @property float|null $ArtErstmusterInterval
 * @property int $ArtUrsprungsnachweisJN
 * @property string|null $ArtAnlageAm
 * @property int|null $ArtAnlageDurch
 * @property string|null $ArtLetzteAenderungAm
 * @property int|null $ArtLetzteAenderungDurch
 * @property string|null $ArtStlAenderungAm
 * @property int|null $ArtStlAenderungDurch
 * @property string|null $ArtGeprueftAm
 * @property int|null $ArtGeprueftDurch
 * @property string|null $ArtLockingAm
 * @property int|null $ArtLockingDurch
 * @property string|null $ArtEAN1
 * @property string|null $ArtEAN2
 * @property string|null $ArtEAN3
 * @property int $ArtBleifreiJN
 * @property int $ArtRoHSKonformJN
 * @property int $ArtMieteVerleihJN
 * @property int $ArtEigenReparaturfaehigJN
 * @property int $ArtFremdReparaturfaehigJN
 * @property int $ArtDienstleistungJN
 * @property string|null $ArtPriceFormular
 * @property int|null $ArtAvailabilityCheck
 * @property string|null $ArtWebshopkennung
 * @property int|null $ArtStkDispotermin
 * @property int|null $ArtStkDispodifferenz
 * @property int $ArtFilialExportJN
 * @property int $ArtExportFremdsoftwareJN
 * @property int $ArtSnrHerstelldatum
 * @property int $ArtSnrVerfallsdatum
 * @property int|null $ArtSnrHaltbarkeitszeitraum
 * @property int $ArtChargeHerstelldatum
 * @property int $ArtChargeVerfallsdatum
 * @property int|null $ArtChargeHaltbarkeitszeitraum
 * @property string|null $TimeStamp
 * @property int|null $ArtPickingMethode
 * @property int|null $WithholdingtaxKategorieID
 * @property float|null $ArtVKBrutto
 * @property int $ArtSkontofaehigJN
 * @property string|null $ArtBild
 * @method static Builder<static>|Artikel newModelQuery()
 * @method static Builder<static>|Artikel newQuery()
 * @method static Builder<static>|Artikel query()
 * @method static Builder<static>|Artikel whereArtABCAnalyse($value)
 * @method static Builder<static>|Artikel whereArtAbbuchungsmethode($value)
 * @method static Builder<static>|Artikel whereArtAbmasse1($value)
 * @method static Builder<static>|Artikel whereArtAbmasse2($value)
 * @method static Builder<static>|Artikel whereArtAbmasse3($value)
 * @method static Builder<static>|Artikel whereArtAbmasse4($value)
 * @method static Builder<static>|Artikel whereArtAbwicklung($value)
 * @method static Builder<static>|Artikel whereArtAltJN($value)
 * @method static Builder<static>|Artikel whereArtAnlageAm($value)
 * @method static Builder<static>|Artikel whereArtAnlageDurch($value)
 * @method static Builder<static>|Artikel whereArtAusschussFaktor($value)
 * @method static Builder<static>|Artikel whereArtAusschussMenge($value)
 * @method static Builder<static>|Artikel whereArtAutoAbbuchenJN($value)
 * @method static Builder<static>|Artikel whereArtAutoZubuchenJN($value)
 * @method static Builder<static>|Artikel whereArtAvailabilityCheck($value)
 * @method static Builder<static>|Artikel whereArtBarcode($value)
 * @method static Builder<static>|Artikel whereArtBearbeiter($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1Einkauf($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1Fertigung($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2Einkauf($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2Fertigung($value)
 * @method static Builder<static>|Artikel whereArtBild($value)
 * @method static Builder<static>|Artikel whereArtBleifreiJN($value)
 * @method static Builder<static>|Artikel whereArtBonusberechtigtJN($value)
 * @method static Builder<static>|Artikel whereArtBruttoGewicht($value)
 * @method static Builder<static>|Artikel whereArtChargeHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Artikel whereArtChargeHerstelldatum($value)
 * @method static Builder<static>|Artikel whereArtChargeVerfallsdatum($value)
 * @method static Builder<static>|Artikel whereArtChargenfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtDienstleistungJN($value)
 * @method static Builder<static>|Artikel whereArtDispoart($value)
 * @method static Builder<static>|Artikel whereArtDurchlaufzeit($value)
 * @method static Builder<static>|Artikel whereArtEAN1($value)
 * @method static Builder<static>|Artikel whereArtEAN2($value)
 * @method static Builder<static>|Artikel whereArtEAN3($value)
 * @method static Builder<static>|Artikel whereArtEKInNachkalkulationJN($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt1($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt2($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt3($value)
 * @method static Builder<static>|Artikel whereArtEKRabattWert1($value)
 * @method static Builder<static>|Artikel whereArtEKRabattWert2($value)
 * @method static Builder<static>|Artikel whereArtEKRabattfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtEdiKennung($value)
 * @method static Builder<static>|Artikel whereArtEigenReparaturfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtErstmusterFreigabeAm($value)
 * @method static Builder<static>|Artikel whereArtErstmusterFreigabeJN($value)
 * @method static Builder<static>|Artikel whereArtErstmusterInterval($value)
 * @method static Builder<static>|Artikel whereArtErstmusterPruefungJN($value)
 * @method static Builder<static>|Artikel whereArtExportAm($value)
 * @method static Builder<static>|Artikel whereArtExportFremdsoftwareJN($value)
 * @method static Builder<static>|Artikel whereArtFaktorMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtFertigungsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtFertigungskosten($value)
 * @method static Builder<static>|Artikel whereArtFibuKontoGruppeAR($value)
 * @method static Builder<static>|Artikel whereArtFibuKontoGruppeVB($value)
 * @method static Builder<static>|Artikel whereArtFilialExportJN($value)
 * @method static Builder<static>|Artikel whereArtFormelMengeneinheit1($value)
 * @method static Builder<static>|Artikel whereArtFormelMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtFremdReparaturfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtFremdfertigungJN($value)
 * @method static Builder<static>|Artikel whereArtFremdfertigungskosten($value)
 * @method static Builder<static>|Artikel whereArtGeprueftAm($value)
 * @method static Builder<static>|Artikel whereArtGeprueftDurch($value)
 * @method static Builder<static>|Artikel whereArtGewichtsbasis($value)
 * @method static Builder<static>|Artikel whereArtIndividualC1($value)
 * @method static Builder<static>|Artikel whereArtIndividualC2($value)
 * @method static Builder<static>|Artikel whereArtIndividualC3($value)
 * @method static Builder<static>|Artikel whereArtIndividualC4($value)
 * @method static Builder<static>|Artikel whereArtIndividualC5($value)
 * @method static Builder<static>|Artikel whereArtIndividualC6($value)
 * @method static Builder<static>|Artikel whereArtIndividualC7($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo1($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo2($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo3($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo4($value)
 * @method static Builder<static>|Artikel whereArtIndividualD1($value)
 * @method static Builder<static>|Artikel whereArtIndividualD2($value)
 * @method static Builder<static>|Artikel whereArtIndividualD3($value)
 * @method static Builder<static>|Artikel whereArtIndividualD4($value)
 * @method static Builder<static>|Artikel whereArtIndividualD5($value)
 * @method static Builder<static>|Artikel whereArtIndividualD6($value)
 * @method static Builder<static>|Artikel whereArtIndividualD7($value)
 * @method static Builder<static>|Artikel whereArtIndividualT1($value)
 * @method static Builder<static>|Artikel whereArtIndividualT2($value)
 * @method static Builder<static>|Artikel whereArtIndividualT3($value)
 * @method static Builder<static>|Artikel whereArtIndividualT4($value)
 * @method static Builder<static>|Artikel whereArtInventurAm($value)
 * @method static Builder<static>|Artikel whereArtInventurpreis($value)
 * @method static Builder<static>|Artikel whereArtKalkulatorischerEK($value)
 * @method static Builder<static>|Artikel whereArtLetzteAenderungAm($value)
 * @method static Builder<static>|Artikel whereArtLetzteAenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtLetztePreisaenderungAm($value)
 * @method static Builder<static>|Artikel whereArtLetztePreisaenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtLiefErklaerungGueltigBis($value)
 * @method static Builder<static>|Artikel whereArtLiefErklaerungsPflichtigJN($value)
 * @method static Builder<static>|Artikel whereArtLieferantenfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtLockingAm($value)
 * @method static Builder<static>|Artikel whereArtLockingDurch($value)
 * @method static Builder<static>|Artikel whereArtMatchcode($value)
 * @method static Builder<static>|Artikel whereArtMaterialkosten($value)
 * @method static Builder<static>|Artikel whereArtMenge2ProVerpackungEK($value)
 * @method static Builder<static>|Artikel whereArtMenge2ProVerpackungVK($value)
 * @method static Builder<static>|Artikel whereArtMengeProVerpackungEK($value)
 * @method static Builder<static>|Artikel whereArtMengeProVerpackungVK($value)
 * @method static Builder<static>|Artikel whereArtMieteVerleihJN($value)
 * @method static Builder<static>|Artikel whereArtNRKostenstelleAR($value)
 * @method static Builder<static>|Artikel whereArtNRKostenstelleVB($value)
 * @method static Builder<static>|Artikel whereArtNRKostentraegerAR($value)
 * @method static Builder<static>|Artikel whereArtNRKostentraegerVB($value)
 * @method static Builder<static>|Artikel whereArtNettoGewicht($value)
 * @method static Builder<static>|Artikel whereArtNorm($value)
 * @method static Builder<static>|Artikel whereArtNotiz($value)
 * @method static Builder<static>|Artikel whereArtOberflaeche($value)
 * @method static Builder<static>|Artikel whereArtOptimaleBestellmenge1($value)
 * @method static Builder<static>|Artikel whereArtOptimaleBestellmenge2($value)
 * @method static Builder<static>|Artikel whereArtOptimaleFertigungsmenge1($value)
 * @method static Builder<static>|Artikel whereArtOptimaleFertigungsmenge2($value)
 * @method static Builder<static>|Artikel whereArtPickingMethode($value)
 * @method static Builder<static>|Artikel whereArtPlanungshorizont($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzDynamischJN($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzJNA($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzWert($value)
 * @method static Builder<static>|Artikel whereArtPreisProMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtPriceFormular($value)
 * @method static Builder<static>|Artikel whereArtProvisionProzent($value)
 * @method static Builder<static>|Artikel whereArtProvisionsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtPruefpflichtigJN($value)
 * @method static Builder<static>|Artikel whereArtRabatt1($value)
 * @method static Builder<static>|Artikel whereArtRabatt2($value)
 * @method static Builder<static>|Artikel whereArtRabatt3($value)
 * @method static Builder<static>|Artikel whereArtRabattWert1($value)
 * @method static Builder<static>|Artikel whereArtRabattWert2($value)
 * @method static Builder<static>|Artikel whereArtRabattfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtRoHSKonformJN($value)
 * @method static Builder<static>|Artikel whereArtSeriennummernfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtServiceJN($value)
 * @method static Builder<static>|Artikel whereArtSkontofaehigJN($value)
 * @method static Builder<static>|Artikel whereArtSnrHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Artikel whereArtSnrHerstelldatum($value)
 * @method static Builder<static>|Artikel whereArtSnrVerfallsdatum($value)
 * @method static Builder<static>|Artikel whereArtSondereinzelkosten($value)
 * @method static Builder<static>|Artikel whereArtStkAufAufloesungJN($value)
 * @method static Builder<static>|Artikel whereArtStkAufAusgabeJN($value)
 * @method static Builder<static>|Artikel whereArtStkAuftragLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkBesAufloesungJN($value)
 * @method static Builder<static>|Artikel whereArtStkBesAusgabeJN($value)
 * @method static Builder<static>|Artikel whereArtStkBestellLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkBestellbeistellungJN($value)
 * @method static Builder<static>|Artikel whereArtStkBestellpreis($value)
 * @method static Builder<static>|Artikel whereArtStkDispodifferenz($value)
 * @method static Builder<static>|Artikel whereArtStkDispotermin($value)
 * @method static Builder<static>|Artikel whereArtStkEinkaufspreis($value)
 * @method static Builder<static>|Artikel whereArtStkFertLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkKundenbeistellabgangJN($value)
 * @method static Builder<static>|Artikel whereArtStkKundenbeistellungJN($value)
 * @method static Builder<static>|Artikel whereArtStkManuellJN($value)
 * @method static Builder<static>|Artikel whereArtStkMultiplikatorJN($value)
 * @method static Builder<static>|Artikel whereArtStkPseudobaugruppeJN($value)
 * @method static Builder<static>|Artikel whereArtStkVerkaufspreis($value)
 * @method static Builder<static>|Artikel whereArtStlAenderungAm($value)
 * @method static Builder<static>|Artikel whereArtStlAenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtStuecklisteJN($value)
 * @method static Builder<static>|Artikel whereArtUrsprungsnachweisJN($value)
 * @method static Builder<static>|Artikel whereArtVKBrutto($value)
 * @method static Builder<static>|Artikel whereArtVerkaufsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreis1($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreisNeu($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreisNeuDatum($value)
 * @method static Builder<static>|Artikel whereArtWebshopLetzteAktualisierungAm($value)
 * @method static Builder<static>|Artikel whereArtWebshopNaechsteAktualisierungJN($value)
 * @method static Builder<static>|Artikel whereArtWebshopfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtWebshopkennung($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffAnteil($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffPreisbasisEK($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffPreisbasisVK($value)
 * @method static Builder<static>|Artikel whereArtWiederbeschaffungszeit($value)
 * @method static Builder<static>|Artikel whereArtZeichnungsformat($value)
 * @method static Builder<static>|Artikel whereArtZeichnungsnummer($value)
 * @method static Builder<static>|Artikel whereArtikelUntergruppeID($value)
 * @method static Builder<static>|Artikel whereArtikelnummer($value)
 * @method static Builder<static>|Artikel whereInterneArtikelnummer($value)
 * @method static Builder<static>|Artikel whereKZArtGewichtseinheit($value)
 * @method static Builder<static>|Artikel whereKZArtMengeneinheit1($value)
 * @method static Builder<static>|Artikel whereKZArtMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereKZArtikelRabattgruppe($value)
 * @method static Builder<static>|Artikel whereKZArtikelgruppe($value)
 * @method static Builder<static>|Artikel whereKZIntraStat($value)
 * @method static Builder<static>|Artikel whereKZKalkulationGruppe($value)
 * @method static Builder<static>|Artikel whereKZProduktgruppe($value)
 * @method static Builder<static>|Artikel whereKZWarengruppe($value)
 * @method static Builder<static>|Artikel whereKZZusatztext($value)
 * @method static Builder<static>|Artikel whereLinecardID($value)
 * @method static Builder<static>|Artikel whereMwstNummer($value)
 * @method static Builder<static>|Artikel whereNRPreisbasis($value)
 * @method static Builder<static>|Artikel whereNRWerkstoff($value)
 * @method static Builder<static>|Artikel whereTimeStamp($value)
 * @method static Builder<static>|Artikel whereWithholdingtaxKategorieID($value)
 * @mixin Eloquent
 */
class Artikel extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Artikel';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];
}

