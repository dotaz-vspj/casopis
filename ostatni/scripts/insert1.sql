-- Active: 1728646102576@@127.0.0.1@53306@rsp
ALTER TABLE `RSP_ARTICLE` CHANGE `Title` `Title` VARCHAR(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

--
-- Vypisuji data pro tabulku `RSP_ARTICLE`
--

ALTER TABLE `RSP_EDITION` CHANGE  `Title` `Title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
INSERT INTO `RSP_USER` (`ID`, `FirstName`, `LastName`, `TitleF`, `TitleP`, `Func`, `Phone`, `Mail`, `Login`, `Password`, `Active`) VALUES
(102, 'Hironori', 'Washizaki\r\n', NULL, NULL, 24, NULL, 'Hironori@autor.vspj.cz', NULL, NULL, 2),
(103, 'Nobukazu', 'Yoshioka\r\n', NULL, NULL, 24, NULL, 'Nobukazu@autor.vspj.cz', NULL, NULL, 2),
(104, 'Hiroshi', 'Tanaka\r\n', NULL, NULL, 24, NULL, 'Hiroshi@autor.vspj.cz', NULL, NULL, 2),
(105, 'Masaru', 'Ide', NULL, NULL, 24, NULL, 'Masaru@autor.vspj.cz', NULL, NULL, 2),
(106, 'Jun', 'Yajima', NULL, NULL, 24, NULL, 'Jun@autor.vspj.cz', NULL, NULL, 2),
(107, 'Sachiko', 'Ondera', NULL, NULL, 24, NULL, 'Ondera@autor.vspj.cz', NULL, NULL, 2),
(108, 'Kazuki', 'Munakata', NULL, NULL, 24, NULL, 'Kazuki@autor.vspj.cz', NULL, NULL, 2),
(109, 'Lauren', 'Olson', NULL, NULL, 24, NULL, 'Lauren.Olson@autor.vspj.cz', NULL, NULL, 2),
(110, 'Hwang', 'JaeYoung', NULL, NULL, 24, NULL, 'Hwang@autor.vspj.cz', NULL, NULL, 2),
(111, 'Oh', 'SangHoon', NULL, NULL, 22, NULL, 'SangHoon@autor.vspj.cz', 'SangHong', '21232f297a57a5a743894a0e4a801fc3', 2),
(112, 'Samarth', 'Sikand', NULL, NULL, 22, NULL, 'Samarth.Sikand@autor.vspj.cz', 'SaSik', '21232f297a57a5a743894a0e4a801fc3', 2);

INSERT INTO `RSP_EDITION` (`ID`, `Title`, `Thema`, `Published`, `Redactor`) VALUES
(1, 'Softwarové inženýrství pro umělou inteligenci', 'International Conference on AI Engineering – Software Engineering for AI (CAIN)', '2024-10-30', 102);

INSERT INTO `RSP_ARTICLE` (`ID`, `Edition`, `Title`, `Abstract`, `Status`, `ActiveVersion`) VALUES
(3, 1, 'Bezpečnostní kontinuum umělé inteligence: Koncepce a výzvy\r\n', 'Navrhujeme konceptuální rámec nazvaný „AI Security Continuum“, který se skládá z dimenzí pro trvalé a systematické řešení výzev souvisejících s rozsahem bezpečnostních rizik umělé inteligence v nově vznikajícím kontextu počítačového kontinua a kontinuálního inženýrství. Identifikovanými dimenzemi jsou kontinuum ve výpočetním prostředí AI, kontinuum v technických činnostech pro AI, kontinuum ve vrstvách celkové architektury včetně AI, úroveň automatizace AI a úroveň bezpečnostních opatření AI. Vyhlížíme také inženýrský základ, který může účinně a efektivně zvýšit každou dimenzi.\r\n', 5, NULL),
(4, 1, 'Taxonomie generativních aplikací umělé inteligence pro posuzování rizik\r\n', 'Vynikající funkčnost a všestrannost generativní umělé inteligence vyvolala očekávání ohledně zlepšení lidské společnosti a obavy ohledně etických a sociálních rizik spojených s používáním generativní umělé inteligence. Mnoho předchozích studií představilo otázky rizik jako obavy spojené s používáním generativní UI, ale protože většina těchto obav vychází z pohledu uživatele, je obtížné z nich vyvodit konkrétní protiopatření. V této studii byly rizikové problémy představené v předchozích studiích rozděleny na podrobnější prvky a byly identifikovány rizikové faktory a dopady. Tímto způsobem jsme představili informace, které vedou k návrhům protiopatření pro rizika generativní umělé inteligence. pojmy CCS- obecné a referenční→ hodnocení; průzkumy a přehledy, - výpočetní technika zaměřená na člověka→ teorie, koncepty a modely HCI; - sociální a odborná témata→ výpočetní / technologická politika.\r\n', 5, NULL),
(5, 1, 'Vlastní vývojář GPT pro etická řešení AI\r\n', 'Hlavním cílem tohoto projektu je vytvořit nový softwarový artefakt: vlastní generativní předtrénovaný transformátor (GPT) pro vývojáře, který umožní diskutovat a řešit etické otázky prostřednictvím inženýrství umělé inteligence. Tento konverzační agent poskytne vývojářům praktickou aplikaci týkající se (1) toho, jak dodržovat právní rámce, které se týkají systémů UI (jako je zákon EU o UI [8] a GDPR [11]), a (2) představí alternativní etické perspektivy, aby vývojáři mohli pochopit a začlenit alternativní morální postoje. V tomto článku uvádíme motivaci pro potřebu takového agenta, podrobně popisujeme naši myšlenku a demonstrujeme případ použití. Použití takového nástroje může umožnit odborníkům z praxe navrhovat řešení umělé inteligence, která splňují právní požadavky a vyhovují různým etickým perspektivám.\r\n', 5, NULL),
(6, 1, 'Stručný přehled vodoznaků v generativní umělé inteligenci\r\n', 'Technologie generativní umělé inteligence je nyní schopna vytvářet obrázky a texty na úrovni srovnatelné s lidmi, což ukazuje její pozoruhodnou užitečnost. Tento pokrok však s sebou nese i řadu problémů, jako je zneužití, což vyvolává diskuse o účinných strategiích reakce. V důsledku toho se v jednotlivých zemích projednávají doporučení a předpisy, včetně přijetí technologie vodoznaku. Mnoho společností také začleňuje technologii vodoznaků do svých služeb jako prostředek řešení tohoto problému. Tento dokument představuje analýzu současného stavu zavádění vodoznaků v různých zemích a společnostech. Dále se zabývá dalšími tématy výzkumu, která by měla být při zavádění technologie vodoznaků zohledněna. Cílem této analýzy je poskytnout cenné poznatky těm, kteří uvažují o implementaci vodoznaků do svých budoucích generativních služeb umělé inteligence.\r\n', 5, NULL),
(7, 1, 'Zajišťují generativní nástroje AI ekologický kód? Vyšetřovací studie\r\n', 'Udržitelnost softwaru se stává prvořadým zájmem, jehož cílem je optimalizovat využívání zdrojů, minimalizovat dopad na životní prostředí a podporovat ekologičtější a odolnější digitální ekosystém. Udržitelnost nebo „ekologičnost“ softwaru se obvykle určuje přijetím udržitelných kódovacích postupů. S dozrávajícím ekosystémem kolem generativní umělé inteligence se nyní mnoho vývojářů softwaru spoléhá na tyto nástroje pro generování kódu pomocí pokynů v přirozeném jazyce. Navzdory jejich potenciálním výhodám existuje značný nedostatek studií o aspektech udržitelnosti kódu generovaného umělou inteligencí. Konkrétně, nakolik je kód generovaný umělou inteligencí šetrný k životnímu prostředí na základě přijetí udržitelných kódovacích postupů? V tomto článku představujeme výsledky počátečního šetření aspektů udržitelnosti kódu generovaného umělou inteligencí ve třech populárních nástrojích generativní umělé inteligence - ChatGPT, BARD a Copilot. Výsledky poukazují na výchozí neekologické chování nástrojů pro generování kódu, a to napříč různými pravidly a scénáři. It underscores the need for further in-depth investigations and effective remediation strategies. 2. KONCEPCE CCS- Sociální a odborná témata → Udržitelnost; - Výpočetní metodologie → Generování v přirozeném jazyce.\r\n', 5, NULL);


INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES
(3, 102, 24, '2024-10-30', NULL),
(3, 103, 24, '2024-10-30', NULL),
(4, 103, 24, '2024-10-30', NULL),
(4, 104, 24, '2024-10-30', NULL),
(4, 105, 24, '2024-10-30', NULL),
(4, 106, 24, '2024-10-30', NULL),
(4, 107, 24, '2024-10-30', NULL),
(4, 108, 24, '2024-10-30', NULL),
(5, 109, 24, '2024-10-30', NULL),
(6, 110, 24, '2024-10-30', NULL),
(6, 111, 24, '2024-10-30', NULL),
(7, 112, 24, '2024-10-30', NULL);

INSERT INTO `RSP_COMMENT` (`ID`, `Article`, `Author`, `TS`, `Commentary`) VALUES
(1, 6, 111, '2024-10-30 06:57:09', 'This article is essential. Keep it in mind!');

