<?php


namespace App\Command;


use App\Entity\Presentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\Console\Input\InputOption;

class AddPresentationFixturesCommand extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:presentation:fixtures';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Bms add presentation fixtures');
        $this
            // ...
            ->addOption(
                'truncate',
                null,
                InputOption::VALUE_OPTIONAL,
                'truncate table',
                null
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->lock()) {
            $io->warning('The command is already running in another process.');

            return Command::SUCCESS;
        }

        // clean data
        $truncateOption = $input->getOption('truncate');
        if ($truncateOption) {
            $io->note('truncate presentation tables');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=0');
            $this->em->getConnection()->executeQuery('truncate presentation');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        }

        $io->note('Starting Update  slug  update ...');
        $datas = $this->getPresentationDatas();
        foreach ($datas as $data) {
            $presentation = new Presentation();
            //  dd($data);
            $summary = substr($data['summary'], 0, 99);
            $presentation->setTitle($data['title'])
                    ->setSecondTitle($data['title'])
                    ->setContent($data['content'])//    ->setElements()
                    ->setSummary($summary)//
            ;
            $this->em->persist($presentation);
            $this->em->flush();
        }
        $io->note(' slug  updated');
        $this->release();
        return Command::SUCCESS;
    }

    public function getPresentationDatas()
    {
        return [
            [
                'title' => sprintf('%s', 'BAFING MULTI SERVICES'),
                'summary' => sprintf("%s", "BAFING MUTI SERVICES est une entreprise de droit guinéen créée en juin 2016 immatriculée au Registre du Commerce et du Crédit Mobilier de Conakry sous le numéro RCCM/GC-KAL/066692B/2016 œuvrant dans le domaine des technologies de l'information et de la&nbsp;.."),
                'content' => sprintf(
                    '%s',
                    "BAFING MUTI SERVICES est une entreprise de droit guinéen créée en juin 2016 immatriculée au Registre du Commerce et du Crédit Mobilier de Conakry sous le numéro RCCM/GC-KAL/066692B/2016 œuvrant dans le domaine des technologies de l'information et de la communication (TIC), du business développement, de la formation, et du management d’entreprise. Elle propose aux entreprises et aux organismes des secteurs privés et publics des services de conseil, en ingénierie de processus d’affaires, en développement web et logiciel, en intégration et optimisation de systèmes informatiques, en business développement, en management des organisations, en conduite du changement, en formation qui permettent à ses clients d’augmenter leur productivité et leur compétitivité et de réaliser des résultats mesurables. 

L’informatique a toujours été une passion pour nous, avant d’être notre métier, c’est pour cette raison que nous nous appliquons chaque jour à faire que nos services informatiques soient de qualité, et à fournir à nos clients les solutions informatiques les plus innovantes et les mieux adaptées à leurs besoins. 

Nous proposons à nos clients un service informatique de proximité qui rime avec compétence et sérieux en fonction de leurs besoins réels. 

Notre but est d’offrir à nos clients une large gamme de prestations informatiques et en management, pour pouvoir prendre en compte toutes leurs demandes dans les meilleurs délais. Nos interventions sont diverses et variées et concernent : 

  Le développement d’applications spécifiques basées sur les dernières technologies Java & J2EE ou encore .Net ; 
 La mise en place d’infrastructures logicielles (bases de données, serveurs d’applications, SOA, Gouvernance des données, Sécurité des SI...) ; 
  La modernisation de Systèmes d’Information ; 
 L’élaboration de Schéma Directeur Informatique ; 
L’intégration de progiciels de gestion avec Oracle E-Business Suite, JDEdwards, Sage, SAP ou encore Navision ; 
  Le support de haute qualité avec un helpdesk aux normes et une équipe consulting particulièrement expérimentée ; 
La Business Intelligence (BI) et la Gestion de la Relation Client (CRM) ; 
La Gestion Electronique de Documents ; 
La Formation du capital humain. 
BMS 

Technologies et Solutions en Systèmes d’Information et Management d’Entreprise
technologies d'information et de communication 
cabinet d'études 
stratégie d'entreprise 
conseil et management 
formation 
BAFING MULTI SERVICES 


"
                )
            ],
            [
                'title' => sprintf('%s', ' VISION, MISSION ET VALEURS'),
                'summary' => sprintf("%s", "La vision, la mission et les valeurs de Bafing Multi Services (BMS) s’articulent de manière à conduire à l’excellence dans toutes nos activités de diagnostic, de planification, de conception, de création, d’implémentation et de maintien de systèmes efficaces, interactifs et dynamiques dans le but de pouvoir répondre aux besoins exprimés par nos clients.&nbsp;"),
                'content' => sprintf(
                    '%s',
                    "La vision, la mission et les valeurs de Bafing Multi Services (BMS) s’articulent de manière à conduire à l’excellence dans toutes nos activités de diagnostic, de planification, de conception, de création, d’implémentation et de maintien de systèmes efficaces, interactifs et dynamiques dans le but de pouvoir répondre aux besoins exprimés par nos clients. 

BMS intègre les dernières technologies informatiques, télécoms et multimédia et développe des innovantes pour un accès aux nombreuses potentialités du Web, du mobile et des technologies interactives pour les administrations publiques, banques, les entreprises et les médias. 

La réussite de notre entreprise repose sur notre capacité d’innovation, la satisfaction de nos clients, la performance et la qualité de nos solutions. 
 
Notre stratégie est de : 
Fournir des solutions opérationnelles qui répondent aux problématiques posées, anticipent les évolutions futures et ce avec des niveaux de technicité, de fiabilité et de réactivité les plus élevés possibles ;
 Travailler de manière étroite avec nos clients et rester en permanence à l’écoute de leurs besoins ; 
Anticiper les attentes du client pour garantir un maximum de satisfaction et de revenus des services qu’elle offre ; 
 Être un partenaire de référence pour chaque client. BMS tient à rester à la pointe du progrès technologique et à avoir une vision à long terme. Nous sommes en effet convaincus, que c’est en adoptant une telle attitude que nous pouvons satisfaire pleinement nos clients en cherchant des idées et des solutions nouvelles et concrètes dans un secteur où l’innovation s’impose. 
VISION 
Être Leader du Conseil, de l’Ingénierie, des Technologies et Solutions Numériques en Guinée et en Afrique.
MISSION
• Mettre à la disposition de nos clients les technologies et solutions innovantes visant à accroître leurs performances et les accompagner par le conseil, la formation dans la réalisation de leurs projets informatiques.
 VALEURS 
• Innovation & Créativité – Engagement – Réactivité – Performance. 
 "
                )
            ],

            [
                'title' => sprintf('%s', 'POURQUOI NOUS CHOISIR ?'),
                'summary' => sprintf("%s", ""),
                'content' => sprintf(
                    '%s',
                    "POURQUOI NOUS CHOISIR ? 

Depuis sa création, BMS s’est distingué sur le marché auprès de ses clients par sa compétitivité, sa capacité à offrir des solutions sur mesures, sa réactivité et la relation privilégiée qu’elle construit avec ses clients et partenaires. 

Les systèmes d’information se complexifiant et gérant de plus en plus de flux de données, leur agilité et leur performance sont les garantes de leur efficacité. Les équipes de BMS propose des solutions infrastructurelles dont des services avancés reconnus par les éditeurs et constructeurs majeurs tels que Computer Associates, IBM, Informatica, Microsoft et Oracle. Notre société dispose d’une offre couvrant toutes les couches des systèmes d’information, s’enrichissant continuellement grâce à des partenariats avec les meilleurs acteurs internationaux (Oracle, IBM, Informatica, Dell Software...). 
Une relation privilégiée.
Vous bénéficiez d'un vrai service de proximité quelque soit la taille de votre entreprise.
Des solutions sur mesure.
Optimisez vos investissements grace à des solutions sur mesure adaptés à vos réels besoin.
Réactivité.
Nous traitons vos demandes dans des meilleurs délais afin d'assurer votre performance et garantir votre disponibilité.
Des offres compétitives.
En phase avec l'offre du marché nous vous apportons de la valeur ajoutée à des prix compétitive.
"
                )
            ],

            [
                'title' => sprintf('%s', 'NOTRE DEMARCHE PROJET'),
                'summary' => sprintf("%s", "Audit Initial et Etude de votre projet : un spécialiste effectue un audit complet de votre parc et un chef de projet analyse vos besoins et rédige le cahier de charges. Cette étape permet de cadrer, démarrer le projet et définir son pilotage.&nbsp;</div>"),
                'content' => sprintf(
                    '%s',
                    "La démarche projet de BMS est articulée autour des quatre étapes ci-dessous : 

1. Audit Initial et Etude de votre projet : un spécialiste effectue un audit complet de votre parc et un chef de projet analyse vos besoins et rédige le cahier de charges. Cette étape permet de cadrer, démarrer le projet et définir son pilotage. 

2. Une offre sur mesure adaptée à vos besoins : nous vous proposons une solution matérielle et logicielle la mieux adaptée à des tarifs défiants toute concurrence. Elle découle d’une analyse critique de l’existant et d’un benchmarking afin d’obtenir une vue fidèle de l’existant, d’analyser les risques et les faiblesses, de faire un état de l’art des bonnes pratiques, et recueillir les meilleures techniques matérielles et logicielles. 

3. Installation et Intégration de la solution : Nous assurons l’ensemble de la démarche d’installation : livraison des matériels, installation, configuration, formation des utilisateurs. Au cours de cette phase nous tenons compte des besoins futures, définition les axes stratégiques d’évolution et les différentes options d’intégration. 

4. Maintenance et Assistance au quotidien : Un service d’assistance technique accompagne le client au quotidien. 

Audit Initial besoins et Etude de votre projet.
Offre sur mesure adaptée à vos besoins.
Installation et Intégration de la solution. 
Maintenance et Assistance au quotidien. "
                )
            ],
            [
                'title' => sprintf('%s', 'PLAN D’ASSURANCE QUALITE'),
                'summary' => sprintf("%s", "<div>Dans la conduite de nos projets et de toutes nos interventions auprès des clients, nous mettons un plan d’assurance qualité permettant d’évaluer les risques et leurs impacts et définir les approches de mitigation. Cette approche permet de corriger très rapidement les éventuels décalages et délivrer les résultats dans le respect des délais et des ressources.&nbsp;</div>"),
                'content' => sprintf(
                    '%s',
                 "PLAN D’ASSURANCE QUALITE 
Dans la conduite de nos projets et de toutes nos interventions auprès des clients, nous mettons un plan d’assurance qualité permettant d’évaluer les risques et leurs impacts et définir les approches de mitigation. Cette approche permet de corriger très rapidement les éventuels décalages et délivrer les résultats dans le respect des délais et des ressources.

 COMITE DE PILOTAGE
Niveau Décisionnel (Directeur de Projet, PMO, et Equipes) 
 Suivi du Planning et du Budget 
 Contrôle du Respect des Objectifs 
 Allocation des Ressources Nécessaires 
 Contrôle et Validation des Jalons d’Avancement 
Arbitrage lié aux Décisions Stratégiques 
Niveau Opérationnel (Chefs de Projet + Invités) 

 COMITE DE PROJET
Niveau Opérationnel (Chefs de Projet + Invités) 
 Maîtrise, Réactualisation et Diffusion du Planning
Suivi du plan d’actions de la période écoulée et à venir
Point Technique régulier et analyse des anomalies
Revues de Qualité
Suivi des Livraisons Prévues et Réalisées
Validation des Livrables "
                )
            ],
        ];
    }
}