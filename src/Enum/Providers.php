<?php


namespace App\Enum;


use MyCLabs\Enum\Enum;


/**
 * @template-extends Enum<string>
 *
 * @method static Providers UPS()
 * @method static Providers OMNIVA()
 * @method static Providers DHL()
 */
final class Providers extends Enum
{
    private const UPS = 'ups';
    private const OMNIVA = 'omniva';
    private const DHL = 'dhl';
}