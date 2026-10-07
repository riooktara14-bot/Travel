<?php

use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require dirname(__DIR__).'/vendor/autoload.php';

$baseUrl = rtrim((string) getenv('PAGES_BASE_URL'), '/');

if ($baseUrl === '' || filter_var($baseUrl, FILTER_VALIDATE_URL) === false) {
    throw new RuntimeException('PAGES_BASE_URL must contain the public GitHub Pages URL.');
}

putenv('APP_URL='.$baseUrl);
$_ENV['APP_URL'] = $baseUrl;
$_SERVER['APP_URL'] = $baseUrl;

$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(ConsoleKernel::class)->bootstrap();
$app->make('url')->forceRootUrl($baseUrl);
$app->make('url')->forceScheme('https');
$kernel = $app->make(Kernel::class);

$outputDirectory = dirname(__DIR__).'/_site';

if (! is_dir($outputDirectory) && ! mkdir($outputDirectory, 0777, true) && ! is_dir($outputDirectory)) {
    throw new RuntimeException('The GitHub Pages output directory could not be created.');
}

$staticPages = [
    '/' => 'index.html',
    '/destination' => 'wisata.html',
    '/transportasi2' => 'transportasi.html',
    '/contact' => 'contact.html',
    '/daftar' => 'daftar.html',
    '/masuk' => 'masuk.html',
    '/booking1' => 'booking.html',
];
$staticRoutes = [
    '' => 'index.html',
    'destination' => 'wisata.html',
    'transportasi2' => 'transportasi.html',
    'contact' => 'contact.html',
    'daftar' => 'daftar.html',
    'login' => 'masuk.html',
    'masuk' => 'masuk.html',
    'booking1' => 'booking.html',
];

foreach ($staticPages as $route => $fileName) {
    if ($route === '/destination' || $route === '/booking1') {
        $viewData = $route === '/destination'
            ? [
                'destinasi' => collect(),
                'lokasiList' => collect(),
                'search' => '',
                'selectedLocation' => '',
            ]
            : [
                'destinasi' => collect(),
                'transportasis' => collect(),
            ];

        $html = $app->make('view')->make(
            $route === '/destination' ? 'destination' : 'booking1',
            $viewData,
        )->render();
    } else {
        $request = Request::create($route, 'GET');
        $response = $kernel->handle($request);

        if (! $response->isSuccessful()) {
            throw new RuntimeException('The page '.$route.' could not be rendered (HTTP '.$response->getStatusCode().').');
        }

        $html = $response->getContent();
        $kernel->terminate($request, $response);
    }

    if (! is_string($html)) {
        throw new RuntimeException('The page '.$route.' did not contain HTML.');
    }

    $html = preg_replace_callback(
        '~href=(["\'])'.preg_quote($baseUrl, '~').'/([^"\']*)\1~',
        static function (array $matches) use ($baseUrl, $staticRoutes): string {
            $path = parse_url($matches[2], PHP_URL_PATH);
            $route = trim(is_string($path) ? $path : '', '/');

            if (isset($staticRoutes[$route])) {
                return 'href="'.$staticRoutes[$route].'"';
            }

            return $route === '' ? 'href="'.$baseUrl.'/"' : 'href="#id-1"';
        },
        $html,
    );

    if (! is_string($html)) {
        throw new RuntimeException('The page '.$route.' links could not be prepared for static hosting.');
    }

    $html = str_replace('href="#"', 'href="#id-1"', $html);

    $demoNotice = <<<'HTML'
<aside role="status" style="position:relative;z-index:9999;padding:12px 20px;background:#fff4df;color:#573900;text-align:center;font:600 14px/1.5 Arial,sans-serif">
    Versi demo statis: semua menu halaman bisa dibuka. Login, daftar, booking, pencarian, dan pengiriman formulir belum aktif karena situs ini tidak memakai backend atau database.
</aside>
HTML;
    $formGuard = <<<'HTML'
<script>
document.addEventListener('submit', function (event) {
    event.preventDefault();
    window.alert('Ini hanya demo statis. Fitur ini memerlukan backend dan database.');
});
</script>
HTML;
    $html = preg_replace('/<body\b[^>]*>/i', '$0'.$demoNotice, $html, 1);

    if (! is_string($html)) {
        throw new RuntimeException('The demo notice could not be added to '.$fileName.'.');
    }

    $html = preg_replace('/<\/body>/i', $formGuard.'</body>', $html, 1);

    if (! is_string($html)) {
        throw new RuntimeException('The static form guard could not be added to '.$fileName.'.');
    }

    if (file_put_contents($outputDirectory.'/'.$fileName, $html) === false) {
        throw new RuntimeException('The static page could not be written: '.$fileName);
    }
}

if (file_put_contents($outputDirectory.'/.nojekyll', '') === false) {
    throw new RuntimeException('The GitHub Pages configuration file could not be written.');
}

foreach (['assets', 'assets2'] as $assetDirectory) {
    $sourceDirectory = dirname(__DIR__).'/public/'.$assetDirectory;
    $targetDirectory = $outputDirectory.'/'.$assetDirectory;

    if (! is_dir($sourceDirectory)) {
        throw new RuntimeException('Required public asset directory is missing: '.$sourceDirectory);
    }

    $directoryIterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourceDirectory, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
    );

    foreach ($directoryIterator as $item) {
        $target = $targetDirectory.DIRECTORY_SEPARATOR.$directoryIterator->getSubPathName();

        if ($item->isDir()) {
            if (! is_dir($target) && ! mkdir($target, 0777, true) && ! is_dir($target)) {
                throw new RuntimeException('A static asset directory could not be created: '.$target);
            }

            continue;
        }

        $targetParent = dirname($target);

        if (! is_dir($targetParent) && ! mkdir($targetParent, 0777, true) && ! is_dir($targetParent)) {
            throw new RuntimeException('A static asset directory could not be created: '.$targetParent);
        }

        if (! copy($item->getPathname(), $target)) {
            throw new RuntimeException('A static asset could not be copied: '.$item->getPathname());
        }
    }
}

fwrite(STDOUT, "Exported all seven public menu pages and their assets to _site/.\n");
