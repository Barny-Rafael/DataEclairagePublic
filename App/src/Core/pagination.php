<?php

function paginer(int $total, int $parPage = 10): array
{
    $totalPages = max(1, (int) ceil($total / $parPage));

    $page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT) ?: 1; // "abc" ou absent -> 1
    $page = min(max(1, $page), $totalPages);                          // -5 -> 1, 999 -> dernière page

    return [
        'page' => $page,
        'parPage' => $parPage,
        'total' => $total,
        'totalPages' => $totalPages,
        'offset' => ($page - 1) * $parPage,
    ];
}