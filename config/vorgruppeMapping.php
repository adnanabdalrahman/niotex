<?php
/*
    'SV' und 'ENA' → 'E',
    'SM' und 'RT1' → 'M_RM',
    'SM' und 'NA1 → 'M_NM',
    'SR' und 'RT1' → 'M_RR',
    'SR' und 'NA1' → 'M_NR',
    'SV' und 'UVI' → 'U',
    alles andere → 'RE',
*/
return [
    'RT1SM' => 'M_RM',
    'NA1SM' => 'M_NM',
    'RT1SR' => 'M_RR',
    'NA1SR' => 'M_NR',
    'ENASV' => 'E',
    'UVISV' => 'U',
];
