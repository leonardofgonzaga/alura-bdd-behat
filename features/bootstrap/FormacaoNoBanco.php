<?php

use Doctrine\ORM\EntityManager;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Gherkin\Node\PyStringNode;
use Alura\Armazenamento\Entity\Curso;
use Alura\Armazenamento\Entity\Formacao;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Behat\Behat\Tester\Exception\PendingException;
use Alura\Armazenamento\Infra\EntitymanagerCreator;

/**
 * Defines application features from the specific context.
 */
class FormacaoNoBanco implements Context
{
    private EntityManagerInterface $em;
    private int $idFormacaoInserida;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }    

    /**
     * @Given que estou conectado ao banco de dados
     */
    public function queEstouConectadoAoBancoDeDados()
    {
        $this->em = (new EntitymanagerCreator())->getEntityManager();
    }

    /**
     * @When tento salvar uma nova formação com a descrição :descricaoFormacao
     */
    public function tentoSalvarUmaNovaFormacaoComADescricao(string $descricaoFormacao)
    {
        $formacao = new Formacao();
        $formacao->setDescricao($descricaoFormacao);

        $this->em->persist($formacao);
        $this->em->flush();

        $this->idFormacaoInserida = $formacao->getId();
    }

    /**
     * @Then se eu buscar no banco, devo encontar essa formação
     */
    public function seEuBuscarNoBancoDevoEncontarEssaFormacao()
    {
        /** @var ObjectRepository $repositorio */
        $repositorio = $this->em->getRepository(Formacao::class);
        
        /** @var Formacao $formacao */
        $formacao = $repositorio->find($this->idFormacaoInserida);

        assert($formacao instanceof Formacao);
    }
}
