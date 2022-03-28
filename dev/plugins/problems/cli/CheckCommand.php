<?php

namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;
use Grav\Plugin\Problems\Base\Problem;
use Grav\Plugin\Problems\Base\ProblemChecker;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ProblemsCommand
 *
 * @package Grav\Plugin\Console
 */
class CheckCommand extends ConsoleCommand
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('check')
            ->setDescription('Check Problems')
            ->setHelp('The <info>problems command</info> allows you display any potential problems with your Grav setup')
        ;
    }

    /**
     * @return int
     */
    protected function serve(): int
    {
        $io = new SymfonyStyle($this->input, $this->output);

        $plugin_dir = realpath(dirname(__DIR__));
        $problems_dir = $plugin_dir . '/classes/Problems';

        require $plugin_dir . '/vendor/autoload.php';

        $checker = new ProblemChecker();
        $checker->check($problems_dir);

        $problems = $checker->getProblems();

        $io->title('Grav Problems');

        $table = new Table($this->output);
        $table->setStyle('default');
        $headers = ['ID', 'Status', 'Level', 'Message'];
        $rows = [];

        /** @var Problem $problem */
        foreach ($problems as $problem) {
            $rows[] = new TableSeparator();

            $rows[] = [
                $problem->getStatus() ? $problem->getId() : '<red>' . $problem->getId() . '</red>' ,
                $problem->getStatus() ? '<green>success</green>' : '<red>error</red>',
                $problem->getLevel() === 'critical' ? '<red>' . $problem->getLevel() . '</red>' : '<yellow>' .$problem->getLevel() . '</yellow>',
                strip_tags($problem->getMsg()),
            ];

            $details = $problem->getDetails();

            if (is_array($details)) {

                $errors_row = [];
                $success_row = [];

                if (isset($details['errors'])) {
                    foreach ($details['errors'] as $key => $value) {
                        $errors_row[] = "<red>✗</red> <yellow>{$key} → {$value}</yellow>";
                    }
                }

                if (isset($details['success'])) {
                    foreach ($details['success'] as $key => $value) {
                        $success_row[] = "<green>✔</green> {$key} → {$value}";
                    }
                }

                foreach($errors_row as $e_row) {
                    $rows[] = ['', new TableCell($e_row, array('colspan' => 3)), ];
                }

                foreach($success_row as $e_row) {
                    $rows[] = ['', new TableCell($e_row, array('colspan' => 3)), ];
                }
            }
        }

        if (!empty($rows)) {
            $table->setHeaders($headers);
            $table->setRows($rows);
            $table->render();
        } else {
            $io->text('did not find anything to check...');
        }

        return 0;
    }
}

