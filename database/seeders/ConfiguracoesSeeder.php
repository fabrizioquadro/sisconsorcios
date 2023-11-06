<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuracao;

class ConfiguracoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracao::create([
            'nmSistema' => "SisConsórcios",
            'dsTitulo' => "Sistema de Administração de Consórcios",
            'logo' => "logo.png",
            'stMensagemCad' => "Sim",
            'dsMensagemCad' => "<p>Bem Vindo %Name% ao %NameSystem% - %DescriptionSystem%</p><p>Voc&ecirc; acaba de ser cadastrado em nossa plataforma.</p><p>Para acessar entre na link %Link% com as seguintes credencias</p><p>Email: %User%</p><p>Senha %Password%</p>",
            'stMensagemSenha' => "Sim",
            'dsMensagemSenha' => "<p>%NameSystem% -&nbsp;%DescriptionSystem%</p><p>Ol&aacute; %Name%</p><p>Voc&ecirc; solicitou a troca da sua senha de acesso, seguem as novas credencias de acesso</p><p>Link: %Link%</p><p>Email: %User%</p><p>Password: %Password%</p>",
            'stMensagemContemplacao' => "Sim",
            'dsMensagemContemplacao' => "<p>%NameSystem% - %DescriptionSystem%</p><p>Parab&eacute;ns %Name%</p><p>Na data de %DataContemplacao% voc&ecirc; foi contemplado na cons&oacute;rcio %Grupo% Banco %Banco%</p><p>Para resgatar o premio voc&ecirc; deve ...</p>",
            'asaas_client' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwMzU1Mjc6OiRhYWNoX2E4YWE2MmVlLTBiYzItNGI1My04N2UzLTY0ODBiZWY1ZGVmYQ==',
            'asaas_method' => "sandbox",
        ]);
    }
}
