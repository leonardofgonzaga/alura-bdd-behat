<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Alura\Armazenamento\Entity\Formacao;

class FormacaoEmMemoria implements Context
{
    private string $mensagemErro;
    private Formacao $formacao;

    /**
     * @When eu tentar criar uma formação com a descrição :arg1
     */
    public function euTentarCriarUmaFormacaoComADescricao(string $descricaoFormacao)
    {
        $this->formacao = new Formacao();

        try {
            $this->formacao->setDescricao($descricaoFormacao);
        } catch (\InvalidArgumentException $exception) {
            $this->mensagemErro = $exception->getMessage();
        }
    }

    /**
     * @Then eu vou ver a seguinte mensagem de erro :arg1
     */
    public function euVouVerASeguinteMensagemDeErro($mensagemErro)
    {
        assert($mensagemErro === $this->mensagemErro);
    }

    /**
     * @Then eu devo ter uma formação criada com a descrição :arg1
     */
    public function euDevoTerUmaFormacaoCriadaComADescricao($arg1)
    {
        assert($this->formacao->getDescricao() === $arg1);
    }
}
