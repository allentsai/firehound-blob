<?php
/**
 * Created by PhpStorm.
 * User: allentsai
 * Date: 7/6/16
 * Time: 4:31 PM
 */

namespace PaperG\FirehoundBlob;


class Scenario
{
    const FB_MANAGED = 'Facebook-Managed';
    const FB_UNMANAGED = 'Facebook-Unmanaged';
    const FB_UNMANAGED_V2 = 'Facebook-Unmanaged-v2';
    const AN_DESKTOP = 'AppNexus-Desktop';
    const AN_MOBILE  = 'AppNexus-Mobile';
    const AN_DESKTOP_MOBILE = 'AppNexus-Desktop-Mobile';
    const DCM_UNMANAGED = "DCM-Unmanaged";

    public static $validScenarios = [
        self::FB_MANAGED,
        self::FB_UNMANAGED,
        self::FB_UNMANAGED_V2,
        self::AN_DESKTOP,
        self::AN_MOBILE,
        self::AN_DESKTOP_MOBILE,
        self::DCM_UNMANAGED
    ];
}
