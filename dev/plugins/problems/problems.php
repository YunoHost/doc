<?php

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Plugin\Problems\Base\ProblemChecker;
use RocketTheme\Toolbox\Event\Event;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Class ProblemsPlugin
 * @package Grav\Plugin
 */
class ProblemsPlugin extends Plugin
{
    /** @var ProblemChecker|null */
    protected $checker;
    /** @var array */
    protected $problems = [];

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100002],
                ['onPluginsInitialized', 100001]
            ],
            'onAdminGenerateReports' => ['onAdminGenerateReports', 0],
            'onAdminCompilePresetSCSS' => ['onAdminCompilePresetSCSS', 0]
        ];
    }

    /**
     * [onPluginsInitialized:100000] Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * @return void
     */
    public function onFatalException(): void
    {
        if (\defined('GRAV_CLI') || $this->isAdmin()) {
            return;
        }

        // Run through potential issues
        if ($this->problemsFound()) {
            $this->renderProblems();
        }
    }

    /**
     * Add Flex-Object's preset.scss to the Admin Preset SCSS compile process
     *
     * @param Event $event
     */
    public function onAdminCompilePresetSCSS(Event $event): void
    {
        $event['scss']->add($this->grav['locator']->findResource('plugins://problems/scss/_preset.scss'));
    }

    /**
     * @return void
     */
    public function onPluginsInitialized(): void
    {
        if (\defined('GRAV_CLI') || $this->isAdmin()) {
            return;
        }

        $this->enable([
            'onFatalException' => ['onFatalException', 0],
        ]);

        $this->checker = new ProblemChecker();

        if (!$this->checker->statusFileExists()) {
            // If no issues remain, save a state file in the cache
            if (!$this->problemsFound()) {
                // delete any existing validated files
                /** @var \SplFileInfo $fileInfo */
                foreach (new \GlobIterator(CACHE_DIR . ProblemChecker::PROBLEMS_PREFIX . '*') as $fileInfo) {
                    @unlink($fileInfo->getPathname());
                }
                // create a file in the cache dir so it only runs on cache changes
                $this->checker->storeStatusFile();
            } else {
                $this->renderProblems();
            }
        }
    }

    /**
     * @return never-return
     */
    private function renderProblems(): void
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];

        /** @var Environment $twig */
        $twig = $this->getTwig();

        $data = [
            'problems' => $this->problems,
            'base_url' => $baseUrlRelative = $uri->rootUrl(false),
            'problems_url' => $baseUrlRelative . '/user/plugins/problems',
        ];

        echo $twig->render('problems.html.twig', $data);
        http_response_code(500);
        exit();
    }

    /**
     * @param Event $e
     * @return void
     */
    public function onAdminGenerateReports(Event $e): void
    {
        $reports = $e['reports'];

        $this->checker = new ProblemChecker();

        // Check for problems
        $this->problemsFound();

        /** @var Uri $uri */
        $uri = $this->grav['uri'];

        /** @var Environment $twig */
        $twig = $this->getTwig();

        $data = [
            'problems' => $this->problems,
            'base_url' => $baseUrlRelative = $uri->rootUrl(false),
            'problems_url' => $baseUrlRelative . '/user/plugins/problems',
        ];

        $reports['Grav Potential Problems'] = $twig->render('reports/problems-report.html.twig', $data);

        $this->grav['assets']->addCss('plugins://problems/css/admin.css');
        $this->grav['assets']->addCss('plugins://problems/css/spectre-icons.css');
    }

    /**
     * @return bool
     */
    private function problemsFound(): bool
    {
        if (null === $this->checker) {
            $this->checker = new ProblemChecker();
        }

        $status = $this->checker->check(__DIR__ . '/classes/Problems');
        $this->problems = $this->checker->getProblems();
        
        return $status;
    }

    /**
     * @return Environment
     */
    private function getTwig(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/templates');
        $twig = new Environment($loader, ['debug' => true]);
        $twig->addExtension(New DebugExtension());

        return $twig;
    }
}
