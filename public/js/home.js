const frasesMotivacionais = [
    "O planejamento é a chave para o sucesso financeiro.",
    "Invista em conhecimento, ele paga os melhores juros.",
    "Pequenos gastos somam grandes despesas. Fique atento!",
    "Poupar hoje é garantir um futuro mais tranquilo.",
    "A disciplina é essencial para alcançar suas metas financeiras.",
    "Cada centavo economizado é um passo para a liberdade.",
    "Seu futuro financeiro começa com decisões de hoje.",
    "Não gaste mais do que ganha. Priorize seu orçamento.",
    "Invista em você; esse é o melhor retorno!",
    "A riqueza vem do controle, não do consumo excessivo.",
    "Sonhe grande, mas mantenha os pés no chão financeiro.",
    "O medo de investir é maior que o risco.",
    "Aprenda a administrar bem seu dinheiro, sempre!",
    "Riqueza não é só dinheiro, é liberdade e escolhas.",
    "Construa um patrimônio sólido, um passo de cada vez.",
    "A gratidão transforma o que temos em suficiente.",
    "Investir é plantar hoje para colher amanhã.",
    "Despesas controladas são passos rumo à liberdade financeira.",
    "O sucesso financeiro começa com uma mentalidade positiva.",
    "Faça do seu dinheiro um aliado, não um inimigo.",
    "Conquiste seus sonhos, um investimento de cada vez.",
    "Riqueza é uma mentalidade, não apenas números no banco.",
    "Poupar é um ato de amor próprio e responsabilidade.",
    "O valor do dinheiro está na sua capacidade de escolha.",
    "Viva abaixo de suas possibilidades; a segurança vem primeiro.",
    "Estabeleça metas claras e siga firme na jornada.",
    "Eduque-se financeiramente, essa é sua melhor defesa.",
    "Lembre-se: o verdadeiro investimento é em si mesmo.",
    "O sucesso financeiro requer paciência e perseverança.",
    "Evite comparações; cada um tem sua própria jornada.",
    "Comece onde está, use o que tem, faça o melhor.",
    "Sucesso financeiro é resultado de escolhas inteligentes.",
    "O que você faz hoje impacta seu amanhã financeiro.",
    "Cada investimento deve refletir seus valores e objetivos.",
    "O dinheiro é uma ferramenta; use-o sabiamente.",
    "Desafios financeiros são oportunidades disfarçadas de aprendizado.",
    "O planejamento financeiro é um ato de amor à família.",
    "Evite dívidas desnecessárias; viva dentro de suas possibilidades.",
    "O melhor momento para investir foi ontem; o segundo é hoje.",
    "Transforme suas metas financeiras em um plano de ação.",
    "Consistência é mais importante que grandes investimentos."
];

function editDica(){
    const indiceAleatorio = Math.floor(Math.random() * frasesMotivacionais.length);
    document.querySelector("#dica-home").innerText = frasesMotivacionais[indiceAleatorio];
    
}


