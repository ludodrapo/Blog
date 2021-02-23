-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 23, 2021 at 06:43 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_ok` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment`, `comment_date`, `is_ok`) VALUES
(1, 3, 28, 'En effet, perdre du temps sur ce genre de questions, c\'est dommage ! Le plus important au final c\'est de progresser mais quand même, là c\'est des basiques ...', '2021-02-22 21:54:10', 1),
(2, 3, 19, 'On peut aussi s\'en moquer totalement et vivre comme si de rien n\'était ... non ? j\'ai dit une bêtise ?', '2021-02-22 21:55:05', 1),
(3, 3, 17, 'C\'est très bien tout ça, mais comment fait-on quand on doit progresser en maths par exemple et qu\'on n\'aime pas ça ? Faire des blagues avec l\'infinité des limites de fonctions ? lol', '2021-02-22 21:56:54', 1),
(4, 5, 28, '@subscriber1, il n\'est pas recommandé de se moquer, compte-tenu du fait que chacun bloque sur des choses différentes, et qu\'on est toujours l\'idiot d\'un autre ...', '2021-02-23 17:44:43', 0),
(5, 5, 19, 'Quelqu\'un peut-il me dire si tous les articles sont aussi insipides et bien-pensants ?', '2021-02-23 17:45:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `lead` text NOT NULL,
  `content` text NOT NULL,
  `category` varchar(30) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_ok` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `lead`, `content`, `category`, `creation_date`, `update_date`, `is_ok`) VALUES
(17, 4, 'S\'amuser, c\'est progresser ?', 'La question est encore posée dans notre société alors que les modes d\'apprentissage évoluent et que certains pays ont déjà complètement métamorphosé leurs principes d\'éducation ... transmettre la méthode plutôt que les connaissances, et le tout en s\'amusant.', '&lt;p&gt;&lt;img src=&quot;public/img/uploads/musique.jpg&quot; alt=&quot;piano main enfant&quot; width=&quot;572&quot; height=&quot;322&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;Apprendre est encore associ&amp;eacute; au sens le plus ancien du mot labeur, qui ne s\'entend chez nous qu\'au travers d\'expressions d&amp;eacute;su&amp;egrave;tes comme le &quot;dur labeur&quot; ou &amp;nbsp;&quot;on n\'a rien sans rien&quot; ...&lt;/p&gt;\r\n&lt;p&gt;Prenons l\'exemple de l\'apprentissage d\'un art comme la musique et en particulier la pratique d\'un instrument r&amp;eacute;put&amp;eacute; complexe comme le piano, les premiers mots qui viennent &amp;agrave; l\'esprit sont la douleur, la difficult&amp;eacute;, le temps ... Mais qu\'en est-il vraiment ?&lt;/p&gt;\r\n&lt;p&gt;Je passerai sur la lecture (donc le solf&amp;egrave;ge) dont tout le monde se souvient avec effroi et m\'attarderai sur le cauchemar des jeunes &amp;eacute;l&amp;egrave;ves : le m&amp;eacute;tronome ! Qu\'y a-t-il de plus frustrant que ce tic tac m&amp;eacute;canique insupportable qui g&amp;acirc;che le moindre trait, le moindre accord pos&amp;eacute;, la moindre gamme ?&lt;/p&gt;\r\n&lt;p&gt;En r&amp;eacute;alit&amp;eacute;, si nous imaginons que ce froid mouvement si r&amp;eacute;gulier est un ami batteur, nous trouvons en lui la possibilit&amp;eacute; de faire swinguer la moindre pentatonique, funkiser la premi&amp;egrave;re note grave ou rendre sa noblesse &amp;agrave; tout le r&amp;eacute;pertoire de Bach. Il suffit pour cela de l\'&amp;eacute;couter vraiment, de ne plus simplement l\'entendre, mais de le laisser lui aussi jouer et de chanter son tempo. D\'abord sur les temps, &quot;1 et 2 et 3 et 4 et&quot; puis en entendant uniquement des &quot;... 2 ... 4&quot;, et en chantant avec lui, en se levant du piano, en dansant avec lui ...&lt;/p&gt;\r\n&lt;p&gt;... D\'un coup, vous allez le voir comme un soutien, comme un autre musicien, avec qui vous allez &amp;eacute;changer, jouer, et surtout &lt;em&gt;&lt;strong&gt;vous amuser&lt;/strong&gt;&lt;/em&gt; et sans y penser, vous allez &amp;ecirc;tre dans le rythme, vous allez enfin progresser et jouer !&lt;/p&gt;\r\n&lt;p&gt;Progresse-t-on, apprend-t-on, mieux quand on souffre ? Sauf &amp;agrave; &amp;ecirc;tre masochiste, la r&amp;eacute;ponse est non. Certes, la notion de temps est une varialbe importante &amp;agrave; prendre en compte dans l\'apprentissage mais l&amp;agrave; encore, passer du temps sur quelque chose qui nous fait mal est contre-productif alors que ce qu\'on appr&amp;eacute;cie peut &amp;ecirc;tre r&amp;eacute;alis&amp;eacute; toute la journ&amp;eacute;e sans qu\'on se lasse ... l&amp;agrave; encore, &lt;em&gt;&lt;strong&gt;s\'amuser c\'est progresser&lt;/strong&gt;&lt;/em&gt;.&lt;/p&gt;', 'Musique', '2021-01-15 15:19:16', '2021-02-22 21:08:33', 1),
(19, 4, 'Et maintenant, que peut-on faire ?', 'La pandémie s\'installe dans la durée, les inégalités se creusent, la planète se réchauffe ... et nous, que peut-on faire vraiment ? Pouvons-nous réellement agir ? La réponse se trouve dans une poche de notre veste, ou au fond d\'un sac, voire dans une application de notre mobile ...', '&lt;p&gt;&lt;img src=&quot;public/img/uploads/legos.jpg&quot; alt=&quot;lego crowd&quot; width=&quot;233&quot; height=&quot;131&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;Notre porte-monnaie est notre seule v&amp;eacute;ritable arme. Prenons simplement conscience qu\'acheter moins cher, c\'est souvent acheter moins bien ou moins bon, ce qui vient de plus loin, ce qui respecte moins les r&amp;egrave;gles ...Quelque soit l\'acte d\'achat, il n\'est jamais innocent ; il joue toujours en faveur du mieux ou du pire.&lt;/p&gt;\r\n&lt;p&gt;Et si nous inversions notre mod&amp;egrave;le de pens&amp;eacute;e, notre paradigme, si on peut dire. Si au lieu de penser comme dans les ann&amp;eacute;es 80 qu\'une entreprise qui ne cro&amp;icirc;t pas, meurt, qu\'une famille qui ne consomme pas ne peut pas &amp;ecirc;tre heureuse, nous prenions la question &amp;agrave; l\'envers en ne se focalisant que sur le r&amp;eacute;sultat net final, l\'ebit comme ils disent au contr&amp;ocirc;le de gestion, ou tout simplement le solde du compte &amp;agrave; la fin du mois.&lt;/p&gt;\r\n&lt;p&gt;Appliqu&amp;eacute; &amp;agrave; une cellule familiale par exemple, cela consiste &amp;agrave; faire le m&amp;eacute;nage dans les d&amp;eacute;penses en commen&amp;ccedil;ant par supprimer tout ce qui n\'est pas n&amp;eacute;cessaire sauf peut-&amp;ecirc;tre ce qui fait tellement de bien (en dehors de ce qui est n&amp;eacute;faste pour notre sant&amp;eacute; bien s&amp;ucirc;r) qu\'on ne peut s\'imaginer s\'en passer.&lt;/p&gt;\r\n&lt;p&gt;Ensuite, on r&amp;eacute;&amp;eacute;value l\'&amp;eacute;quilibre entre d&amp;eacute;penses et recettes et on cherche du c&amp;ocirc;t&amp;eacute; des ressources sans doute inexploit&amp;eacute;es jusqu\'&amp;agrave; maintenant ; un savoir-faire qu\'on peut transmettre, des objets peut-&amp;ecirc;tre utiles pour d\'autres et qu\'on peut revendre ... Le d&amp;eacute;veloppement de la revente sur les r&amp;eacute;seaux retail nationaux pour attirer de la client&amp;egrave;le est tel aujourd\'hui qu\'il serait dommage de ne pas en profiter.&lt;/p&gt;\r\n&lt;p&gt;Cela pourrait ressembler &amp;agrave; de la radinerie, mais il n\'en est rien. Ici, le but n\'est pas d\'&amp;eacute;viter de d&amp;eacute;penser, mais de mieux d&amp;eacute;penser. Faire et se faire plaisir, mais en r&amp;eacute;fl&amp;eacute;chissant aux conditions et cons&amp;eacute;quences de nos achats.&lt;/p&gt;\r\n&lt;p&gt;Gardons en t&amp;ecirc;te que nos d&amp;eacute;penses comptent plus que notre bulletin de vote car l\'&amp;ecirc;tre humain est ainsi fait (et les directions des grandes entreprises aussi) que toucher au portefeuille de fa&amp;ccedil;on radicale est beaucoup plus efficace que r&amp;eacute;guler ou l&amp;eacute;gif&amp;eacute;rer. Cela souligne l\'&amp;eacute;go&amp;iuml;sme dont font preuve les membres de notre esp&amp;egrave;ce mais qu\'importe, il faut faire avec.&lt;/p&gt;\r\n&lt;p&gt;En r&amp;eacute;sum&amp;eacute;, d&amp;eacute;pensons autant en euro mais moins en quantit&amp;eacute; pour des produits de meilleure qualit&amp;eacute;, venant de moins loin et plus durable et nous am&amp;eacute;liorerons notre monde plus fortement et plus rapidement que toutes les lois en cours d\'&amp;eacute;laboration.&lt;/p&gt;', 'Société', '2021-01-24 15:05:51', '2021-02-23 15:07:18', 1),
(28, 4, 'Petite sélection de blocages', 'En réalisant ce blog, j\'ai eu la chance de me poser beaucoup de questions, et parmi elles, un bon nombre m\'apparaissent aujourd\'hui vraiment idiotes. Petit best-of de mes interrogations les plus étonnantes ... après coup !\r\n', '&lt;p&gt;&lt;img src=&quot;public/img/uploads/code.jpg&quot; alt=&quot;screen with code&quot; width=&quot;476&quot; height=&quot;267&quot; /&gt;&lt;/p&gt;\r\n&lt;p&gt;Avec TinyMCE par exemple, tout semble tr&amp;egrave;s simple et tr&amp;egrave;s pratique certes mais l\'aspect s&amp;eacute;curit&amp;eacute; m\'a un peu fait peur au d&amp;eacute;but, car si je &quot;striptag&quot; &amp;agrave; l\'envoi vers la base de donn&amp;eacute;es, rien ne s\'enregistre et si je &quot;htmlspecialchars&quot; l\'article sur la view ... on voit tout le code !&lt;/p&gt;\r\n&lt;p&gt;La solution est toute simple et il suffisait d\'y penser (et aussi de savoir que cela existait) : il suffit d\'enregistrer avec un &lt;code&gt;htmlspecialchars($string)&lt;/code&gt; et d\'afficher avec la fonction int&amp;eacute;gr&amp;eacute;e &lt;code&gt;htmlspecialchars_decode($string)&lt;/code&gt;&lt;span style=&quot;font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;&quot;&gt;... tout simple mais il fallait le savoir !&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;Pour le redimensionnement des images, c\'est aussi super simple. Un id dans le div d\'affichage et hop :&lt;br /&gt;&lt;code&gt;#tiny_content img {&lt;/code&gt;&lt;br /&gt;&lt;code&gt;&amp;nbsp; &amp;nbsp; with : 100%;&lt;/code&gt;&lt;br /&gt;&lt;code&gt;&amp;nbsp; &amp;nbsp; height : auto;&lt;/code&gt;&lt;br /&gt;&lt;code&gt;}&lt;/code&gt;&lt;/p&gt;\r\n&lt;p&gt;Concernant la sauvegarde des visuels d\'illustration, j\'ai but&amp;eacute; sur une chose toute simple : ne pas oubli&amp;eacute; le slash de fin de chemin du &quot;target directory&quot; pour le concat&amp;eacute;ner avec le nom du fichier ... &lt;code&gt;$targer_dir = &quot;/chemin/vers/le/dossier&lt;/code&gt;&lt;span style=&quot;color: #ba372a;&quot;&gt;&lt;code&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;span style=&quot;color: #e03e2d; text-decoration: underline;&quot;&gt;&lt;strong&gt;/&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/code&gt;&lt;span style=&quot;color: #000000;&quot;&gt;&lt;code&gt;&quot;&lt;/code&gt; et donc &lt;code&gt;$target_file = $target_dir&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;span style=&quot;color: #e03e2d; text-decoration: underline;&quot;&gt; &lt;strong&gt;. &lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;basename&lt;/code&gt;&lt;/span&gt;&lt;/span&gt;&lt;code&gt;($_FILES[\'image_to_upload\'][\'name\']);&lt;/code&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'Développement', '2021-02-05 09:57:32', '2021-02-22 15:32:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(16) NOT NULL DEFAULT 'subscriber' COMMENT 'administrator or subscriber only',
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login_name`, `email`, `profile`, `password`, `is_active`, `registration_date`) VALUES
(3, 'subscriber1', 'subscriber1@ludodrapo.fr', 'subscriber', '$2y$10$1KyBjc8hGLFMP/TCrMVfiee/aT2VmJZTW2KIicQjhGSTYDwynF9aW', 1, '2021-01-23 10:39:17'),
(4, 'admin', 'admin@ludodrapo.fr', 'administrator', '$2y$10$vFaX7/GbjYvWT7Uwnjs.bOhDPsRXvlUjguVzZPghVbC2IQpPFcDie', 1, '2021-01-01 14:46:46'),
(5, 'subscriber2', 'subscriber2@ludodrapo.fr', 'subscriber', '$2y$10$D9BcdqBXQkl3cficlGIi7OlHItMFL5rF1/My8QIAUjkNO8yQ3ogK6', 1, '2021-02-23 16:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `users_comments_fk` (`user_id`),
  ADD KEY `posts_comments_fk` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `users_posts_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `posts_comments_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_comments_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `users_posts_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;