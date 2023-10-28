<?php

/**
 * Get The Application Locale
 */
function GetLanguage(): string
{
    return App::getLocale();
}

/**
 * Get's The Site Direction
 */
function GetDirection(): string
{
    return GetLanguage() == 'ar' ? 'rtl' : 'ltr';
}

/**
 * Get's The Default Language
 */
function GetDefaultLang(): string
{
    return 'ar';
}

/**
 * if design isRtl
 */
function isRtl(): bool
{
    return GetLanguage() == 'ar' ? true : false;
}
