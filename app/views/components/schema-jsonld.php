<?php

$schema = $data['schema_jsonld'] ?? null;

if($schema === null) {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '/';
    $siteUrl = rtrim(URL_ROOT, '/');

    if($path === '/' || $path === '') {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Encontre Instrutor',
            'url' => $siteUrl . '/',
            'description' => 'Plataforma para encontrar instrutores de direção credenciados e agendar aulas.',
        ];
    } elseif(strpos($path, '/admin/emergencias') !== false) {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'EmergencyService',
            'name' => 'Emergência - Encontre Instrutor',
            'url' => $siteUrl . $path,
            'telephone' => '190'
        ];
    }
}

if($schema === null) {
    return;
}

?>

<script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
