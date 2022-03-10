<?php

declare(strict_types=1);

namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use InvalidArgumentException;
use RuntimeException;

/**
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class ViteHelper extends Helper
{
    /** vite server */
    private const VITE_SERVER_URL = 'http://localhost:3000/';
    /** vite client */
    private const VITE_CLIENT = self::VITE_SERVER_URL . '@vite/client';
    /** js pre-build assets path */
    private const JS_PREBUILD_PATH = 'resources/js/';

    /** @var string[] */
    protected $helpers = ['Html'];

    /** @var string[] */
    protected $_defaultConfig = [
        'manifestFile' => WWW_ROOT . 'js/manifest.json',
    ];

    /** @var array manifest.json */
    protected $manifest = [];

    /** @var bool whether emitted vite client script */
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
     * Creates a script element for vite-bundled JS file.
     * @param string $name
     * @param ?array $options
     * @return string
     */
    public function script(string $name, $options = []): string
    {
        if (isset($options['type'])) {
            throw new InvalidArgumentException('Not allowed to set \'type\' option.');
        }

        $scriptOptions = $options + ['type' => 'module'];

        if (Configure::read('debug')) {
            $filePath = self::VITE_SERVER_URL . self::JS_PREBUILD_PATH . $name;
            $scriptTag = '';

            if (!$this->hasViteClientEmitted) {
                $this->hasViteClientEmitted = true;
                $scriptTag .= $this->Html->script(self::VITE_CLIENT, $scriptOptions) . '\n';
            }

            return $scriptTag . (string)$this->Html->script($filePath, $scriptOptions);
        }

        $asset = $this->getAssetOnManifest($name);
        if (empty($asset['file'])) {
            throw new RuntimeException("The `{$name}` asset has no file attribute in the manifest.");
        }

        return
            (string)$this->Html->script($asset['file'], $scriptOptions)
            . (string)$this->css($asset, $options);
    }

    ##############################################################################
    # Private Methods
    ##############################################################################

    /**
     * Creates a link element for vite-bundled CSS stylesheets.
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
        $pathInTs = self::JS_PREBUILD_PATH . $name . '.ts';
        if (isset($this->manifest[$pathInTs])) {
            return $this->manifest[$pathInTs];
        }

        $pathInJs = self::JS_PREBUILD_PATH . $name . '.js';
        if (isset($this->manifest[$pathInJs])) {
            return $this->manifest[$pathInJs];
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
