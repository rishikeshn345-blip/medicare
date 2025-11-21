<?php
declare(strict_types=1);

// Path to uploaded JSON (use the provided local path)
$jsonPath = '/mnt/data/emergency.json';

// CORS & JSON headers (adjust Access-Control-Allow-Origin for production)
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

// Read JSON file
if (!is_readable($jsonPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Data file not available.']);
    exit;
}

$raw = file_get_contents($jsonPath);
$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(500);
    echo json_encode(['error' => 'Invalid JSON data.']);
    exit;
}

// Query parameters
// q  - search term (partial, case-insensitive across string fields)
// stage - optional exact stage filter
// name - optional exact name match (returns exact item if matched)
$q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
$stageFilter = isset($_GET['stage']) ? trim((string)$_GET['stage']) : '';
$nameExact = isset($_GET['name']) ? trim((string)$_GET['name']) : '';

// helper: case-insensitive contains
function ci_contains(string $haystack, string $needle): bool {
    return mb_stripos($haystack, $needle) !== false;
}

$results = [];

foreach ($data as $item) {
    if (!is_array($item)) continue;

    // name exact match preference
    if ($nameExact !== '') {
        if (isset($item['name']) && strcasecmp(trim((string)$item['name']), $nameExact) === 0) {
            $results[] = $item;
            break;
        } else {
            continue;
        }
    }

    // stage filter (if set)
    if ($stageFilter !== '') {
        if (!isset($item['stage']) || strcasecmp(trim((string)$item['stage']), $stageFilter) !== 0) {
            continue;
        }
    }

    // search term filter
    if ($q !== '') {
        $searchableParts = [];
        foreach ($item as $k => $v) {
            if (is_string($v) && $v !== '') $searchableParts[] = $v;
        }
        $hay = mb_strtolower(implode(' ', $searchableParts));
        $needle = mb_strtolower($q);
        if (mb_strpos($hay, $needle) === false) {
            continue;
        }
    }

    $results[] = $item;
}

// response meta + data
$response = [
    'meta' => [
        'total_matches' => count($results),
        'query' => $q,
        'stage' => $stageFilter,
        'name' => $nameExact,
    ],
    'data' => array_values($results),
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
