<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Clean and sanitize HTML to prevent XSS attacks while preserving standard rich text formatting.
     */
    public static function cleanHtml(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Allowed safe tags for rich text
        $allowedTags = '<p><br><strong><b><em><i><u><s><ul><ol><li><a><table><thead><tbody><tr><th><td><h1><h2><h3><h4><h5><h6><blockquote><hr><span><div>';

        $cleaned = strip_tags($html, $allowedTags);

        // Strip dangerous javascript: and inline event handlers (onclick, onload, onerror, etc.)
        $cleaned = preg_replace('/(<[^>]+?)(on[a-zA-Z]+\s*=\s*([\"\'][^\"\']*[\"\']|[^\s>]+))/i', '$1', $cleaned);
        $cleaned = preg_replace('/href=([\"\'])\s*javascript:[^\"\']*([\"\'])/i', 'href=$1#$2', $cleaned);

        return $cleaned;
    }

    /**
     * Clean Google Maps embed iframe to prevent XSS.
     */
    public static function cleanMapEmbed(?string $iframe): ?string
    {
        if (empty($iframe)) {
            return null;
        }

        // Only allow <iframe> tag
        $cleaned = strip_tags($iframe, '<iframe>');

        // Strip inline event handlers
        $cleaned = preg_replace('/(<[^>]+?)(on[a-zA-Z]+\s*=\s*([\"\'][^\"\']*[\"\']|[^\s>]+))/i', '$1', $cleaned);

        return $cleaned;
    }
}
