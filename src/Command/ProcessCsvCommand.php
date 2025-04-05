<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// Define un nuevo comando de consola en Symfony con el nombre 'app:process-csv'.
// Este comando tiene una descripción breve que puedes personalizar.
#[AsCommand(
    name: 'app:process-csv',
    description: 'Add a short description for your command',
)]
class ProcessCsvCommand extends Command
{
    // El constructor de la clase. Llama al constructor de la clase padre Command.
    public function __construct()
    {
        parent::__construct();
    }

    // Configura el comando, definiendo los argumentos y opciones que acepta.
    protected function configure(): void
    {
        $this
            // Añade un argumento opcional llamado 'arg1' con una descripción.
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // Añade una opción llamada 'option1' que no requiere un valor (es un flag).
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    // Ejecuta el comando cuando se llama desde la línea de comandos.
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Crea una instancia de SymfonyStyle para mejorar la salida del comando.
        $io = new SymfonyStyle($input, $output);

        // Obtiene el valor del argumento 'arg1' si se ha proporcionado.
        $arg1 = $input->getArgument('arg1');

        // Si 'arg1' tiene un valor, muestra una nota con el valor pasado.
        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        // Si la opción 'option1' está habilitada, escribe un mensaje en la salida.
        if ($input->getOption('option1')) {
            $output->writeln('Option1 is enabled.');
        }

        // Muestra un mensaje de éxito indicando que el comando se ha ejecutado.
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        // Devuelve un código de éxito para indicar que el comando se ejecutó correctamente.
        return Command::SUCCESS;
    }
}