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
    private const VITE_CLIENT_PATH = '@vite/client';
    private const JS_PREBUILD_PATH = 'resources/js/';

    /**
     * @var string[]
     */
    protected $helpers = ['Html'];

    protected $_defaultConfig = [
        'manifestFile' => WWW_ROOT . 'js/manifest.json',
    ];

    /** @var array manifest.json */
    protected $manifest = [];

    protected $hasViteClientEmitted = false;

    /**
     * initialize
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        if (!Configure::read('debug')) {
            $this->manifest = $this->readManifestData();
        }
    }

    /**
     * @param string $name
     * @param ?array $options
     * @return string
     */
    public function script(string $name, $options = []): string
    {
        if (Configure::read('debug')) {
            $filePath = self::VITE_BASE_URL . self::JS_PREBUILD_PATH . $name;
            $scriptTag = '';
            $options['type'] = 'module';

            if (!$this->hasViteClientEmitted) {
                $this->hasViteClientEmitted = true;
                $scriptTag .= $this->Html->script(self::VITE_BASE_URL . self::VITE_CLIENT_PATH, $options) . '\n';
            }

            return $scriptTag . (string)$this->Html->script($filePath, $options);
        }

        $asset = $this->getAssetOnManifest($name);
        if (empty($asset['file'])) {
            throw new RuntimeException("The `{$name}` asset has no file attribute in the manifest.");
        }

        return
            (string)$this->Html->script($asset['file'], $options)
            . (string)$this->css($asset, $options);
    }

    ##############################################################################
    # Private Methods
    ##############################################################################

    /**
     * @param array asset
     * @param ?array $options
     * @return string
     */
    private function css(array $asset, $options = []): string
    {
        if (empty($asset['css'])) {
            return '';
        }

        $cssTags = [];
        foreach ($asset['css'] as $css) {
            $cssTags[] = (string)$this->Html->css('/js/' . $css, $options);
        }

        return implode("\n", $cssTags);
    }

    /**
     * Get asset path object from manifest data
     * @return array
     */
    private function getAssetOnManifest(string $name): array
    {
        $pathInJs = self::JS_PREBUILD_PATH . $name . '.js';
        $pathInTs = self::JS_PREBUILD_PATH . $name . '.ts';

        if (isset($this->manifest[$pathInJs])) {
            return $this->manifest[$pathInJs];
        }

        if (isset($this->manifest[$pathInTs])) {
            return $this->manifest[$pathInTs];
        }

        throw new RuntimeException("No known asset with `{$name}`");
    }

    /**
     * Load manifest file and return decoded data
     * @return array
     */
    private function readManifestData(): array
    {
        $manifestFile = $this->getConfig('manifestFile');

        $contents = file_get_contents($manifestFile);
        if (!$contents) {
            throw new RuntimeException("Could not read manifest file `{$manifestFile}`");
        }

        $data = json_decode($contents, true);
        if (json_last_error()) {
            throw new RuntimeException("Could not parse JSON in `{$manifestFile}`");
        }

        return $data;
    }
}
