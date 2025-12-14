<?php

$pageTitle = trim((string)($data['title'] ?? ''));
if($pageTitle === '') {
    $pageTitle = 'Encontre Instrutor';
}

$title = $pageTitle . ' | Encontre Instrutor - Aulas de Direção DETRAN 2025';

$metaDescription = trim((string)($data['meta_description'] ?? ''));
if($metaDescription === '') {
    $metaDescription = 'Aulas práticas de direção com instrutores autônomos credenciados DETRAN. Mais barato, flexível e seguro. Comece agora!';
}

$robots = trim((string)($data['meta_robots'] ?? 'index,follow'));

$path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '/';
$canonical = rtrim(URL_ROOT, '/') . $path;

$ogImage = trim((string)($data['og_image'] ?? ''));
if($ogImage === '') {
    $ogImage = rtrim(URL_ROOT, '/') . '/public/images/og-instrutor.jpg';
}

$ogType = trim((string)($data['og_type'] ?? 'website'));

?>

<title><?php echo htmlspecialchars($title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
<meta name="robots" content="<?php echo htmlspecialchars($robots); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">

<meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
<meta property="og:type" content="<?php echo htmlspecialchars($ogType); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
<meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
<meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage); ?>">
