# language: pt

Funcionalidade: Cadastro de formações
    Eu, como instrutor
    Quero cadastrar formações
    Para organizar meus cursos

    Regras:
    - Formação precisa ter uma descrição
    - Descrição precisa ter pelo menos 2 palavras

    Cenário: Cadastro de formação com uma palavra
        Quando eu tentar criarum formação com apenas uma palavra 
        Então eu vou ver a seguinte mensagem de erro "Descrição precisa ter pelo menos 2 palavras"

    Cenário: Cadastro de formação válida deve salvar no banco 
        Dado que estou conectado ao banco de dados
        Quando tento criar uma nova formação válida
        Então se eu buscar no banco, devo encontrar essa formação

    