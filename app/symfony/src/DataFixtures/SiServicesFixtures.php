<?php


namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SiServicesFixtures extends Fixture implements FixtureGroupInterface
{
    // bin/console   doctrine:fixtures:load --append --group=services

    public static function getGroups(): array
    {
        return ['services'];
    }

    public function load(ObjectManager $manager)
    {
        $datas = $this->getDatas();
        foreach ($datas as $data) {
            $service = new Services();
            //  dd($data);
            $service->setTitle($data['title'])
                ->setSecondTitle($data['title'])
                ->setContent($data['content'])//    ->setElements()
                ->setSummary($data['summary'])//
            ;
            $manager->persist($service);
            $manager->flush();
        }
    }

    public function getDatas()
    {
        return [
            [
                'title' => sprintf('%s', 'I.1.BAFING MULTI SERVICES'),
                'summary' => sprintf("%s", "<div>BAFING MUTI SERVICES est une entreprise de droit guinéen créée en juin 2016 immatriculée au Registre du Commerce et du Crédit Mobilier de Conakry sous le numéro RCCM/GC-KAL/066692B/2016 œuvrant dans le domaine des technologies de l'information et de la&nbsp;</div>.."),
                'content' => sprintf(
                    '%s',
                    "<div><strong>QUI SOMMES-NOUS ? </strong><br><br></div><div><strong>I.1. BAFING MULTI SERVICES </strong><br><br></div><div>BAFING MUTI SERVICES est une entreprise de droit guinéen créée en juin 2016 immatriculée au Registre du Commerce et du Crédit Mobilier de Conakry sous le numéro RCCM/GC-KAL/066692B/2016 œuvrant dans le domaine des technologies de l'information et de la communication (TIC), du business développement, de la formation, et du management d’entreprise. Elle propose aux entreprises et aux organismes des secteurs privés et publics des services de conseil, en ingénierie de processus d’affaires, en développement web et logiciel, en intégration et optimisation de systèmes informatiques, en business développement, en management des organisations, en conduite du changement, en formation qui permettent à ses clients d’augmenter leur productivité et leur compétitivité et de réaliser des résultats mesurables.&nbsp;<br><br>L’informatique a toujours été une passion pour nous, avant d’être notre métier, c’est pour cette raison que nous nous appliquons chaque jour à faire que nos services informatiques soient de qualité, et à fournir à nos clients les solutions informatiques les plus innovantes et les mieux adaptées à leurs besoins.&nbsp;<br><br></div><div>Nous proposons à nos clients un service informatique de proximité qui rime avec compétence et sérieux en fonction de leurs besoins réels.&nbsp;<br><br></div><div>Notre but est d’offrir à nos clients une large gamme de prestations informatiques et en management, pour pouvoir prendre en compte toutes leurs demandes dans les meilleurs délais. Nos interventions sont diverses et variées et concernent :&nbsp;<br><br></div><ul><li>&nbsp; Le développement d’applications spécifiques basées sur les dernières technologies Java &amp; J2EE ou encore .Net ;&nbsp;</li><li>&nbsp;La mise en place d’infrastructures logicielles (bases de données, serveurs d’applications, SOA, Gouvernance des données, Sécurité des SI...) ;&nbsp;</li><li>&nbsp; La modernisation de Systèmes d’Information ;&nbsp;</li><li>&nbsp;L’élaboration de Schéma Directeur Informatique ;&nbsp;</li><li>L’intégration de progiciels de gestion avec Oracle E-Business Suite, JDEdwards, Sage, SAP ou encore Navision ;&nbsp;</li><li>&nbsp; Le support de haute qualité avec un helpdesk aux normes et une équipe consulting particulièrement expérimentée ;&nbsp;</li><li>La Business Intelligence (BI) et la Gestion de la Relation Client (CRM) ;&nbsp;</li><li>La Gestion Electronique de Documents ;&nbsp;</li><li>La Formation du capital humain.&nbsp;</li></ul><div>BMS&nbsp;<br><br></div><h1>Technologies et Solutions en Systèmes d’Information et Management d’Entreprise</h1><div>technologies d'information et de communication&nbsp;</div><ul><li>cabinet d'études&nbsp;</li><li>stratégie d'entreprise&nbsp;</li><li>conseil et management&nbsp;</li><li>formation&nbsp;</li><li>BAFING MULTI SERVICES&nbsp;</li></ul><div><br>&nbsp;</div><div><br></div><div><br></div><div><br><br></div>"
                )
            ],
            [
                'title' => sprintf('%s', ' I.2. VISION, MISSION ET VALEURS'),
                'summary' => sprintf("%s", "<div>La vision, la mission et les valeurs de Bafing Multi Services (BMS) s’articulent de manière à conduire à l’excellence dans toutes nos activités de diagnostic, de planification, de conception, de création, d’implémentation et de maintien de systèmes efficaces, interactifs et dynamiques dans le but de pouvoir répondre aux besoins exprimés par nos clients.&nbsp;</div>"),
                'content' => sprintf(
                    '%s',
                    "<div>La vision, la mission et les valeurs de Bafing Multi Services (BMS) s&rsquo;articulent de manière à conduire à l&rsquo;excellence dans toutes nos activités de diagnostic, de planification, de conception, de création, d&rsquo;implémentation et de maintien de systèmes efficaces, interactifs et dynamiques dans le but de pouvoir répondre aux besoins exprimés par nos clients.&nbsp;<br /> <br /> BMS intègre les dernières technologies informatiques, télécoms et multimédia et développe des innovantes pour un accès aux nombreuses potentialités du Web, du mobile et des technologies interactives pour les administrations publiques, banques, les entreprises et les médias.&nbsp;<br /> <br /> La réussite de notre entreprise repose sur notre capacité d&rsquo;innovation, la satisfaction de nos clients, la performance et la qualité de nos solutions.&nbsp;<br /> &nbsp;</div> <div>Notre stratégie est de :&nbsp;</div> <ul> <li>Fournir des solutions opérationnelles qui répondent aux problématiques posées, anticipent les évolutions futures et ce avec des niveaux de technicité, de fiabilité et de réactivité les plus élevés possibles ;</li> <li>&nbsp;Travailler de manière étroite avec nos clients et rester en permanence à l&rsquo;écoute de leurs besoins ;&nbsp;</li> <li>Anticiper les attentes du client pour garantir un maximum de satisfaction et de revenus des services qu&rsquo;elle offre ;&nbsp;</li> <li>&nbsp;Être un partenaire de référence pour chaque client. BMS tient à rester à la pointe du progrès technologique et à avoir une vision à long terme. Nous sommes en effet convaincus, que c&rsquo;est en adoptant une telle attitude que nous pouvons satisfaire pleinement nos clients en cherchant des idées et des solutions nouvelles et concrètes dans un secteur où l&rsquo;innovation s&rsquo;impose.&nbsp;</li> </ul> <div><strong>VISION</strong>&nbsp;</div> <div>Être Leader du Conseil, de l&rsquo;Ingénierie, des Technologies et Solutions Numériques en Guinée et en Afrique.<br /> <strong>MISSION</strong><br /> &bull; Mettre à la disposition de nos clients les technologies et solutions innovantes visant à accroître leurs performances et les accompagner par le conseil, la formation dans la réalisation de leurs projets informatiques.<br /> &nbsp;<strong>VALEURS</strong>&nbsp;<br /> &bull; Innovation &amp; Créativité &ndash; Engagement &ndash; Réactivité &ndash; Performance.&nbsp;<br /> &nbsp;</div>"
                )
            ],

            [
                'title' => sprintf('%s', 'I.3. POURQUOI NOUS CHOISIR ?'),
                'summary' => sprintf("%s", ""),
                'content' => sprintf(
                    '%s',
                    "<div>I.3. POURQUOI NOUS CHOISIR ?&nbsp;<br><br></div><div>Depuis sa création, BMS s’est distingué sur le marché auprès de ses clients par sa compétitivité, sa capacité à offrir des solutions sur mesures, sa réactivité et la relation privilégiée qu’elle construit avec ses clients et partenaires.&nbsp;<br><br></div><div>Les systèmes d’information se complexifiant et gérant de plus en plus de flux de données, leur agilité et leur performance sont les garantes de leur efficacité. Les équipes de BMS propose des solutions infrastructurelles dont des services avancés reconnus par les éditeurs et constructeurs majeurs tels que Computer Associates, IBM, Informatica, Microsoft et Oracle. Notre société dispose d’une offre couvrant toutes les couches des systèmes d’information, s’enrichissant continuellement grâce à des partenariats avec les meilleurs acteurs internationaux (Oracle, IBM, Informatica, Dell Software...).&nbsp;</div><ol><li>Une relation privilégiée.</li></ol><div>Vous bénéficiez d'un vrai service de proximité quelque soit la taille de votre entreprise.</div><ol><li>Des solutions sur mesure.</li></ol><div>Optimisez vos investissements grace à des solutions sur mesure adaptés à vos réels besoin.</div><ol><li>Réactivité.</li></ol><div>Nous traitons vos demandes dans des meilleurs délais afin d'assurer votre performance et garantir votre disponibilité.</div><ol><li>Des offres compétitives.</li></ol><div>En phase avec l'offre du marché nous vous apportons de la valeur ajoutée à des prix compétitive.</div><div><br></div>"
                )
            ],

            [
                'title' => sprintf('%s', 'I.4. NOTRE DEMARCHE PROJET'),
                'summary' => sprintf("%s", "<div>. Audit Initial et Etude de votre projet : un spécialiste effectue un audit complet de votre parc et un chef de projet analyse vos besoins et rédige le cahier de charges. Cette étape permet de cadrer, démarrer le projet et définir son pilotage.&nbsp;</div>"),
                'content' => sprintf(
                    '%s',
                    "<div>La démarche projet de BMS est articulée autour des quatre étapes ci-dessous :&nbsp;<br><br></div><div>1. Audit Initial et Etude de votre projet : un spécialiste effectue un audit complet de votre parc et un chef de projet analyse vos besoins et rédige le cahier de charges. Cette étape permet de cadrer, démarrer le projet et définir son pilotage.&nbsp;<br><br></div><div>2. Une offre sur mesure adaptée à vos besoins : nous vous proposons une solution matérielle et logicielle la mieux adaptée à des tarifs défiants toute concurrence. Elle découle d’une analyse critique de l’existant et d’un benchmarking afin d’obtenir une vue fidèle de l’existant, d’analyser les risques et les faiblesses, de faire un état de l’art des bonnes pratiques, et recueillir les meilleures techniques matérielles et logicielles.&nbsp;<br><br>3. Installation et Intégration de la solution : Nous assurons l’ensemble de la démarche d’installation : livraison des matériels, installation, configuration, formation des utilisateurs. Au cours de cette phase nous tenons compte des besoins futures, définition les axes stratégiques d’évolution et les différentes options d’intégration.&nbsp;<br><br></div><div>4. Maintenance et Assistance au quotidien : Un service d’assistance technique accompagne le client au quotidien.&nbsp;<br><br></div><ul><li>Audit Initial besoins et Etude de votre projet.</li><li>Offre sur mesure adaptée à vos besoins.</li><li>Installation et Intégration de la solution.&nbsp;</li><li>Maintenance et Assistance au quotidien.&nbsp;</li></ul><div><br></div><div><br><br><br><br><br></div> "
                )
            ],
            [
                'title' => sprintf('%s', 'I.5. PLAN D’ASSURANCE QUALITE'),
                'summary' => sprintf("%s", "<div>Dans la conduite de nos projets et de toutes nos interventions auprès des clients, nous mettons un plan d’assurance qualité permettant d’évaluer les risques et leurs impacts et définir les approches de mitigation. Cette approche permet de corriger très rapidement les éventuels décalages et délivrer les résultats dans le respect des délais et des ressources.&nbsp;</div>"),
                'content' => sprintf(
                    '%s',
                    "<div>I.5. PLAN D’ASSURANCE QUALITE&nbsp;<br><br></div><div>Dans la conduite de nos projets et de toutes nos interventions auprès des clients, nous mettons un plan d’assurance qualité permettant d’évaluer les risques et leurs impacts et définir les approches de mitigation. Cette approche permet de corriger très rapidement les éventuels décalages et délivrer les résultats dans le respect des délais et des ressources. <br><br>&nbsp;COMITE DE PILOTAGE<br><strong>Niveau Décisionnel (Directeur de Projet, PMO, et Equipes)&nbsp;</strong></div><ul><li>&nbsp;Suivi du Planning et du Budget&nbsp;</li><li>&nbsp;Contrôle du Respect des Objectifs&nbsp;</li><li>&nbsp;Allocation des Ressources Nécessaires&nbsp;</li><li>&nbsp;Contrôle et Validation des Jalons d’Avancement&nbsp;</li><li>Arbitrage lié aux Décisions Stratégiques&nbsp;</li><li>Niveau Opérationnel (Chefs de Projet + Invités)&nbsp;</li></ul><div><br></div><div>&nbsp;COMITE DE PROJET</div><ul><li>Niveau Opérationnel (Chefs de Projet + Invités)&nbsp;</li><li>&nbsp;Maîtrise, Réactualisation et Diffusion du Planning</li><li>Suivi du plan d’actions de la période écoulée et à venir</li><li>Point Technique régulier et analyse des anomalies</li><li>Revues de Qualité</li><li>Suivi des Livraisons Prévues et Réalisées</li><li>Validation des Livrables&nbsp;</li></ul><div><br></div><div><br><br></div>

"
                )
            ],
        ];
    }
}
