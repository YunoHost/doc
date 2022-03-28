<?php

namespace Grav\Plugin\Console;

use Exception;
use Grav\Common\Utils;
use Grav\Common\Yaml;
use Grav\Console\ConsoleCommand;
use Symfony\Component\Console\Input\InputOption;
use function count;

/**
 * Class FlushQueueCommand
 * @package Grav\Console\Cli\
 */
class FlexConvertDataCommand extends ConsoleCommand
{
    /** @var array */
    protected $options = [];

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('convert-data')
            ->setAliases(['convertdata'])
            ->addOption(
                'in',
                'i',
                InputOption::VALUE_REQUIRED,
                'path to file to convert from (valid types: [json|yaml])'
            )
            ->addOption(
                'out',
                'o',
                InputOption::VALUE_REQUIRED,
                'format of file to convert to [json|yaml]'
            )
            ->setDescription('Converts data from one format to another')
            ->setHelp('The <info>clear-queue-failures</info> command clears any queue failures that have accumulated');
    }

    /**
     * @return int
     */
    protected function serve(): int
    {
        $input = $this->getInput();
        $io = $this->getIO();

        $out_raw = null;
        $in = $input->getOption('in');
        $in_parts = Utils::pathinfo($in);
        $in_extension = $in_parts['extension'];
        $out_extension = $input->getOption('out');

        $io->title('Flex Convert Data');

        if (!file_exists($in)) {
            $io->error('cannot find the file: ' . realpath($in));

            return 1;
        }

        if (!$in_extension) {
            $io->error($in . ' has no file extension defined');

            return 1;
        }

        if (!$out_extension) {
            $io->error($out_extension . ' is not a valid extension');

            return 1;
        }

        $in_raw = file_get_contents($in);

        // Get the input data
        if ($in_extension === 'yaml' || $in_extension === 'yml') {
            $in_data = Yaml::parse($in_raw);
        } elseif ($in_extension === 'json' ) {
            $in_data = json_decode($in_raw, true, 512, JSON_THROW_ON_ERROR);
        } else {
            $io->error('input files with extension ' . $in_extension . ', is not supported');

            return 1;
        }

        // Simple progress bar
        $progress = $io->createProgressBar(count($in_data));
        $progress->setFormat('verbose');
        $progress->start();

        // add Unique Id if needed
        $index = 0;
        $out_data = [];
        foreach ($in_data as $key => $entry) {
            if ($key === $index++) {
                $out_data[$this->generateKey()] = $entry;
            } else {
                $out_data[$key] = $entry;
            }
            $progress->advance();
        }

        // render progress
        $progress->finish();
        $io->newLine(2);
        
        // Convert to output format
        if ($out_extension === 'yaml' || $out_extension === 'yml') {
            $out_raw = Yaml::dump($out_data);
        } elseif ($out_extension === 'json' ) {
            $out_raw = json_encode($out_data, JSON_PRETTY_PRINT);
        } else {
            $io->error('input files with extension ' . $out_extension . ', is not supported');

            return 1;
        }

        // Write the file:
        $out_filename = $in_parts['dirname'] . '/' . $in_parts['filename'] . '.' . $out_extension;
        file_put_contents($out_filename, $out_raw);

        $io->success('successfully converted the file and saved as: ' . $out_filename);

        return 0;
    }

    /**
     * @return string|false
     * @throws Exception
     */
    protected function generateKey()
    {
        return substr(hash('sha256', random_bytes(32)), 0, 32);
    }
}
