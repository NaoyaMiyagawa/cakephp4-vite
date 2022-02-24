<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use RuntimeException;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class ViteHelper extends Helper
{
    private const VITE_BASE_URL = 'http://localhost:3000/';
    private const TS_BASE_PATH = 'resources/js/';
    private const JS_PROD_PATH = 'webroot/js';

    /**
     * @var string[]
     */
    protected $helpers = ['Html'];

    protected $_defaultConfig = [
        'manifestFile' => WWW_ROOT . 'js/manifest.json',
    ];

    /**
     * @var array
     */
    protected $manifest = [];

    public function initialize(array $config): void
    {
        parent::initialize($config);

        if (!Configure::read('debug')) {
            $manifestFile = $this->getConfig('manifestFile');
            $contents = file_get_contents($manifestFile);
            if (!$contents) {
                throw new RuntimeException("Could not read manifest file `{$manifestFile}`");
            }
            $data = json_decode($contents, true);
            if (json_last_error()) {
                throw new RuntimeException("Could not parse JSON in `{$manifestFile}`");
            }
            $this->manifest = $data;
        }
    }

    public function script(string $name, $options = []): ?string
    {
        if (Configure::read('debug')) {
            $options['type'] = 'module';
            return $this->Html->script($this->convertSrcPath($name), $options);
        }

        $name = $this->convertToPathForManifest($name);

        if (!isset($this->manifest[$name])) {
            throw new RuntimeException("No known asset with `{$name}`");
        }
        $asset = $this->manifest[$name];
        if (empty($asset['file'])) {
            throw new RuntimeException("The `{$name}` asset has no file attribute in the manifest.");
        }

        return
            (string)$this->Html->script($asset['file'], $options)
            . (string)$this->css($name, $options);
    }

    public function css(string $name, $options = []): ?string
    {
        if (!isset($this->manifest[$name])) {
            throw new RuntimeException("No known asset with `{$name}`");
        }
        $asset = $this->manifest[$name];
        if (empty($asset['css'])) {
            throw new RuntimeException("The `{$name}` asset has no css attribute in the manifest.");
        }

        $css = [];
        foreach ($asset['css'] as $file) {
            $css[] = $this->Html->css('/js/' . $file, $options);
        }

        return implode("\n", $css);
    }


    private function convertSrcPath(string $name): string
    {
        if (Configure::read('debug')) {
            return self::VITE_BASE_URL . self::TS_BASE_PATH . $name;
        }

        return self::JS_PROD_PATH . $name;
    }

    private function convertToPathForManifest(string $name): string
    {
        return self::TS_BASE_PATH . $name . '.ts';
    }
}
