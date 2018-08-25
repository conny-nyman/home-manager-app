<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\Core\Config\Config;

// remove PasswordValidator for SilverStripe 5.0
$validator = new PasswordValidator();

$validator->minLength(8);
$validator->checkHistoricalPasswords(6);
Member::set_password_validator($validator);

// Generate class docblocks
Config::modify()->set('SilverLeague\IDEAnnotator\DataObjectAnnotator', 'enabled', true);
