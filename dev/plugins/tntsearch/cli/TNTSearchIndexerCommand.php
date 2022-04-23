<?php
namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;
use Grav\Plugin\TNTSearchPlugin;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class IndexerCommand
 *
 * @package Grav\Plugin\Console
 */
class TNTSearchIndexerCommand extends ConsoleCommand
{
    /** @var array */
    protected $options = [];
    /** @var array */
    protected $colors = [
        'DEBUG'     => 'green',
        'INFO'      => 'cyan',
        'NOTICE'    => 'yellow',
        'WARNING'   => 'yellow',
        'ERROR'     => 'red',
        'CRITICAL'  => 'red',
        'ALERT'     => 'red',
        'EMERGENCY' => 'magenta'
    ];

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('index')
            ->addOption(
                'alt',
                null,
                InputOption::VALUE_NONE,
                'alternative output'
            )
            ->addOption(
                'language',
                'l',
                InputOption::VALUE_OPTIONAL,
                'optional language to index (multi-language sites only)'
            )
            ->setDescription('TNTSearch Indexer')
            ->setHelp('The <info>index command</info> re-indexes the search engine');
    }

    /**
     * @return int
     */
    protected function serve(): int
    {
        /** @var string|null $langCode */
        $langCode = $this->input->getOption('language');

        error_reporting(1);
        $this->setLanguage($langCode);
        $this->initializePages();

        $alt_output = $this->input->getOption('alt') ? true : false;

        if ($alt_output) {
            $output = $this->doIndex($langCode);
            $this->output->write($output);
            $this->output->writeln('');
        } else {
            $this->output->writeln('');
            $this->output->writeln('<magenta>Re-indexing</magenta>');
            $this->output->writeln('');
            $start = microtime(true);
            $output = $this->doIndex($langCode);
            $this->output->write($output);
            $this->output->writeln('');
            $end =  number_format(microtime(true) - $start,1);
            $this->output->writeln('');
            $this->output->writeln('Indexed in ' . $end . 's');
        }

        return 0;
    }

    /**
     * @param string|null $langCode
     * @return string
     */
    private function doIndex(string $langCode = null): string
    {
        [,,$output] = TNTSearchPlugin::indexJob($langCode);

        return $output;
    }
}

