<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;

/**
 * Class \Slide
 *
 * @property string $Text
 * @property boolean $TextWhite
 * @property int $ImageID
 * @method \SilverStripe\Assets\Image Image()
 */
class Slide extends DataObject
{
    const TEXT = 'Text';
    const TEXT_WHITE = 'TextWhite';
    const IMAGE = 'Image';

    private static $db = [
        self::TEXT => DBConstants::TEXT,
        self::TEXT_WHITE => DBConstants::BOOLEAN,
    ];

    private static $has_one = [
        self::IMAGE => Image::class
    ];

    private static $owns = [
        self::IMAGE
    ];

    private static $summary_fields = [
        self::TEXT
    ];
}
