<?php

/**
 * CSV Type Extensions
 */
function allowExtFilesCSV(): array
{
    return [
        'csv',
    ];
}

/**
 * Image Extensions
 */
function allowExtFilesImage(): array
{
    return [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'bmp',
    ];
}

/**
 * PDF Extensions
 */
function allowExtPDF(): array
{
    return [
        'pdf',
    ];
}

/**
 * Allow Files
 */
function allowExtFiles(): array
{
    return [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'bmp',
        'pdf',
        'csv',
        'doc',
        'docx',
        'xls',
        'ppt',
        'pptx',
    ];
}

/**
 * Get File Extension
 */
function getEx(string $fileName): string
{
    $fileName = trim($fileName);
    $fileName = explode('.', $fileName);

    return end($fileName);
}

/**
 * Check If File is CSV
 */
function checkFiles(string $fileName): bool
{
    return in_array(getEx($fileName), allowExtFilesCSV());
}

/**
 * Check If File Is Image
 */
function checkImages(string $fileName): bool
{
    return in_array(getEx($fileName), allowExtFilesImage());
}

/**
 * Check If File Is PDF
 */
function checkPDF(string $fileName): bool
{
    return in_array(getEx($fileName), allowExtPDF());
}

/**
 * Get File Extension Name
 */
function fileTypeName(): array
{
    return [
        'pdf' => 'Adobe Acrobat',
        'doc' => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls' => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip' => 'Archive',
        'gif' => 'GIF Image',
        'jpg' => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png' => 'PNG Image',
        'ppt' => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ];
}

/**
 * Get File Extension Icon
 */
function fileIcon(): array
{
    return [
        'pdf' => 'fa-file-pdf-o',
        'doc' => 'fa-file-word-o',
        'docx' => 'fa-file-word-o',
        'xls' => 'fa-file-excel-o',
        'xlsx' => 'fa-file-excel-o',
        'zip' => 'fa-file-archive-o',
        'gif' => 'fa-file-image-o',
        'jpg' => 'fa-file-image-o',
        'jpeg' => 'fa-file-image-o',
        'png' => 'fa-file-image-o',
        'ppt' => 'fa-file-powerpoint-o',
        'pptx' => 'fa-file-powerpoint-o',
    ];
}

/**
 * Get Ex of File Name & Icon
 */
function getTypeFile(string $ex, string $fileIcon = null, string $fileType = null): array
{
    if (array_key_exists($ex, fileIcon()) && array_key_exists($ex, fileTypeName())) {
        $fileIcon = fileIcon()[$ex];
        $fileType = fileTypeName()[$ex];
    }

    return ['fileIcon' => $fileIcon, 'fileType' => $fileType];
}

/**
 * Check Allowed Extensions
 */
function checklist(string $fileName): bool
{
    return in_array(getEx($fileName), allowExtFilesImage());
}
