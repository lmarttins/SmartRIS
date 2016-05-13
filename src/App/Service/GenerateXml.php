<?php

namespace App\Service;

use \DOMDocument;

class GenerateXml
{
    private $data;

    public function save($idLot)
    {
        $doc = new DOMDocument('1.0', 'ISO-8859-1');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $namespace = 'http://www.ans.gov.br/padroes/tiss/schemas';
        $now = new \DateTime();

        $root = $doc->createElementNS($namespace, 'ans:mensagemTISS');

        $doc->appendChild($root);

        $root->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $root->setAttributeNS($namespace, 'xsi:schemaLocation', 'http://www.ans.gov.br/padroes/tiss/schemas/tissV3_01_00.xsd');

        #header
        $header = $doc->createElementNS($namespace, 'ans:cabecalho');

        #transaction id
        $transactionId = $doc->createElementNS($namespace, 'ans:identificacaoTransacao');
        $header->appendChild($transactionId);
        $typeTransaction = $doc->createElementNS($namespace, 'ans:tipoTransacao', 'ENVIO_LOTE_GUIAS');
        $transactionId->appendChild($typeTransaction);
        $sequentialTransaction = $doc->createElementNS($namespace, 'ans:sequencialTransacao', mt_rand());
        $transactionId->appendChild($sequentialTransaction);
        $dateRegisterTransaction = $doc->createElementNS($namespace, 'ans:dataRegistroTransacao', $now->format('Y-m-d'));
        $transactionId->appendChild($dateRegisterTransaction);
        $timeTransactionRecord = $doc->createElementNS($namespace, 'ans:horaRegistroTransacao', $now->format('H:i:s'));
        $transactionId->appendChild($timeTransactionRecord);

        # origin
        $origin = $doc->createElementNS($namespace, 'ans:origem');
        $header->appendChild($origin);
        $providerId = $doc->createElementNS($namespace, 'ans:identificacaoPrestador');
        $providerCodeOperator = $doc->createElementNS($namespace, 'ans:codigoPrestadorNaOperadora', 99999999999999);
        $providerId->appendChild($providerCodeOperator);
        $origin->appendChild($providerId);

        # destination
        $destination = $doc->createElementNS($namespace, 'ans:destino');
        $header->appendChild($destination);
        $registerAns = $doc->createElementNS($namespace, 'ans:registroANS', 999211);
        $destination->appendChild($registerAns);

        # version default
        $versionDefault = $doc->createElementNS($namespace, 'ans:versaoPadrao', '3.02.00');
        $header->appendChild($versionDefault);

        # provider operator
        $providerOperator = $doc->createElementNS($namespace, 'ans:prestadorParaOperadora');

        # allotment guides
        $allotmentGuides = $doc->createElementNS($namespace, 'ans:loteGuias');
        $providerOperator->appendChild($allotmentGuides);
        $numberAllotment = $doc->createElementNS($namespace, 'ans:numeroLote', $idLot['id']);
        $allotmentGuides->appendChild($numberAllotment);

        # guides TISS
        $guidesTISS = $doc->createElementNS($namespace, 'ans:guiasTISS');
        $allotmentGuides->appendChild($guidesTISS);

        foreach ($this->getData() as $key => $value) {

            $guideSADT = $doc->createElementNS($namespace, 'ans:guiaSP-SADT');
            $guidesTISS->appendChild($guideSADT);

            $headerGuide = $doc->createElementNS($namespace, 'ans:cabecalhoGuia');
            $guideSADT->appendChild($headerGuide);

            $registerANS = $doc->createElementNS($namespace, 'ans:registroANS', $value['register_ans']);
            $headerGuide->appendChild($registerAns);

            $numberGuideProvider = $doc->createElementNS($namespace, 'ans:numeroGuiaPrestador', $value['number_guide_provider']);
            $headerGuide->appendChild($numberGuideProvider);

            $mainGuide = $doc->createElementNS($namespace, 'ans:guiaPrincipal', 12345678);
            $headerGuide->appendChild($mainGuide);

            $dataAuthorization = $doc->createElementNS($namespace, 'ans:dadosAutorizacao');
            $guideSADT->appendChild($dataAuthorization);

            $numberGuideOperator = $doc->createElementNS($namespace, 'ans:numeroGuiaOperadora', 12345678);
            $dataAuthorization->appendChild($numberGuideOperator);

            $dateAuthorization = $doc->createElementNS($namespace, 'ans:dataAutorizacao', $now->format('Y-m-d'));
            $dataAuthorization->appendChild($dateAuthorization);

            $password = $doc->createElementNS($namespace, 'ans:senha', 12345678);
            $dataAuthorization->appendChild($password);

            $dateValidatePassword = $doc->createElementNS($namespace, 'ans:dataValidadeSenha', $now->format('Y-m-d'));
            $dataAuthorization->appendChild($dateValidatePassword);

            $beneficiaryData = $doc->createElementNS($namespace, 'ans:dadosBeneficiario');
            $guideSADT->appendChild($beneficiaryData);

            $cardNumber = $doc->createElementNS($namespace, 'ans:numeroCarteira', $value['id_card_number']);
            $beneficiaryData->appendChild($cardNumber);

            $careRN = $doc->createElementNS($namespace, 'ans:atendimentoRN', 'N');
            $beneficiaryData->appendChild($careRN);

            $beneficiaryName = $doc->createElementNS($namespace, 'ans:nomeBeneficiario', $value['name_patient']);
            $beneficiaryData->appendChild($beneficiaryName);

            $cnsNumber = $doc->createElementNS($namespace, 'ans:numeroCNS', 12345678);
            $beneficiaryData->appendChild($cnsNumber);

            $beneficiaryId = $doc->createElementNS($namespace, 'ans:identificadorBeneficiario', 12345678);
            $beneficiaryData->appendChild($beneficiaryId);

            $applicantData = $doc->createElementNS($namespace, 'ans:dadosSolicitante');
            $guideSADT->appendChild($applicantData);

            $hiredRequester = $doc->createElementNS($namespace, 'ans:contratadoSolicitante');
            $applicantData->appendChild($hiredRequester);

            $codeProviderOperator = $doc->createElementNS($namespace, 'ans:codigoPrestadorNaOperadora', $value['code_operator']);
            $hiredRequester->appendChild($codeProviderOperator);

            $hiredName = $doc->createElementNS($namespace, 'ans:nomeContratado', $value['name']);
            $hiredRequester->appendChild($hiredName);

            $professionalRequestor = $doc->createElementNS($namespace, 'ans:profissionalSolicitante');
            $applicantData->appendChild($professionalRequestor);

            $professionalName = $doc->createElementNS($namespace, 'ans:nomeProfissional', 'XXXXXXX LLLLLLLLLL');
            $professionalRequestor->appendChild($professionalName);

            $professionalAdvice = $doc->createElementNS($namespace, 'ans:conselhoProfissional', 6);
            $professionalRequestor->appendChild($professionalAdvice);

            $numberProfessionalAdvice = $doc->createElementNS($namespace, 'ans:numeroConselhoProfissional', 99888);
            $professionalRequestor->appendChild($numberProfessionalAdvice);

            $uf = $doc->createElementNS($namespace, 'ans:UF', 53);
            $professionalRequestor->appendChild($uf);

            $cbo = $doc->createElementNS($namespace, 'ans:CBOS', 225148);
            $professionalRequestor->appendChild($cbo);

            $solicitationData = $doc->createElementNS($namespace, 'ans:dadosSolicitacao');
            $guideSADT->appendChild($solicitationData);

            $dateSolicitation = $doc->createElementNS($namespace, 'ans:dataSolicitacao', $now->format('Y-m-d'));
            $solicitationData->appendChild($dateSolicitation);

            $characterService = $doc->createElementNS($namespace, 'ans:caraterAtendimento', 1);
            $solicitationData->appendChild($characterService);

            $indicationClinica = $doc->createElementNS($namespace, 'ans:indicacaoClinica', 1);
            $solicitationData->appendChild($indicationClinica);

            $dataExecutor = $doc->createElementNS($namespace, 'ans:dadosExecutante');
            $guideSADT->appendChild($dataExecutor);

            $hiredPerformer = $doc->createElementNS($namespace, 'ans:contratadoExecutante');
            $dataExecutor->appendChild($hiredPerformer);

            $hiredCnpj = $doc->createElementNS($namespace, 'ans:cnpjContratado', '58846533000179');
            $hiredPerformer->appendChild($hiredCnpj);

            $nameExecutor = $doc->createElementNS($namespace, 'ans:nomeContratado', 'XXXXXXXXXXXX XXXXXXXXXXX');
            $hiredPerformer->appendChild($nameExecutor);

            $cnes = $doc->createElementNS($namespace, 'ans:CNES', 1123323);
            $dataExecutor->appendChild($cnes);

            $dataService = $doc->createElementNS($namespace, 'ans:dadosAtendimento');
            $guideSADT->appendChild($dataService);

            $typeService = $doc->createElementNS($namespace, 'ans:tipoAtendimento', 01);
            $dataService->appendChild($typeService);

            $indicationAccident = $doc->createElementNS($namespace, 'ans:indicacaoAcidente', 2);
            $dataService->appendChild($indicationAccident);

            $typeQuery = $doc->createElementNS($namespace, 'ans:tipoConsulta', 1);
            $dataService->appendChild($typeQuery);

            $closureReason = $doc->createElementNS($namespace, 'ans:motivoEncerramento', 41);
            $dataService->appendChild($closureReason);

            # Procedimentos
            $root->appendChild($header);
            $root->appendChild($providerOperator);
        }

        $dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;

        if (is_dir($dir)) {
            return $doc->save($dir . 'file' . $now->format('YmdHis') . '.xml');
        }

        return false;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
}