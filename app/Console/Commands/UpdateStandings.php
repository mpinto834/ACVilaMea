<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Equipa;

class UpdateStandings extends Command
{
    protected $signature = 'standings:update';
    protected $description = 'Atualiza os standings das equipas';

    public function handle()
    {
        $pythonScriptPath = base_path('crawler.py');
        $command = escapeshellcmd("python $pythonScriptPath");
        $output = shell_exec($command);
        $pythonScriptPath = base_path('crawler.py');
        $output = escapeshellcmd("python3 $pythonScriptPath");
        $output = shell_exec($output);


        // Adiciona um log para verificar a saída bruta
        echo "Saída do script Python: $output\n";

        // Limpa a saída para obter apenas o JSON
        $json_start = strpos($output, '[');
        $json_end = strrpos($output, ']') + 1;
        $json_data = substr($output, $json_start, $json_end - $json_start);

        $equipes = json_decode($json_data, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($equipes)) {
            foreach ($equipes as $equipe) {
                // Log para verificar cada equipe
                echo "Atualizando equipe: " . $equipe['nome'] . " com pontos: " . $equipe['pontos'] . "\n";

                Equipa::updateOrCreate(
                    ['nome' => $equipe['nome']],
                    ['pontos' => $equipe['pontos']]
                );
            }
        } else {
            echo "Erro: JSON inválido ou vazio retornado pelo script Python.\n";
        }

        $this->info('Standings atualizados com sucesso!');
    }
} 